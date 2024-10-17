<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prasyarat extends CI_Controller {
    
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
        $post = $this->input->post();
        $data['sortby'] = 'nama';
        if($post){
            if($post['sortby'] == "semester"){   
                $data['sortby'] = 'semester';
                $this->db->order_by('smsmtk', 'ASC');
            }
        }
        $this->db->order_by('namamtk', 'ASC');
        $data['table'] = $this->db->get('matkul')->result_array();
    
        $data['indukmenu'] = 'BE050000';
        $data['submenu'] = 'BE050200';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header', $data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/matakuliah/prasyarat/index');
        $this->load->view('layout/home/footer');
    }
    
    public function form($idmtkutama)
    {
        $this->db->where('idmtk',$idmtkutama);
        $mtkutama = $this->db->get('matkul')->row();
        $this->db->where('smsmtk <',$mtkutama->smsmtk );
        $this->db->order_by('namamtk','ASC');
        $data['matakuliahsyarat'] = $this->db->get('matkul')->result_array();

        $this->db->where('idmtk',$idmtkutama);
        $data['matkul'] = $this->db->get('matkul')->row();
        $data['indukmenu'] = 'BE050000';
        $data['submenu'] = 'BE050200';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/matakuliah/prasyarat/form');
        $this->load->view('layout/home/footer');
    }

    public function simpan()
    {
        $post = $this->input->post();
        // delete dlu
        $this->db->delete('mtksyr',['idmtkutama' => $post['idmtkutama']]);
        // baru insert
        foreach($post['idmtksyarat'] as $idmtksyarat){
            $insert = [
                'idmtkutama' => $post['idmtkutama'],
                'idmtksyarat' => $idmtksyarat,
            ];
            $this->db->insert('mtksyr', $insert);
        }
        $this->session->set_userdata('successmsg', 'Data berhasil disimpan');
        redirect('Akademik/Matakuliah/Prasyarat');
    }

    public function delete($idmtkutama)
    {
        $this->db->delete('mtksyr',['idmtkutama' => $idmtkutama]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect('Akademik/Matakuliah/Prasyarat');
    }
}