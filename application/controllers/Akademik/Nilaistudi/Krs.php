<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krs extends CI_Controller {

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

        $this->db->join('mfakul','mfakul.idfak=mprodi.idfak');
        $this->db->order_by('urutfak','ASC');
        $this->db->order_by('urutprodi','ASC');
        $data['mprodi']= $this->db->get('mprodi')->result_array();
        $this->db->order_by('tahunmasuk','DESC');
        $this->db->group_by('tahunmasuk');
        $data['mhsbio'] = $this->db->get('mhsbio')->result_array();

        $data['table'] = [];
        $data['idprodimhs'] = '';
        $data['tahunmasuk'] = '';

        if ($post || $get) {
            if (!$post) {
                $post = $get;
            }
            $this->db->select_max('idthn', 'max_idthnkls');
            $this->db->from('mthnak');
            $max_query = $this->db->get();
            $max_idthnkls = $max_query->row()->max_idthnkls;

            $this->db->select('*');
            $this->db->from('tkrs');
            $this->db->join('mhsbio','mhsbio.idnim=tkrs.idnimkls');
            $this->db->where('idthnkrs',$max_idthnkls);
            $data['tahunterakhir'] = $this->db->get()->result_array();

            
            $data['idprodimhs'] = $post['idprodimhs'];
            $data['tahunmasuk'] = $post['tahunmasuk'];
            $this->db->select('*');
            $this->db->from('mhsbio');
            $this->db->order_by('namamhs','ASC');
            $this->db->join('mprodi','mprodi.idprodi=mhsbio.idprodimhs');
            // $this->db->join('mhsbio','mhsbio.idnim=tkrs.idnimkls');
            // $this->db->where('idthnkrs',$max_idthnkls);
            $this->db->where('idprodimhs',$post['idprodimhs']);
            $this->db->where('tahunmasuk',$post['tahunmasuk']);
            $this->db->order_by('namamhs','ASC');
            $data['table'] = $this->db->get()->result_array();
            

            

        }
        $data['indukmenu'] = 'BE010000';
        $data['submenu'] = 'BE010100';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/nilaistudi/krs/index');
        $this->load->view('layout/home/footer');
    }

    public function form()
    {
        $idnimkls = $this->input->get('idnimkls');
        $data['jenis'] = 'TAMBAH';
        if ($idnimkls) {
            $data['jenis'] = 'EDIT';
            $this->db->where('idnimkls', $idnimkls);
            $data['tkrs'] = $this->db->get('tkrs')->row();
        }
        $data['mhsbio'] = $this->db->get('mhsbio')->result_array();
        $data['tkelas'] = $this->db->get('tkelas')->result_array();
        $data['indukmenu'] = 'BE010000';
        $data['submenu'] = 'BE010100';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/nilaistudi/krs/form');
        $this->load->view('layout/home/footer');
    }

    public function simpan($jenis)
    {
        $post = $this->input->post();
        if ($jenis == 'TAMBAH') {
            $this->db->where('idnimkls',$post['idnimkls']);
            $cek_id = $this->db->get('tkrs')->row();
            if ($cek_id) {
                $this->session->set_userdata('errormsg','Id Krs sudah di gunakan');
                redirect($SERVER['HTTP_REFERER']);
            }
            $insert = [
                'idnimkls'=> $post['idnimkls'],
                'idkelaskrs'=> $post['idkelaskrs'],
                'rwymtkmhs'=> $post['rwymtkmhs'],
                'sksmtk'=> $post['sksmtk'],
                'bobotnilai'=> $post['bobotnilai'],
                'nilaikrs'=> $post['nilaikrs'],
            ];
            $this->db->insert('tkrs',$insert);
        } elseif ($jenis == "EDIT") {
            $upadate = [
                'idnimkls'=> $post['idnimkls'],
                'idkelaskrs'=> $post['idkelaskrs'],
                'rwymtkmhs'=> $post['rwymtkmhs'],
                'sksmtk'=> $post['sksmtk'],
                'bobotnilai'=> $post['bobotnilai'],
                'nilaikrs'=> $post['nilaikrs'],
            ];
            $this->db->update('tkrs',$upadate,['idnimkls'=>$post['idnimkls'],]);
        }
        $this->session->set_userdata('successmsg','Data berhasil di simpan');
        redirect('Akademik/Nilaistudi/Krs');
    }
    public function ajax_cekRiwayat()
    {
        $statuskrs = $this->input->post('statuskrs');
        $this->db->where('idnimkls',$statuskrs);
        $cek_id = $this->db->get('tkrs')->row();
        if($cek_id){
            echo '201';
        } else {
            echo '200';
        }
    }

}