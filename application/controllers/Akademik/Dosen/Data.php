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

    public function index(){
        $post= $this->input->post();
        $get= $this->input->get();
        //
        $this->db->join('mfakul','mfakul.idfak=mprodi.idfak');
        $this->db->order_by('urutfak','ASC');
        $this->db->order_by('urutprodi','ASC');
        $data['mprodi']= $this->db->get('mprodi')->result_array();
        $data['table'] = [];
        $data['idprodidosen'] = '';
        //

        if ($post || $get) {
            if (!$post) {
                $post = $get;
            }
            $data['idprodidosen'] = $post['idprodidosen'];
            $this->db->join('mprodi','mprodi.idprodi=mdosen.idprodidosen');
            $this->db->where('idprodidosen',$post['idprodidosen']);
            $data['table'] =$this->db->get('mdosen')->result_array();
        }
        $data['indukmenu'] = 'BE030000';
        $data['submenu'] = 'BE030100';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/dosen/data/index');
        $this->load->view('layout/home/footer');
    }

    public function form($idprodidosen)
    {
        $iddosen = $this->input->get('iddosen');

        $data['jenis'] = 'TAMBAH';
        if ($iddosen) {
            $data['jenis'] = 'EDIT';
            $this->db->where('iddosen', $iddosen);
            $data['mdosen'] = $this->db->get('mdosen')->row();
        }
        $this->db->where('idprodi',$idprodidosen);
        $data['mprodi'] = $this->db->get('mprodi')->row();
        $data['indukmenu'] = 'BE030000';
        $data['submenu'] = 'BE030100';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/dosen/data/form');
        $this->load->view('layout/home/footer');
    }

    public function simpan($jenis)
    {
        $post = $this->input->post();
        if ($jenis == 'TAMBAH') {
            $this->db->where('iddosen',$post['iddosen']);
            $cek_id = $this->db->get('mdosen')->row();
            if ($cek_id) {
                $this->session->set_userdata('errormsg','Id Dosen sudah di gunakan');
                redirect($SERVER['HTTP_REFERER']);
            }
            $data['fotodosen'] = '';
            $fotodosen = $_FILES['fotodosen']['name'];
            $config['upload_path'] = './assets/img';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '2048';
            $this->load->library('upload',$config);
            if(!$this->upload->do_upload('fotodosen')){
                echo 'Gambar gagal di upload';
            }else{
                $fotodosen = $this->upload->data('file_name');
                $data['fotodosen'] = $fotodosen; 
            }
            $insert = [
                'iddosen' => $post['iddosen'],
                'namadosen'=> $post['namadosen'],
                'nomornidn'=> $post['nomornidn'],
                'idprodidosen'=> $post['idprodidosen'],
                'namalengkap'=> $post['namalengkap'],
                'nomorwa'=> $post['nomorwa'],
                'gelardepan'=> $post['gelardepan'],
                'gelarbelakang'=> $post['gelarbelakang'],
                'tgllhrdosen'=> $post['tgllhrdosen'],
                'tptlhrdosen'=> $post['tptlhrdosen'],
                'jnsklmdsn'=> $post['jnsklmdsn'],
                'emailpt'=> $post['emailpt'],
                'emailpribadi'=> $post['emailpribadi'],
                'alamattinggal'=> $post['alamattinggal'],
                'ikatankerja'=> $post['ikatankerja'],
                'jbtakad'=> $post['jbtakad'],
                'gelartinggi'=> $post['gelartinggi'],
                'aktaajar'=> $post['aktaajar'],
                'ijinajar'=> $post['ijinajar'],
                'aktifitas'=> $post['aktifitas'],
                'stataktdsn'=> $post['stataktdsn'],
                'nikdosen'=> $post['nikdosen'],
                'fotodosen'=> $fotodosen,
                
            ];
            $this->db->insert('mdosen',$insert);
        }elseif ($jenis == "EDIT") 
        {
           $data['fotodosen'] = '';
            $fotodosen = $_FILES['fotodosen']['name'];
            $config['upload_path'] = './assets/img';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '2048';
            $this->load->library('upload',$config);
            if(!$this->upload->do_upload('fotodosen')){
                echo 'Gambar gagal di upload';
            }else{
                $fotodosen = $this->upload->data('file_name');
                $data['fotodosen'] = $fotodosen; 
            }
            $upadate = [
                'iddosen'=> $post['iddosen'],
                'namadosen'=> $post['namadosen'],
                'nomornidn'=> $post['nomornidn'],
                'idprodidosen'=> $post['idprodidosen'],
                'namalengkap'=> $post['namalengkap'],
                'nomorwa'=> $post['nomorwa'],
                'emailpt'=> $post['emailpt'],
                'gelardepan'=> $post['gelardepan'],
                'gelarbelakang'=> $post['gelarbelakang'],
                'tgllhrdosen'=> $post['tgllhrdosen'],
                'tptlhrdosen'=> $post['tptlhrdosen'],
                'jnsklmdsn'=> $post['jnsklmdsn'],
                'emailpribadi'=> $post['emailpribadi'],
                'alamattinggal'=> $post['alamattinggal'],
                'ikatankerja'=> $post['ikatankerja'],
                'jbtakad'=> $post['jbtakad'],
                'gelartinggi'=> $post['gelartinggi'],
                'aktaajar'=> $post['aktaajar'],
                'ijinajar'=> $post['ijinajar'],
                'aktifitas'=> $post['aktifitas'],
                'stataktdsn'=> $post['stataktdsn'],
                'nikdosen'=> $post['nikdosen'],
                'fotodosen'=> $fotodosen,
            ];
            $this->db->update('mdosen',$upadate,['iddosen'=>$post['iddosen'],]);
        }
        $this->session->set_userdata('successmsg','Data berhasil di simpan');
        redirect('Akademik/Dosen/data?idprodidosen='.$post['idprodidosen']);
    }

    public function delete($iddosen)
    {
        $this->db->delete('mdosen',['iddosen' => $iddosen]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect('Akademik/Dosen/data');
    }

    public function ajax_cekIdDosen()
    {
        $iddosen = $this->input->post('iddosen');
        $this->db->where('iddosen',$iddosen);
        $cek_id = $this->db->get('mdosen')->row();
        if($cek_id){
            echo '201';
        } else {
            echo '200';
        }
    }
}