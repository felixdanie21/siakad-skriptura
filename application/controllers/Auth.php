<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        // get iden pt
        $this->midenpt = $this->db->get('midenpt')->row();
	}

	public function cek_login()
    {
        $remember_token = get_cookie('siakad_remember_token');
        if($remember_token){
            $this->db->where('usertoken',$remember_token);
            $cekuser = $this->db->get('muser')->row();
            // userdata
            $userdata = [
                'userid' => $cekuser->userid,
                'username' => $cekuser->username,
                'userpasw' => $cekuser->userpasw,
                'userstat' => $cekuser->userstat,
                'userimg' => $cekuser->userimg,
            ];
            $this->session->set_userdata($userdata);
        }
        if ($this->session->userdata('userid')) {
            redirect('Dashboard/Index');
        } else {
            redirect('Auth');
        }
    }

	public function index()
    {
        foreach ($_SESSION as $key => $val) {
            if ($key !== "autherrormsg" && $key !== "authsuccessmsg" && $key !== "authinfomsg" && $key !== "__ci_vars") {
                unset($_SESSION[$key]);
            }
        }
		$data['midenpt'] = $this->midenpt;
        $this->load->view('layout/auth/header',$data);
        $this->load->view('auth/index');
        $this->load->view('layout/auth/footer');
    }

    public function login_post()
    {
        $post = $this->input->post();
        $this->db->where("userid", $post['userid']);
        $cekuser = $this->db->get('muser')->row();
        if ($cekuser) {
            if (strtolower($post['password']) == strtolower($cekuser->userpasw)) {
				// remember
				if($post['remember'])
				{
					$token = $cekuser->userid.bin2hex(random_bytes(50));
					$this->db->update("muser",['usertoken' => $token],['userid' => $cekuser->userid]);
					set_cookie('siakad_remember_token',$token,3600 * 24 * 30);
				}
				$userdata = [
					'userid' => $cekuser->userid,
					'username' => $cekuser->username,
					'userpasw' => $cekuser->userpasw,
					'userstat' => $cekuser->userstat,
					'userimg' => $cekuser->userimg,
					'successmsg' => 'BERHASIL LOGIN'
				];
				$this->session->set_userdata($userdata);
				redirect('Dashboard/Index');
            } else {
                $this->session->set_userdata('autherrormsg', 'PASSWORD SALAH');
                redirect('Auth');
            }
        } else {
            // create user mahasiswa
            $this->db->where('idnim',$post['userid']);
            $mhsbio = $this->db->get('mhsbio')->row();
            if($mhsbio){
                $tgllahir_password = date('dmY',strtotime($mhsbio->tgllhrmhs));
                if (strtolower($post['password']) == $tgllahir_password) {
                    // insert user
                    $createUser = [
                        'userid' => $mhsbio->idnim,
                        'username' => $mhsbio->namamhs,
                        'userpasw' =>  $tgllahir_password,
                        'userstat' =>  'MH',
                    ];
                    $this->db->insert('muser',$createUser);
                    // remember
                    if($post['remember'])
                    {
                        $token = $mhsbio->idnim.bin2hex(random_bytes(50));
                        $this->db->update("muser",['usertoken' => $token],['userid' => $mhsbio->idnim]);
                        set_cookie('siakad_remember_token',$token,3600 * 24 * 30);
                    }
                    $userdata = [
                        'userid' => $mhsbio->idnim,
                        'username' => $mhsbio->namamhs,
                        'userpasw' =>  $tgllahir_password,
                        'userstat' =>  'MH',
                        'userimg' => 'user.png',
                        'successmsg' => 'BERHASIL LOGIN'
                    ];
                    $this->session->set_userdata($userdata);
                    redirect('Dashboard/Index');
                } else {
                    $this->session->set_userdata('autherrormsg', 'PASSWORD SALAH');
                    redirect('Auth');
                }
            }
            // create user dosen
            $this->db->where('iddosen',$post['userid']);
            $mdosen = $this->db->get('mdosen')->row();
            if($mdosen){
                $tgllahir_password = date('dmY',strtotime($mdosen->tgllhrdosen));
                if (strtolower($post['password']) == $tgllahir_password) {
                    // insert user
                    $createUser = [
                        'userid' => $mdosen->iddosen,
                        'username' => $mdosen->namalengkap,
                        'userpasw' =>  $tgllahir_password,
                        'userstat' =>  'DS',
                    ];
                    $this->db->insert('muser',$createUser);
                    // remember
                    if($post['remember'])
                    {
                        $token = $mdosen->iddosen.bin2hex(random_bytes(50));
                        $this->db->update("muser",['usertoken' => $token],['userid' => $mdosen->iddosen]);
                        set_cookie('siakad_remember_token',$token,3600 * 24 * 30);
                    }
                    $userdata = [
                        'userid' => $mdosen->iddosen,
                        'username' => $mdosen->namalengkap,
                        'userpasw' =>  $tgllahir_password,
                        'userstat' =>  'DS',
                        'userimg' => 'user.png',
                        'successmsg' => 'BERHASIL LOGIN'
                    ];
                    $this->session->set_userdata($userdata);
                    redirect('Dashboard/Index');
                } else {
                    $this->session->set_userdata('autherrormsg', 'PASSWORD SALAH');
                    redirect('Auth');
                }
            }
            $this->session->set_userdata('autherrormsg', 'USER TIDAK DITEMUKAN');
            redirect('Auth');
        }
    }

	public function logout()
    {
        delete_cookie('siakad_remember_token');
        $this->session->set_userdata('loginsuccessmsg', 'BERHASIL LOGOUT');
        redirect('Auth');
    }

}
