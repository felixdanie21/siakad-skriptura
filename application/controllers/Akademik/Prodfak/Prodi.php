<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prodi extends CI_Controller {


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
        $this->db->join('mfakul','mfakul.idfak=mprodi.idfak');
        $this->db->order_by('urutfak','ASC');
        $this->db->order_by('urutprodi','ASC');
        $data['table'] = $this->db->get('mprodi')->result_array();
        $data['indukmenu'] = 'BE060000';
        $data['submenu'] = 'BE060200';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/prodfak/prodi/index');
        $this->load->view('layout/home/footer');
    }

    public function form()
    {
        $data['jenis'] = 'TAMBAH';
        $this->db->order_by('namalengkap',"ASC");
        $data['mdosen'] = $this->db->get('mdosen')->result_array();
        $this->db->order_by('urutfak','ASC');
        $data['mfakul'] = $this->db->get('mfakul')->result_array();
        // edit
        $idprodi = $this->input->get('idprodi');
        if($idprodi){
            $data['jenis'] = 'EDIT';
            $this->db->where('idprodi',$idprodi);
            $data['mprodi'] = $this->db->get('mprodi')->row();
            $this->db->where('idprodidosen',$idprodi);
            $this->db->order_by('namalengkap',"ASC");
            $data['mdosen'] = $this->db->get('mdosen')->result_array();
        }
        
        $data['indukmenu'] = 'BE060000';
        $data['submenu'] = 'BE060200';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/prodfak/prodi/form');
        $this->load->view('layout/home/footer');
    }

    public function simpan($jenis)
    {
        $post = $this->input->post();
        if($jenis == 'TAMBAH'){
            $this->db->where('idprodi',$post['idprodi']);
            $cek_id = $this->db->get('mprodi')->row();
            if($cek_id){
                $this->session->set_userdata('errormsg','Id fakultas sudah digunakan');
                redirect($_SERVER['HTTP_REFERER']);
            }

            // upload gambar
            $gambarakre = '';
            if ($_FILES['gambarakre']['tmp_name']) {
                $config['upload_path'] = $this->pturl . 'assets/img/prodi';
                $config['allowed_types'] = 'png|jpg|jpeg';
                $config['max_size'] = '3000';
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambarakre')) {
                    $this->session->set_userdata('errormsg', 'FOTO MAXIMAL 3MB');
                    redirect($_SERVER['HTTP_REFERER']);
                }
                $gambarakre = $this->upload->data("file_name");
            }

            $insert = [
                'idprodi' => $post['idprodi'],
                'namaprodi' => $post['namaprodi'],
                'urutprodi' => $post['urutprodi'],
                'idfak' => $post['idfak'],
                'iddosenprodi' => $post['iddosenprodi'],
                'statakreprodi' => $post['statakreprodi'],
                'jenjangstudi' => $post['jenjangstudi'],
                'gambarakre' => $gambarakre
            ];
            $this->db->insert('mprodi',$insert);
        } else if($jenis == "EDIT"){
             // upload gambar
             $gambarakre = $post['gambarakrelama'];
             if ($_FILES['gambarakre']['tmp_name']) {
                 $config['upload_path'] = $this->pturl . 'assets/img/prodi';
                 $config['allowed_types'] = 'png|jpg|jpeg';
                 $config['max_size'] = '3000';
                 $config['encrypt_name'] = TRUE;
                 $this->load->library('upload', $config);
                 if (!$this->upload->do_upload('gambarakre')) {
                     $this->session->set_userdata('errormsg', 'FOTO MAXIMAL 3MB');
                     redirect($_SERVER['HTTP_REFERER']);
                 }
                 $gambarakre = $this->upload->data("file_name");
             }

            $update = [
                'namaprodi' => $post['namaprodi'],
                'urutprodi' => $post['urutprodi'],
                'idfak' => $post['idfak'],
                'iddosenprodi' => $post['iddosenprodi'],
                'statakreprodi' => $post['statakreprodi'],
                'jenjangstudi' => $post['jenjangstudi'],
                'gambarakre' => $gambarakre
            ];
            $this->db->update('mprodi',$update,['idprodi' => $post['idprodi']]);
        }
        $this->session->set_userdata('successmsg','Data berhasil disimpan');
        redirect('Akademik/Prodfak/Prodi');
    }

    public function delete($idprodi)
    {
        $this->db->delete('mprodi',['idprodi' => $idprodi]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect('Akademik/Prodfak/Prodi');
    }

    public function ajax_cekIdProdi()
    {
        $idprodi = $this->input->post('idprodi');
        $this->db->where('idprodi',$idprodi);
        $cek_id = $this->db->get('mprodi')->row();
        if($cek_id){
            echo '201';
        } else {
            echo '200';
        }
    }
}