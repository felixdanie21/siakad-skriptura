<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class fakultas extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
        // cek login
        $this->load->model('Utility');
        $this->load->model('MenuModel');
        $this->Utility->isLogin();
        $this->Utility->modulSecurity('AA');
        // get iden pt
        $this->midenpt = $this->db->get('midenpt')->row();
	}

    public function index()
    {
        $this->db->order_by('urutfak','ASC');
        $data['table'] = $this->db->get('mfakul')->result_array();
        $data['indukmenu'] = 'BE060000';
        $data['submenu'] = 'BE060100';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/prodfak/fakultas/index');
        $this->load->view('layout/home/footer');
    }

    public function form()
    {
        $data['jenis'] = 'TAMBAH';
        $this->db->order_by('namalengkap',"ASC");
        $data['mdosen'] = $this->db->get('mdosen')->result_array();
        // edit
        $idfak = $this->input->get('idfak');
        if($idfak){
            $data['jenis'] = 'EDIT';
            $this->db->where('idfak',$idfak);
            $data['mfakul'] = $this->db->get('mfakul')->row();
            $this->db->join('mprodi','mprodi.idprodi=mdosen.idprodidosen');
            $this->db->where('idfak',$idfak);
            $this->db->order_by('namalengkap',"ASC");
            $data['mdosen'] = $this->db->get('mdosen')->result_array();
        }
        
        $data['indukmenu'] = 'BE060000';
        $data['submenu'] = 'BE060100';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/prodfak/fakultas/form');
        $this->load->view('layout/home/footer');
    }

    public function simpan($jenis)
    {
        $post = $this->input->post();
        if($jenis == 'TAMBAH'){
            $this->db->where('idfak',$post['idfak']);
            $cek_id = $this->db->get('mfakul')->row();
            if($cek_id){
                $this->session->set_userdata('errormsg','Id fakultas sudah digunakan');
                redirect($_SERVER['HTTP_REFERER']);
            }

            $this->db->where('urutfak',$post['urutfak']);
            $cek_urut = $this->db->get('mfakul')->row();
            if($cek_urut){
                $this->session->set_userdata('errormsg','Nomor urut sudah digunakan');
                redirect($_SERVER['HTTP_REFERER']);
            }
            
            $insert = [
                'idfak' => $post['idfak'],
                'namafak' => $post['namafak'],
                'urutfak' => $post['urutfak'],
                'iddosendekan' => $post['iddosendekan'],
            ];
            $this->db->insert('mfakul',$insert);
        } else if($jenis == "EDIT"){
            $update = [
                'namafak' => $post['namafak'],
                'urutfak' => $post['urutfak'],
                'iddosendekan' => $post['iddosendekan'],
            ];
            $this->db->update('mfakul',$update,['idfak' => $post['idfak']]);
        }
        $this->session->set_userdata('successmsg','Data berhasil disimpan');
        redirect('Akademik/Prodfak/Fakultas');
    }

    public function delete($idfak)
    {
        $this->db->delete('mfakul',['idfak' => $idfak]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect('Akademik/Prodfak/Fakultas');
    }

    public function ajax_cekIdFakultas()
    {
        $idfak = $this->input->post('idfak');
        $this->db->where('idfak',$idfak);
        $cek_id = $this->db->get('mfakul')->row();
        if($cek_id){
            echo '201';
        } else {
            echo '200';
        }
    }

    public function ajax_cekUrutFakultas()
    {
        $urutfak = $this->input->post('urutfak');
        $this->db->where('urutfak',$urutfak);
        $cek_urut = $this->db->get('mfakul')->row();
        if($cek_urut){
            echo '201';
        } else {
            echo '200';
        }
    }
}