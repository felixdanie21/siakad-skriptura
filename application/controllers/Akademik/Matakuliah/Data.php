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
        
        $this->db->join('mfakul','mfakul.idfak=mprodi.idfak');
        $this->db->order_by('urutfak','ASC');
        $this->db->order_by('urutprodi','ASC');
        $data['mprodi']= $this->db->get('mprodi')->result_array();

        $this->db->order_by('namakuri','ASC');
        $data['mkurikulum']= $this->db->get('mkurikulum')->result_array();

        $data['table'] = [];
        $data['idkurmtk'] = '';
        $data['idprodimtk'] = '';
        $data['jnsmtk'] = '';
        if ($post || $get) {
            if (!$post) {
                $post = $get;
            }
            $data['idkurmtk'] = $post['idkurmtk'];
            $data['idprodimtk'] = $post['idprodimtk'];

            $this->db->order_by('smsmtk','ASC');
            $this->db->order_by('jnssms','ASC');
            $this->db->join('mprodi','mprodi.idprodi=matkul.idprodimtk');
            // $this->db->join('mjnsmtk','mjnsmtk.idjenis=matkul.jnsmtk');
            $this->db->join('mkurikulum','mkurikulum.idkuri=matkul.idkurmtk');
            $this->db->where('idkurmtk',$post['idkurmtk']);
            $this->db->where('idprodimtk',$post['idprodimtk']);
            $data['table'] =$this->db->get('matkul')->result_array();
        }
        $data['indukmenu'] = 'BE050000';
        $data['submenu'] = 'BE050100';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/matakuliah/data/index');
        $this->load->view('layout/home/footer');
    }

    public function form($idprodimtk,$idkurmtk)
    {
        $idmtk = $this->input->get('idmtk');

        $data['jenis'] = 'TAMBAH';
        if ($idmtk) {
            $data['jenis'] = 'EDIT';
            $this->db->where('idmtk', $idmtk);
            $data['matkul'] = $this->db->get('matkul')->row();
        }
        $this->db->where('idprodi',$idprodimtk);
        $data['mprodi'] = $this->db->get('mprodi')->row();
        $this->db->where('idkuri',$idkurmtk);
        $data['mkurikulum'] = $this->db->get('mkurikulum')->row();
        $data['mjenis'] = $this->db->get('mjnsmtk')->result_array();
        $data['indukmenu'] = 'BE050000';
        $data['submenu'] = 'BE050100';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/matakuliah/data/form');
        $this->load->view('layout/home/footer');
    }

    public function simpan($jenis)
    {
        $post = $this->input->post();
        if ($jenis == 'TAMBAH') {
            $this->db->where('idmtk',$post['idmtk']);
            $cek_id = $this->db->get('matkul')->row();
            if ($cek_id) {
                $this->session->set_userdata('errormsg','Id matkul sudah di gunakan');
                redirect($SERVER['HTTP_REFERER']);
            }
            $insert = [
                'idmtk'=> $post['idmtk'],
                'idkurmtk'=> $post['idkurmtk'],
                'idprodimtk'=> $post['idprodimtk'],
                'namamtk'=> $post['namamtk'],
                'smsmtk'=> $post['smsmtk'],
                'sksmtk'=> $post['sksmtk'],
                'jnsmtk'=> $post['jnsmtk'],
                'jnssms'=> $post['jnssms'],
                'tipemtk'=> $post['tipemtk'],
                'nilailulus'=> $post['nilailulus'],
                'kodemtkpddikti'=> $post['kodemtkpddikti'],
            ];
            $this->db->insert('matkul',$insert);
        }elseif ($jenis == "EDIT") 
        {
            $upadate = [
                'namamtk'=> $post['namamtk'],
                'idkurmtk'=> $post['idkurmtk'],
                'idprodimtk'=> $post['idprodimtk'],
                'smsmtk'=> $post['smsmtk'],
                'sksmtk'=> $post['sksmtk'],
                'jnsmtk'=> $post['jnsmtk'],
                'jnssms'=> $post['jnssms'],
                'tipemtk'=> $post['tipemtk'],
                'nilailulus'=> $post['nilailulus'],
                'kodemtkpddikti'=> $post['kodemtkpddikti'],
            ];
            $this->db->update('matkul',$upadate,['idmtk'=>$post['idmtk']]);
        }
        $this->session->set_userdata('successmsg','Data berhasil di simpan');
        redirect('Akademik/Matakuliah/Data?idkurmtk='.$post['idkurmtk'].'&idprodimtk='.$post['idprodimtk']);
    }

    public function delete($idmtk)
    {
        $matkul = $this->db->get_where('matkul',['idmtk'=>$idmtk])->row();
        $this->db->delete('matkul',['idmtk' => $idmtk]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect('Akademik/Matakuliah/Data?idkurmtk='.$matkul->idkurmtk.'&idprodimtk='.$matkul->idprodimtk);
    }

    public function ajax_cekIdMatkul()
    {
        $idmtk = $this->input->post('idmtk');
        $this->db->where('idmtk',$idmtk);
        $cek_id = $this->db->get('matkul')->row();
        if($cek_id){
            echo '201';
        } else {
            echo '200';
        }
    }

}