<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komponenpnl extends CI_Controller {


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
        $this->db->order_by('kodepenilaian');
        $data['table'] = $this->db->get('mkomnil')->result_array();

        $data['indukmenu'] = 'BE050000';
        $data['submenu'] = 'BE050500';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/matakuliah/komponenpnl/index');
        $this->load->view('layout/home/footer');
    }
    public function form()
    {
        $kodepenilaian = $this->input->get('kodepenilaian');

        $data['jenis'] = 'TAMBAH';
        if ($kodepenilaian) {
            $data['jenis'] = 'EDIT';
            $this->db->where('kodepenilaian', $kodepenilaian);
            $data['mkomnil'] = $this->db->get('mkomnil')->row();
        }
        $data['indukmenu'] = 'BE050000';
        $data['submenu'] = 'BE050500';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/matakuliah/komponenpnl/form');
        $this->load->view('layout/home/footer');
    }
    public function simpan($jenis)
    {
        $post = $this->input->post();
        if ($jenis == 'TAMBAH') {
            $this->db->where('kodepenilaian',$post['kodepenilaian']);
            $cek_id = $this->db->get('mkomnil')->row();
            if ($cek_id) {
                $this->session->set_userdata('errormsg','Id Jenis Matakuliah sudah di gunakan');
                redirect($SERVER['HTTP_REFERER']);
            }
            $insert = [
                'kodepenilaian'=> $post['kodepenilaian'],
                'namapenilaian'=> $post['namapenilaian'],
            ];
            $this->db->insert('mkomnil',$insert);
        }elseif ($jenis == "EDIT") 
        {
            $upadate = [
                'namapenilaian'=> $post['namapenilaian'],
            ];
            $this->db->update('mkomnil',$upadate,['kodepenilaian'=>$post['kodepenilaian']]);
        }
        $this->session->set_userdata('successmsg','Data berhasil di simpan');
        redirect('Akademik/Matakuliah/Komponenpnl');
    }
}