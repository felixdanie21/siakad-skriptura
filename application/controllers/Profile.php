<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
        // cek login
        $this->load->model('Utility');
        $this->load->model('MenuModel');
        $this->Utility->isLogin();
        // get iden pt
        $this->midenpt = $this->db->get('midenpt')->row();
	}

    public function update()
    {
        $post = $this->input->post();
        if(strtolower($post['passwordlama']) == strtolower($this->session->userdata('userpasw'))){
            if(strtolower($post['passwordbaru']) == strtolower($post['passwordbaru2'])){
                $updateUser = [
                    'userpasw' => $post['passwordbaru']
                ];
                $this->db->update('muser',$updateUser,['userid' => $this->session->userdata('userid')]);
                $userdata = [
					'userpasw' => $post['passwordbaru']
				];
				$this->session->set_userdata($userdata);
                $this->session->set_userdata('successmsg', 'Data berhasil diupdate.');
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_userdata('errormsg', 'Konfirmasi Password baru tidak sesuai.');
                redirect($_SERVER['HTTP_REFERER']);
            }
        } else {
            $this->session->set_userdata('errormsg', 'Password lama tidak sesuai.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

}