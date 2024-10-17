<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ruangkuliah extends CI_Controller {


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

        $data['table'] = $this->db->get('mruang')->result_array();
        $data['indukmenu'] = 'BE020000';
        $data['submenu'] = 'BE020300';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/aturkelas/ruangkuliah/index');
        $this->load->view('layout/home/footer');
    }

    public function form()
    {
        $koderuang = $this->input->get('koderuang');
        $data['jenis'] = 'TAMBAH';
        if ($koderuang) {
            $data['jenis'] = 'EDIT';
            $this->db->where('koderuang', $koderuang);
            $data['mruang'] = $this->db->get('mruang')->row();
        }
        $data['indukmenu'] = 'BE020000';
        $data['submenu'] = 'BE020300';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/aturkelas/ruangkuliah/form');
        $this->load->view('layout/home/footer');
    }

    public function simpan($jenis)
    {
        $post = $this->input->post();
        if ($jenis == 'TAMBAH') {
            $this->db->where('koderuang',$post['koderuang']);
            $cek_id = $this->db->get('mruang')->row();
            if ($cek_id) {
                $this->session->set_userdata('errormsg','Kode Ruang sudah di gunakan');
                redirect($SERVER['HTTP_REFERER']);
            }
            $insert = [
                'koderuang'=> $post['koderuang'],
                'namaruang'=> $post['namaruang'],
                'kapasitasruang'=> $post['kapasitasruang'],
                'jenisruang'=> $post['jenisruang'],
                'statusruang'=> $post['statusruang'],
                'namaruang'=> $post['namaruang'],
            ];
            $this->db->insert('mruang',$insert);
        }elseif ($jenis == "EDIT") 
        {
            $upadate = [
                'namaruang'=> $post['namaruang'],
                'kapasitasruang'=> $post['kapasitasruang'],
                'jenisruang'=> $post['jenisruang'],
                'statusruang'=> $post['statusruang'],
                'namaruang'=> $post['namaruang'],
            ];
            $this->db->update('mruang',$upadate,['koderuang'=>$post['koderuang']]);
        }
        $this->session->set_userdata('successmsg','Data berhasil di simpan');
        redirect('Akademik/Aturkelas/Ruangkuliah');
    }

    public function delete($koderuang)
    {
        $this->db->delete('mruang',['koderuang' => $koderuang]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect('Akademik/Aturkelas/Ruangkuliah');
    }

    public function ajax_cekKodeRuang()
    {
        $koderuang = $this->input->post('koderuang');
        $this->db->where('koderuang',$koderuang);
        $cek_id = $this->db->get('mruang')->row();
        if($cek_id){
            echo '201';
        } else {
            echo '200';
        }
    }
}