<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komponennilai extends CI_Controller {

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
    public function index(){
        $post= $this->input->post();
        $get= $this->input->get();
        $this->db->join('mfakul','mfakul.idfak=mprodi.idfak');
        $this->db->order_by('urutfak','ASC');
        $this->db->order_by('urutprodi','ASC');
        $data['mprodi']= $this->db->get('mprodi')->result_array();
        $this->db->order_by('tahunakad','DESC');
        $this->db->order_by('jenissemester','DESC');
        $data['mthnak']= $this->db->get('mthnak')->result_array();
        
        $data['table'] = [];
        $data['idthnkls'] = '';
        $data['idprodikls'] = '';
        if ($post || $get) {
            if (!$post) {
                $post = $get;
            }
            $data['idthnkls'] = $post['idthnkls'];
            $data['idprodikls'] = $post['idprodikls'];
            $this->db->order_by('matkul.namamtk','ASC');
            $this->db->order_by('idkelas','ASC');
            $this->db->join('mthnak','mthnak.idthn=tkelas.idthnkls');
            $this->db->join('matkul','matkul.idmtk=tkelas.idmtkkls');
            $this->db->join('mprodi','mprodi.idprodi=matkul.idprodimtk');
            $this->db->join('mdosen','mdosen.iddosen=tkelas.iddosenkelas');
            $this->db->join('mruang','mruang.koderuang=tkelas.koderuangkelas');
            $this->db->where('idthnkls',$post['idthnkls']);
            $this->db->where('idprodimtk',$post['idprodikls']);
            $data['table'] =$this->db->get('tkelas')->result_array();
        }
        $data['indukmenu'] = 'BE010000';
        $data['submenu'] = 'BE010400';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/nilaistudi/komponennilai/index');
        $this->load->view('layout/home/footer');
    }
}