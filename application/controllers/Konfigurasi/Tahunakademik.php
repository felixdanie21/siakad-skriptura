<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahunakademik extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
        // cek login
        $this->load->model('Utility');
        $this->load->model('MenuModel');
        $this->Utility->isLogin();
        $this->Utility->modulSecurity('SA');
        // get iden pt
		$this->midenpt = $this->db->get('midenpt')->row();
	}

    public function index()
    {
        $this->db->order_by('tahunakad','DESC');
        $this->db->order_by('jenissemester','DESC');
        $data['table'] = $this->db->get('mthnak')->result_array();
        $data['indukmenu'] = '';
        $data['submenu'] = 'BG020000';
        $data['mmenu'] = $this->MenuModel->listmenu('BG');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('konfigurasi/tahunakademik/index');
        $this->load->view('layout/home/footer');
    }

    public function form()
    {
        $idthn = $this->input->get('idthn');

        $data['jenis'] = 'TAMBAH';
        if ($idthn) {
            $data['jenis'] = 'EDIT';
            $this->db->where('idthn', $idthn);
            $data['mthnak'] = $this->db->get('mthnak')->row();
        }
        $data['indukmenu'] = '';
        $data['submenu'] = 'BG020000';
        $data['mmenu'] = $this->MenuModel->listmenu('BG');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('konfigurasi/tahunakademik/form');
        $this->load->view('layout/home/footer');
    }
    public function simpan($jenis)
    {
        $post = $this->input->post();
        if ($jenis == 'TAMBAH') {
            $idthn = substr($post['tahunakad'],2,2).$post['jenissemester'];
            if($post['jenissemester'] == "1"){
                $ketsemester = "GASAL";
            } elseif($post['jenissemester'] == "2"){
                $ketsemester = "GENAP";
            }
            $nexttahun = $post['tahunakad']+1;
            $kettahunakad = $post['tahunakad'].'/'. $nexttahun ." SEMESTER ".$ketsemester;

            $this->db->where('idthn',$idthn);
            $cek_id = $this->db->get('mthnak')->row();
            if ($cek_id) {
                $this->session->set_userdata('errormsg','Tahun akademik sudah ada');
                redirect($_SERVER['HTTP_REFERER']);
            }

            $insert = [
                'idthn' => $idthn,
                'tahunakad' => $post['tahunakad'],
                'kettahunakad' => $kettahunakad,
                'jenissemester'=> $post['jenissemester'],
            ];
            $this->db->insert('mthnak',$insert);
        } elseif ($jenis == "EDIT") {
            $idthn = substr($post['tahunakad'],2,2).$post['jenissemester'];
            if($post['jenissemester'] == "1"){
                $ketsemester = "GASAL";
            } elseif($post['jenissemester'] == "2"){
                $ketsemester = "GENAP";
            }
            $nexttahun = $post['tahunakad']+1;
            $kettahunakad = $post['tahunakad'].'/'. $nexttahun ." SEMESTER ".$ketsemester;

            $this->db->where('idthn',$idthn);
            $cek_id = $this->db->get('mthnak')->row();
            if ($cek_id) {
                $this->session->set_userdata('errormsg','Tahun akademik sudah ada');
                redirect($_SERVER['HTTP_REFERER']);
            }

            $upadate = [
                'idthn' => $idthn,
                'tahunakad'=> $post['tahunakad'],
                'kettahunakad' => $kettahunakad,
                'jenissemester'=> $post['jenissemester'],
            ];
            $this->db->update('mthnak',$upadate,['idthn'=>$post['idthn']]);
        }
        $this->session->set_userdata('successmsg','Data berhasil di simpan');
        redirect('Konfigurasi/Tahunakademik');
    }

    public function delete($idthn)
    {
        $this->db->delete('mthnak',['idthn' => $idthn]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect('Konfigurasi/Tahunakademik');
    }
    public function ajax_cekIdthn()
    {
        $idthn = $this->input->post('idthn');
        $this->db->where('idthn',$idthn);
        $cek_id = $this->db->get('mthnak')->row();
        if($cek_id){
            echo '201';
        } else {
            echo '200';
        }
    }
}