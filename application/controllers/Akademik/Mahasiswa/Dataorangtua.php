<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dataorangtua extends CI_Controller {


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
    public function index($idnim)
    {
        $post = $this->input->post();
        $get = $this->input->get();

        $data['idnim'] = $idnim;
        $this->db->where('idnim',$data['idnim']);
        $data['mhsbio'] = $this->db->get('mhsbio')->row();
        $this->db->join('mhsbio','mhsbio.idnim=mhsprf.idnim');
        $this->db->where('mhsprf.idnim',$data['idnim']);
        $data['table'] = $this->db->get('mhsprf')->result_array();

        $data['indukmenu'] = 'BE040000';
        $data['submenu'] = 'BE040100';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/mahasiswa/Dataorangtua/index');
        $this->load->view('layout/home/footer');
    }
    public function form($idnim)
    {
        $data['jenis'] = 'TAMBAH';
        $this->db->where('idnim', $idnim);
        $data['mhsprf'] = $this->db->get('mhsprf')->row();
        $this->db->where('idnim',$idnim);
        $data['mhsbio'] = $this->db->get('mhsbio')->row();
        if ($data['mhsprf']) {
            $data['jenis'] = 'EDIT';
        }
        $data['indukmenu'] = 'BB040000';
        $data['submenu'] = 'BB040100';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/mahasiswa/Dataorangtua/form');
        $this->load->view('layout/home/footer');
    }

    public function simpan($jenis)
    {
        $post = $this->input->post();
        if ($jenis == 'TAMBAH') {
            $this->db->where('idnim',$post['idnim']);
            $cek_id = $this->db->get('mhsprf')->row();
            if ($cek_id) {
                $this->session->set_userdata('errormsg','Id MAHASISWA sudah di gunakan');
                redirect($SERVER['HTTP_REFERER']);
            }
            $insert = [
                'idnim'=> $post['idnim'],
                'namabapak'=> $post['namabapak'],
                'kerjabapak' => $post['kerjabapak'],
                'alamatortu'=> $post['alamatortu'],
                'penghasilanortu'=> $post['penghasilanortu'],
                'nomorhpwaortu'=> $post['nomorhpwaortu'],
                'namaibu'=> $post['namaibu'],
                'kerjaibu'=> $post['kerjaibu'],
                'asalsekolah'=> $post['asalsekolah'],
                'jurusansekolah'=> $post['jurusansekolah'],
            ];
            $this->db->insert('mhsprf',$insert);
        }elseif ($jenis == "EDIT") 
        {
            $upadate = [
                'namabapak'=> $post['namabapak'],
                'kerjabapak' => $post['kerjabapak'],
                'alamatortu'=> $post['alamatortu'],
                'penghasilanortu'=> $post['penghasilanortu'],
                'nomorhpwaortu'=> $post['nomorhpwaortu'],
                'namaibu'=> $post['namaibu'],
                'kerjaibu'=> $post['kerjaibu'],
                'asalsekolah'=> $post['asalsekolah'],
                'jurusansekolah'=> $post['jurusansekolah'],
            ];
            $this->db->update('mhsprf',$upadate,['idnim'=>$post['idnim'],]);
        }
        $this->session->set_userdata('successmsg','Data berhasil di simpan');
        redirect('Akademik/Mahasiswa/Dataorangtua/index/'.$post['idnim']);
    }

    public function delete($idnim)
    {
        $this->db->delete('mhsprf',['idnim' => $idnim]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect('Akademik/Mahasiswa/Dataorangtua/index/'.$idnim);
    }
}


    