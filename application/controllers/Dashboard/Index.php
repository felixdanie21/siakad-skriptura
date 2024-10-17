<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

    public function __construct()
	{
		parent::__construct();
        // cek login
        $this->load->model('Utility');
        $this->load->model('MenuModel');
        $this->Utility->isLogin();
        $this->Utility->modulSecurity('SA');
        // get iden pt
        $this->midenpt = $this->db->get('midenpt')->row();
	}

    public function index()
    {
        $data['indukmenu'] = 'BA010000';
        $data['submenu'] = '';
        $data['mmenu'] = $this->MenuModel->listmenu('BA');
        $this->db->order_by('kodemodul','ASC');
        $data['mmodul'] = $this->db->get('mmodul')->result_array();
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('dashboard/index');
        $this->load->view('layout/home/footer');
    }

}