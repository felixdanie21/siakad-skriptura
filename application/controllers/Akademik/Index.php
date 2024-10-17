<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class index extends CI_Controller {


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
        $data['indukmenu'] = '';
        $data['submenu'] = '';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/index');
        $this->load->view('layout/home/footer');
    }

}