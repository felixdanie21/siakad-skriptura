<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komponenpnl extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
        // cek login
        $this->load->model('Utility');
        $this->load->model('MenuModel');
        $this->Utility->isLogin();
        $this->Utility->modulSecurity('DS');
        // get iden pt
        $this->midenpt = $this->db->get('midenpt')->row();
	}

    public function index()
    {
        $post = $this->input->post();
        $get = $this->input->get();

        $this->db->where('iddosenkelas',$this->session->userdata('userid'));
        $data['tkelas'] = $this->db->get('tkelas')->result_array();

        $this->db->where('iddosen',$this->session->userdata('userid'));
        $data['mdosen'] = $this->db->get('mdosen')->row();
        if($data['mdosen']){
            $data['table'] = [];
            $data['idkelasnil'] = '';
            if($post || $get) {
                if(!$post) {
                    $post = $get;
                }
                $data['idkelasnil'] = $post['idkelasnil'];
                $this->db->select('*');
                $this->db->from('tkomnilbot');
                $this->db->join('tkelas','tkelas.idkelas=tkomnilbot.idkelasnil');
                $this->db->join('mkomnil','mkomnil.kodepenilaian=tkomnilbot.kodepenilaian');
                $this->db->join('mdosen','mdosen.iddosen=tkelas.iddosenkelas');
                $this->db->where('iddosenkelas',$this->session->userdata('userid'));
                $this->db->where('idkelasnil',$post['idkelasnil']);
                $data['table'] = $this->db->get()->result_array();
            }
        }else{
                $this->db->select('*');
                $this->db->from('tkomnilbot');
                $this->db->join('tkelas','tkelas.idkelas=tkomnilbot.idkelasnil');
                $this->db->join('mkomnil','mkomnil.kodepenilaian=tkomnilbot.kodepenilaian');
                $this->db->join('mdosen','mdosen.iddosen=tkelas.iddosenkelas');
                $data['table'] = $this->db->get()->result_array();
        }


        $data['indukmenu'] = 'BD000000';
        $data['submenu'] = 'BD050000';
        $data['mmenu'] = $this->MenuModel->listmenu('BD');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('dosen/komponenpnl/index');
        $this->load->view('layout/home/footer');
    }
    public function form($idkelasnil,$iddosenkelas)
    {
        $idkelasnil1 = $this->input->get('idkelasnil');
        $kodepenilaian = $this->input->get('kodepenilaian');

        $data['jenis'] = 'TAMBAH';
        if ($kodepenilaian) {
            $data['jenis'] = 'EDIT';
            $this->db->where('kodepenilaian', $kodepenilaian);
            $data['tkomnilbot'] = $this->db->get('tkomnilbot')->row();
        }
        $this->db->select('*');
        $this->db->from('tkelas');
        $this->db->join('matkul','matkul.idmtk=tkelas.idmtkkls');
        $this->db->where('idkelas',$idkelasnil);
        $data['tkelas'] = $this->db->get()->row();
        $data['mkomnil'] = $this->db->get('mkomnil')->result_array();

        $this->db->where('iddosen',$iddosenkelas);
        $data['mdosen'] = $this->db->get('mdosen')->row();

        $data['indukmenu'] = 'BD000000';
        $data['submenu'] = 'BD050000';
        $data['mmenu'] = $this->MenuModel->listmenu('BD');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('dosen/komponenpnl/form');
        $this->load->view('layout/home/footer');
    }
    public function simpan($jenis)
    {
        $post = $this->input->post();
        if ($jenis == 'TAMBAH') {
            $this->db->where('kodepenilaian',$post['kodepenilaian']);
            $cek_id = $this->db->get('tkomnilbot')->row();
            if ($cek_id) {
                
            }
            $insert = [
                'idkelasnil'=> $post['idkelasnil'],
                'kodepenilaian'=> $post['kodepenilaian'],
                'bobotprosen'=> $post['bobotprosen'],
            ];
            $this->db->insert('tkomnilbot',$insert);
        }elseif ($jenis == "EDIT") 
        {
            $upadate = [
                'kodepenilaian'=> $post['kodepenilaian'],
                'bobotprosen'=> $post['bobotprosen'],
            ];
            $this->db->update('tkomnilbot',$upadate,['idkelasnil'=>$post['idkelasnil']]);
        }
        $this->session->set_userdata('successmsg','Data berhasil di simpan');
        redirect('Dosen/Komponenpnl/Komponenpnl?idkelasnil=' . $post['idkelasnil']);
    }
    public function delete($namapenilaian,$idkelasnil)
    {
        $this->db->where('idkelasnil',$idkelasnil);
        $this->db->delete('tkomnilbot',['kodepenilaian' => $namapenilaian]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect('Dosen/Komponenpnl/Komponenpnl');
    }
}