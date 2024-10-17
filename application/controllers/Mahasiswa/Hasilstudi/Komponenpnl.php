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
        $this->Utility->modulSecurity('MH');
        // get iden pt
        $this->midenpt = $this->db->get('midenpt')->row();
	}
    
    public function index()
    {
        $this->db->order_by('idthn');
        $data['mthnak'] = $this->db->get('mthnak')->result_array();
        $post = $this->input->post();
        $get = $this->input->get();

        $data['table'] = [];
        $data['idthnnil'] = '';
        if($post || $get) {
            if(!$post) {
                $post = $get;
            }
            $data['idthnnil'] = $post['idthn'];
            $this->db->join('mhsbio','mhsbio.idnim=tnilstd.idnimnil');
            $this->db->join('matkul','matkul.idmtk=tnilstd.idmtknil');
            $this->db->join('mthnak','mthnak.idthn=tnilstd.idthnnil');
            $this->db->where('idthnnil',$post['idthn']);
            $this->db->where('idnimnil', $this->session->userdata('userid'));
            $data['table'] = $this->db->get('tnilstd')->result_array();  

        }
        $data['indukmenu'] = 'BB030000';
        $data['submenu'] = 'BB030100';
        $data['mmenu'] = $this->MenuModel->listmenu('BB');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('mahasiswa/hasilstudi/komponenpnl/index');
        $this->load->view('layout/home/footer');
        }
}