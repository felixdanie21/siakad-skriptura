<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasilstudisemester extends CI_Controller {


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
        $post = $this->input->post();
        $get = $this->input->get();

        $this->db->select('*');
        $this->db->from('tkrs');
        $this->db->join('tkelas','tkelas.idkelas=tkrs.idkelaskrs');
        $this->db->join('mdosen','mdosen.iddosen=tkelas.iddosenkelas');
        $this->db->where('idnimkls',$this->session->userdata('userid'));
        $this->db->group_by('iddosen');
        $this->db->order_by('namadosen');
        $data['tkrs'] = $this->db->get()->result_array();

        $data['table'] = [];
        $data['iddosen']= '';
        if($post || $get){
            if(!$post){
                $post = $get;
            }
            $data['iddosen'] = $post['iddosen'];
            $this->db->select('*');
            $this->db->from('tnildetkom');
            $this->db->join('mhsbio','mhsbio.idnim=tnildetkom.idnimnil');
            $this->db->join('tkelas','tkelas.idkelas=tnildetkom.idkelas');
            $this->db->join('mdosen','mdosen.iddosen=tkelas.iddosenkelas');
            $this->db->join('matkul','matkul.idmtk=tkelas.idmtkkls');
            $this->db->join('mkomnil','mkomnil.kodepenilaian=tnildetkom.kodepenilaian');
            $this->db->where('iddosenkelas',$post['iddosen']);
            $this->db->where('idnimnil',$this->session->userdata('userid'));
            $data['table'] = $this->db->get()->result_array();

            $this->db->select('*');
            $this->db->from('tnildetkom');
            $this->db->join('mhsbio', 'mhsbio.idnim = tnildetkom.idnimnil');
            $this->db->join('tkelas', 'tkelas.idkelas = tnildetkom.idkelas');
            $this->db->join('mdosen', 'mdosen.iddosen = tkelas.iddosenkelas');
            $this->db->join('matkul', 'matkul.idmtk = tkelas.idmtkkls');
            $this->db->join('mkomnil', 'mkomnil.kodepenilaian = tnildetkom.kodepenilaian');
            $this->db->where('iddosenkelas', $post['iddosen']);
            $this->db->where('idnimnil', $this->session->userdata('userid'));
            $this->db->select('SUM(tnildetkom.nilperolehan) as total_nilperolehan');
            $data['table1'] = $this->db->get()->row();

            $this->db->where('iddosen',$post['iddosen']);
            $this->db->join('mdosen','mdosen.iddosen=tkelas.iddosenkelas');
            $this->db->join('matkul','matkul.idmtk=tkelas.idmtkkls');
            $data['tkelas'] = $this->db->get('tkelas')->row();



        }

        $data['indukmenu'] = 'BB030000';
        $data['submenu'] = 'BB030200';
        $data['mmenu'] = $this->MenuModel->listmenu('BB');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('mahasiswa/hasilstudi/hasilstudisemester/index');
        $this->load->view('layout/home/footer');
    }

}