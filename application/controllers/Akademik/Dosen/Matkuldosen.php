<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Matkuldosen extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
        // cek login
        $this->load->model('Utility');
        $this->load->model('MenuModel');
        $this->Utility->isLogin();
        // get iden pt
        $this->midenpt = $this->db->get('midenpt')->row();
	}
    public function index()
    {
        $post= $this->input->post();
        $get= $this->input->get();
        
        $this->db->order_by('iddosen ','ASC');
        $data['mdosen'] = $this->db->get('mdosen')->result_array();

        $data['table'] = [];
        $data['iddosenmtk'] ='';
        $data['idmtkdsn'] ='';
        if ($post || $get) {
            if (!$post) {
                $post = $get;
            }
            $data['iddosenmtk'] = $post['iddosenmtk'];
            $this->db->join('mdosen','mdosen.iddosen=mdsnmtk.iddosenmtk');
            $this->db->join('matkul','matkul.idmtk=mdsnmtk.idmtkdsn');
            $this->db->where('iddosen',$post['iddosenmtk']);
            $data['table'] =$this->db->get('mdsnmtk')->result_array();
        }
        $data['indukmenu'] = 'BE030000';
        $data['submenu'] = 'BE030200';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/dosen/matkul/index');
        $this->load->view('layout/home/footer');
    }
    public function form($iddosenmtk)
    {
        $idmtkdsn  = $this->input->get('idmtkdsn');
        
        $data['jenis'] = 'TAMBAH';
        if ($idmtkdsn) {
            $data['jenis'] = 'EDIT';
            $this->db->where('idmtkdsn', $idmtkdsn);
            $data['mdsnmtk'] = $this->db->get('mdsnmtk')->row();
        }
        $this->db->where('iddosen',$iddosenmtk);
        $data['mdosen'] = $this->db->get('mdosen')->row();
        $data['matkul'] = $this->db->get('matkul')->result_array();

        $data['indukmenu'] = 'BE030000';
        $data['submenu'] = 'BE030200';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/dosen/matkul/form');
        $this->load->view('layout/home/footer');
    }
    public function simpan($jenis)
    {
        $post = $this->input->post();
        $old_idmtkdsn = $post['old_idmtkdsn'];
    
        if ($jenis == 'TAMBAH') {
            $this->db->where('iddosenmtk', $post['iddosenmtk']);
            $this->db->where('idmtkdsn', $post['idmtkdsn']);
            $cek_data = $this->db->get('mdsnmtk')->row();
    
            if ($cek_data) {
                $this->session->set_userdata('errormsg', 'Matakuliah sudah ditambahkan untuk Dosen ini');
                redirect($_SERVER['HTTP_REFERER']);
            }
            $insert = [
                'iddosenmtk' => $post['iddosenmtk'],
                'idmtkdsn' => $post['idmtkdsn'],
            ];
            $this->db->insert('mdsnmtk', $insert);
        } else {
            // Periksa apakah ada entri dengan iddosenmtk dan idmtkdsn yang baru
            $this->db->where('iddosenmtk', $post['iddosenmtk']);
            $this->db->where('idmtkdsn', $post['idmtkdsn']);
            $cek_id = $this->db->get('mdsnmtk')->row();
    
            if (!$cek_id) {
                // Jika tidak ada, maka lakukan pembaruan
                $update = [
                    'idmtkdsn' => $post['idmtkdsn'],
                ];
                $this->db->update('mdsnmtk', $update, ['iddosenmtk' => $post['iddosenmtk'], 'idmtkdsn' => $old_idmtkdsn]);
            }
        }
        $this->session->set_userdata('successmsg', 'Data berhasil disimpan');
        redirect('Akademik/Dosen/Matkuldosen?iddosenmtk=' . $post['iddosenmtk']);
    }
    



    public function delete($idmtkdsn)
    {
        $mdsnmtk = $this->db->get_where('mdsnmtk',['idmtkdsn'=>$idmtkdsn])->row();
        $this->db->delete('mdsnmtk',['idmtkdsn' => $idmtkdsn]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect('Akademik/Dosen/Matkuldosen?iddosenmtk='. $post['iddosenmtk']);
    }
    public function ajax_cekIdMtksyr()
    {
        $idmtkdsn = $this->input->post('idmtkdsn');
        $this->db->where('idmtkdsn',$idmtkdsn);
        $cek_id = $this->db->get('mdsnmtk')->row();
        if($cek_id){
            echo '201';
        } else {
            echo '200';
        }
    }
}