<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
        // cek login
        $this->load->model('Utility');
        $this->load->model('MenuModel');
        $this->Utility->isLogin('SA');
        // get iden pt
        $this->midenpt = $this->db->get('midenpt')->row();
	}

    public function index()
    {
        $data['indukmenu'] = '';
        $data['submenu'] = '';
        $data['mmenu'] = $this->MenuModel->listmenu('BG');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('konfigurasi/index');
        $this->load->view('layout/home/footer');
    }

}