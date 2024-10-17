<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtkditawarkan extends CI_Controller {


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

        $this->db->select_max('idthn', 'max_idthnkls');
        $this->db->from('mthnak');
        $max_query = $this->db->get();
        $max_idthnkls = $max_query->row()->max_idthnkls;

        $this->db->select('*');
        $this->db->from('tkelas');
        $this->db->group_by('tkelas.idthnkls');        
        $this->db->join('mthnak', 'mthnak.idthn = tkelas.idthnkls');
        $this->db->where('tkelas.idthnkls', $max_idthnkls);
        $data['table1'] = $this->db->get()->result_array();
   
        $this->db->select('*');
        $this->db->from('tkelas');
        $this->db->order_by('namamtk','ASC');
        $this->db->join('mthnak', 'mthnak.idthn = tkelas.idthnkls');
        $this->db->order_by('namaruang','DESC');
        $this->db->join('mruang', 'mruang.koderuang = tkelas.koderuangkelas');
        $this->db->join('matkul', 'matkul.idmtk = tkelas.idmtkkls');
        $this->db->join('mdosen', 'mdosen.iddosen = tkelas.iddosenkelas');
        $this->db->where('tkelas.idthnkls', $max_idthnkls);
        $data['table'] = $this->db->get()->result_array();

        

      
        $data['indukmenu'] = 'BB020000';
        $data['submenu'] = 'BB020300';
        $data['mmenu'] = $this->MenuModel->listmenu('BB');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('mahasiswa/rencanastudi/mtkditawarkan/index');
        $this->load->view('layout/home/footer');
    }
}