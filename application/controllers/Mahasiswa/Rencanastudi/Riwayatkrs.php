<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayatkrs extends CI_Controller {


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
    public function index(){

        $this->db->where('idnim',$this->session->userdata('userid') );
        $data['mhsbio']= $this->db->get('mhsbio')->row();

        $this->db->select('*');
        $this->db->from('tkhs');
        $this->db->order_by('idthn','ASC');
        $this->db->order_by('totalskskrs','DESC');
        $this->db->join('mthnak','mthnak.idthn=tkhs.idthnkhs');
        $this->db->where('idnimkls',$this->session->userdata('userid') );
        $data['table'] = $this->db->get()->result_array();

        $data['indukmenu'] = 'BB020000';
        $data['submenu'] = 'BB020200';
        $data['mmenu'] = $this->MenuModel->listmenu('BB');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('mahasiswa/rencanastudi/riwayatkrs/index');
        $this->load->view('layout/home/footer');
    }
    public function preview($idthnkhs){
        $this->db->where('idnim',$this->session->userdata('userid') );
        $data['mhsbio']= $this->db->get('mhsbio')->row();
        $this->db->select('*');
        $this->db->from('tkrs');
        $this->db->order_by('idthn','ASC');
        $this->db->join('mthnak','mthnak.idthn=tkrs.idthnkrs');
        $this->db->where('idthn',$idthnkhs);
        $this->db->where('idnimkls',$this->session->userdata('userid') );
        $this->db->group_by('tkrs.idthnkrs');
        
        $userid = $this->session->userdata('userid');
        $data['table'] = $this->db->get()->result_array();

        $data['indukmenu'] = 'BB020000';
        $data['submenu'] = 'BB020200';
        $data['mmenu'] = $this->MenuModel->listmenu('BB');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('mahasiswa/rencanastudi/riwayatkrs/preview');
        $this->load->view('layout/home/footer');
    }
}