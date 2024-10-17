<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mingguini extends CI_Controller {


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
        $post = $this->input->post();
        $get = $this->input->get();
        $this->db->where('idnim',$this->session->userdata('userid') );
        $data['mhsbio']= $this->db->get('mhsbio')->row();

        $this->db->order_by('idthn','ASC');
        $this->db->select('*');
        $this->db->from('tkrs');
        $this->db->join('mthnak','mthnak.idthn=tkrs.idthnkrs');
        $this->db->where('idnimkls',$this->session->userdata('userid') );
        $this->db->group_by('tkrs.idthnkrs');
        $data['mthnak'] = $this->db->get()->result_array();

        $data['table'] = [];
        $data['idthnkrs'] = '';

        if($post || $get){
            if(!$post){
                $post = $get;
            }
            $data['idthnkrs'] = $post['idthnkrs'];
            
            $this->db->select('*');
            $this->db->from('tkrs');
            $this->db->join('mthnak', 'mthnak.idthn = tkrs.idthnkrs');
            $this->db->order_by('harikelas','DESC');
            $this->db->order_by('jammulaikelas','ASC');
            $this->db->join('tkelas', 'tkelas.idkelas = tkrs.idkelaskrs');
            $this->db->join('matkul', 'matkul.idmtk = tkelas.idmtkkls');
            $this->db->join('mdosen', 'mdosen.iddosen = tkelas.iddosenkelas');
            $this->db->where('idthnkrs', $post['idthnkrs']);
            $this->db->where('idnimkls',$this->session->userdata('userid') );
            $data['table'] = $this->db->get()->result_array();

        }

        $data['indukmenu'] = 'BB010000';
        $data['submenu'] = 'BB010100';
        $data['mmenu'] = $this->MenuModel->listmenu('BB');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('mahasiswa/jadwalkuliah/mingguini/index');
        $this->load->view('layout/home/footer');
    }
}