<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {


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
        $post= $this->input->post();
        $get= $this->input->get();
        //
        $this->db->join('mfakul','mfakul.idfak=mprodi.idfak');
        $this->db->order_by('urutfak','ASC');
        $this->db->order_by('urutprodi','ASC');
        $data['mprodi']= $this->db->get('mprodi')->result_array();
        $data['table'] = [];
        $data['idprodimhs'] = '';
        //

        if ($post || $get) {
            if (!$post) {
                $post = $get;
            }
            $data['idprodimhs'] = $post['idprodimhs'];
            $this->db->join('mprodi','mprodi.idprodi=mhsbio.idprodimhs');
            $this->db->where('idprodimhs',$post['idprodimhs']);
            $data['table'] =$this->db->get('mhsbio')->result_array();
        }
        $data['indukmenu'] = 'BE040000';
        $data['submenu'] = 'BE040100';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/mahasiswa/data/index');
        $this->load->view('layout/home/footer');
    }

    public function form($idprodimhs)
    {
        $idnim = $this->input->get('idnim');

        $data['jenis'] = 'TAMBAH';
        if ($idnim) {
            $data['jenis'] = 'EDIT';
            $this->db->where('idnim', $idnim);
            $data['mhsbio'] = $this->db->get('mhsbio')->row();
        }
        $this->db->where('idprodi',$idprodimhs);
        $data['mprodi'] = $this->db->get('mprodi')->row();
        $data['indukmenu'] = 'BE040000';
        $data['submenu'] = 'BE040100';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/mahasiswa/data/form');
        $this->load->view('layout/home/footer');
    }

    public function simpan($jenis)
    {
        $post = $this->input->post();
        if ($jenis == 'TAMBAH') {
            $this->db->where('idnim',$post['idnim']);
            $cek_id = $this->db->get('mhsbio')->row();
            if ($cek_id) {
                $this->session->set_userdata('errormsg','Id MAHASISWA sudah di gunakan');
                redirect($SERVER['HTTP_REFERER']);
            }
            $insert = [
                'idnim'=> $post['idnim'],
                'namamhs'=> $post['namamhs'],
                'tptlhrmhs' => $post['tptlhrmhs'],
                'tgllhrmhs'=> $post['tgllhrmhs'],
                'agamamhs'=> $post['agamamhs'],
                'idprodimhs'=> $post['idprodimhs'],
                'jnsklm'=> $post['jnsklm'],
                'nomorhpwa'=> $post['nomorhpwa'],
                'emailstudi'=> $post['emailstudi'],
                'emailpribadi'=> $post['emailpribadi'],
                'alamatakhir'=> $post['alamatakhir'],
                'alamatasal'=> $post['alamatasal'],
                'stataktif'=> $post['stataktif'],
            ];
            $this->db->insert('mhsbio',$insert);
        }elseif ($jenis == "EDIT") 
        {
            $upadate = [
                'namamhs'=> $post['namamhs'],
                'tgllhrmhs'=> $post['tgllhrmhs'],
                'tptlhrmhs' => $post['tptlhrmhs'],
                'agamamhs'=> $post['agamamhs'],
                'idprodimhs'=> $post['idprodimhs'],
                'jnsklm'=> $post['jnsklm'],
                'nomorhpwa'=> $post['nomorhpwa'],
                'emailstudi'=> $post['emailstudi'],
                'emailpribadi'=> $post['emailpribadi'],
                'alamatakhir'=> $post['alamatakhir'],
                'alamatasal'=> $post['alamatasal'],
                'stataktif'=> $post['stataktif'],
            ];
            $this->db->update('mhsbio',$upadate,['idnim'=>$post['idnim'],]);
        }
        $this->session->set_userdata('successmsg','Data berhasil di simpan');
        redirect('Akademik/Mahasiswa/Data?idprodimhs='.$post['idprodimhs']);
    }

    public function delete($idnim)
    {
        $this->db->delete('mhsbio',['idnim' => $idnim]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect('Akademik/Mahasiswa/Data');
    }

    public function ajax_cekIdMahasiswa()
    {
        $idnim = $this->input->post('idnim');
        $this->db->where('idnim',$idnim);
        $cek_id = $this->db->get('mhsbio')->row();
        if($cek_id){
            echo '201';
        } else {
            echo '200';
        }
    }
}