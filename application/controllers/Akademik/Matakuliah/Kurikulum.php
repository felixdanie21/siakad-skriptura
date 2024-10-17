<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kurikulum extends CI_Controller {


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
        $data['table'] = $this->db->get('mkurikulum')->result_array();
        $data['indukmenu'] = 'BE050000';
        $data['submenu'] = 'BE050400';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/matakuliah/kurikulum/index');
        $this->load->view('layout/home/footer');
    }
    public function form()
    {
        $idkuri = $this->input->get('idkuri');

        $data['jenis'] = 'TAMBAH';
        if ($idkuri) {
            $data['jenis'] = 'EDIT';
            $this->db->where('idkuri', $idkuri);
            $data['mkurikulum'] = $this->db->get('mkurikulum')->row();
        }
        $data['indukmenu'] = 'BE050000';
        $data['submenu'] = 'BE050400';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/matakuliah/kurikulum/form');
        $this->load->view('layout/home/footer');
    }
    public function simpan($jenis)
    {
        $post = $this->input->post();
        if ($jenis == 'TAMBAH') {
            $this->db->where('idkuri ',$post['idkuri ']);
            $cek_id = $this->db->get('mkurikulum')->row();
            if ($cek_id) {
                $this->session->set_userdata('errormsg','Id Jenis Matakuliah sudah di gunakan');
                redirect($SERVER['HTTP_REFERER']);
            }
            $insert = [
                'idkuri '=> $post['idkuri'],
                'namakuri'=> $post['namakuri'],
                'statusaktifkuri'=> $post['statusaktifkuri'],
                'ketkuri'=> $post['ketkuri'],
            ];
            $this->db->insert('mkurikulum',$insert);
        }elseif ($jenis == "EDIT") 
        {
            $upadate = [
                'namakuri'=> $post['namakuri'],
                'statusaktifkuri'=> $post['statusaktifkuri'],
                'ketkuri'=> $post['ketkuri'],
            ];
            $this->db->update('mkurikulum',$upadate,['idkuri '=>$post['idkuri']]);
        }
        $this->session->set_userdata('successmsg','Data berhasil di simpan');
        redirect('Akademik/Matakuliah/Kurikulum');
    }
    public function delete($idkuri)
    {
        $this->db->delete('mjnsmtk',['idkuri' => $idkuri]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect('Akademik/Matakuliah/Kurikulum');
    }

    public function ajax_cekIdMkurikulim()
    {
        $idkuri = $this->input->post('idkuri');
        $this->db->where('idkuri',$idkuri);
        $cek_id = $this->db->get('mkurikulum')->row();
        if($cek_id){
            echo '201';
        } else {
            echo '200';
        }
    }
}
