<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis extends CI_Controller {


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

        $data['table'] = $this->db->get('mjnsmtk')->result_array();
        $data['indukmenu'] = 'BE050000';
        $data['submenu'] = 'BE050300';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/matakuliah/jenis/index');
        $this->load->view('layout/home/footer');
    }

    public function form()
    {
        $idjns = $this->input->get('idjenis');

        $data['jenis'] = 'TAMBAH';
        if ($idjns) {
            $data['jenis'] = 'EDIT';
            $this->db->where('idjenis', $idjns);
            $data['mjnsmtk'] = $this->db->get('mjnsmtk')->row();
        }
        $data['indukmenu'] = 'BE050000';
        $data['submenu'] = 'BE050300';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/matakuliah/jenis/form');
        $this->load->view('layout/home/footer');
    }

    public function simpan($jenis)
    {
        $post = $this->input->post();
        if ($jenis == 'TAMBAH') {
            $this->db->where('idjenis',$post['idjenis']);
            $cek_id = $this->db->get('mjnsmtk')->row();
            if ($cek_id) {
                $this->session->set_userdata('errormsg','Id Jenis Matakuliah sudah di gunakan');
                redirect($SERVER['HTTP_REFERER']);
            }
            $insert = [
                'idjenis'=> $post['idjenis'],
                'namajenis'=> $post['namajenis'],
            ];
            $this->db->insert('mjnsmtk',$insert);
        }elseif ($jenis == "EDIT") 
        {
            $upadate = [
                'namajenis'=> $post['namajenis'],
            ];
            $this->db->update('mjnsmtk',$upadate,['idjenis'=>$post['idjenis']]);
        }
        $this->session->set_userdata('successmsg','Data berhasil di simpan');
        redirect('Akademik/Matakuliah/Jenis');
    }

    public function delete($idjns)
    {
        $this->db->delete('mjnsmtk',['idjenis' => $idjns]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect('Akademik/Matakuliah/Jenis');
    }

    public function ajax_cekIdJnsmtk()
    {
        $idjenis = $this->input->post('idjenis');
        $this->db->where('idjenis',$idjenis);
        $cek_id = $this->db->get('mjnsmtk')->row();
        if($cek_id){
            echo '201';
        } else {
            echo '200';
        }
    }
}