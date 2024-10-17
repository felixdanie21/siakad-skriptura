<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tawarmatkul extends CI_Controller {


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
        $this->db->join('mfakul','mfakul.idfak=mprodi.idfak');
        $this->db->order_by('urutfak','ASC');
        $this->db->order_by('urutprodi','ASC');
        $data['mprodi']= $this->db->get('mprodi')->result_array();
        $this->db->order_by('tahunakad','DESC');
        $this->db->order_by('jenissemester','DESC');
        $data['mthnak']= $this->db->get('mthnak')->result_array();
        
        $data['table'] = [];
        $data['idthnkls'] = '';
        $data['idprodikls'] = '';
        if ($post || $get) {
            if (!$post) {
                $post = $get;
            }
            $data['idthnkls'] = $post['idthnkls'];
            $data['idprodikls'] = $post['idprodikls'];
            $this->db->order_by('matkul.namamtk','ASC');
            $this->db->order_by('idkelas','ASC');
            $this->db->join('mthnak','mthnak.idthn=tkelas.idthnkls');
            $this->db->join('matkul','matkul.idmtk=tkelas.idmtkkls');
            $this->db->join('mprodi','mprodi.idprodi=matkul.idprodimtk');
            $this->db->join('mdosen','mdosen.iddosen=tkelas.iddosenkelas');
            $this->db->join('mruang','mruang.koderuang=tkelas.koderuangkelas');
            $this->db->where('idthnkls',$post['idthnkls']);
            $this->db->where('idprodimtk',$post['idprodikls']);
            $data['table'] =$this->db->get('tkelas')->result_array();
        }
        $data['indukmenu'] = 'BE020000';
        $data['submenu'] = 'BE020100';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/aturkelas/tawarmatkul/index');
        $this->load->view('layout/home/footer');
    }

    public function form($idprodikls,$idthnkls)
    {
        $idkelas = $this->input->get('idkelas');
        $data['jenis'] = 'TAMBAH';
        if ($idkelas) {
            $data['jenis'] = 'EDIT';
            $this->db->where('idkelas', $idkelas);
            $data['tkelas'] = $this->db->get('tkelas')->row();
        }
        $this->db->where('idprodi',$idprodikls);
        $data['mprodi'] = $this->db->get('mprodi')->row();
        $this->db->where('idthn',$idthnkls);
        $data['mthnak'] = $this->db->get('mthnak')->row();
        $this->db->order_by('namadosen','ASC');
        $data['mdosen'] = $this->db->get('mdosen')->result_array();
        $this->db->order_by('namamtk','ASC');
        $data['matkul'] = $this->db->get('matkul')->result_array();
        $data['mruang'] = $this->db->get('mruang')->result_array();
        $data['indukmenu'] = 'BE020000';
        $data['submenu'] = 'BE020100';
        $data['mmenu'] = $this->MenuModel->listmenu('BE');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('akademik/aturkelas/tawarmatkul/form');
        $this->load->view('layout/home/footer');
    }

    public function simpan($jenis)
    {
        $post = $this->input->post();
        $idmtkkls = $post['idmtkkls']; // ambil nilai input id matakuliah
        $idthnkls = $post['idthnkls'];
        $post = $this->input->post();
        if ($jenis == 'TAMBAH') {
            $this->db->where('idthnkls',$idthnkls);
            $this->db->where('idmtkkls',$idmtkkls);
            $this->db->order_by('idkelas','DESC');
            $tkelas = $this->db->get('tkelas')->row();
            if($tkelas) // jika data yg dicari ada
            {
                // simpan nilai id kelas dari data terakhir
                $idkelas_old = $tkelas->idkelas;
                // ambil kode akhir dari data terakhir
                $last_kode = $idkelas_old[strlen($idkelas_old) - 1]; 
                // membuat kode akhir baru dengan menambahkan kode akhir dari data terakhir
                $new_kode = chr(ord($last_kode) + 1);
                // create id kelas
                $idkelas = $idthnkls.'-'.$idmtkkls."-".$new_kode;
            } else { // jika tidak ada, otomatis kode akhir = "A"
                // create id kelas
                $idkelas = $idthnkls.'-'.$idmtkkls."-A";
            }
            
            $insert = [
                'idprodikls'=> $post['idprodikls'],
                'idthnkls'=> $post['idthnkls'],
                'idmtkkls'=> $post['idmtkkls'],
                'idkelas'=> $idkelas,
                'iddosenkelas'=> $post['namadosen'],
                'koderuangkelas'=> $post['ruang'],
                'jammulaikelas'=> $post['jammulai'],
                'jamselesaikelas'=> $post['jamselesai'],
                'kapasitaskelas'=> $post['kapasitaskelas'],
                'jumpeserta'=> $post['jumpeserta'],
                'harikelas'=> $post['harikelas'],
            ];
            $this->db->insert('tkelas',$insert);
        }elseif ($jenis == "EDIT") 
        {
            $this->db->where('idthnkls',$idthnkls);
            $this->db->where('idmtkkls',$idmtkkls);
            $this->db->order_by('idkelas','DESC');
            $tkelas = $this->db->get('tkelas')->row();
            if($tkelas) // jika data yg dicari ada
            {
                // simpan nilai id kelas dari data terakhir
                $idkelas_old = $tkelas->idkelas;
                // ambil kode akhir dari data terakhir
                $last_kode = $idkelas_old[strlen($idkelas_old) - 1]; 
                // membuat kode akhir baru dengan menambahkan kode akhir dari data terakhir
                $new_kode = chr(ord($last_kode) + 1);
                // create id kelas
                $idkelas = $idthnkls.'-'.$idmtkkls."-".$new_kode;
            } else { // jika tidak ada, otomatis kode akhir = "A"
                // create id kelas
                $idkelas = $idthnkls.'-'.$idmtkkls."-A";
            }

            $upadate = [
                'idmtkkls'=> $post['idmtkkls'],
                'idkelas'=> $idkelas,
                'iddosenkelas'=> $post['namadosen'],
                'koderuangkelas'=> $post['ruang'],
                'jammulaikelas'=> $post['jammulai'],
                'jamselesaikelas'=> $post['jamselesai'],
                'kapasitaskelas'=> $post['kapasitaskelas'],
                'jumpeserta'=> $post['jumpeserta'],
                'jumpeserta'=> $post['jumpeserta'],
                'harikelas'=> $post['harikelas'],
            ];
            $this->db->update('tkelas',$upadate,['idkelas'=>$post['idkelas']]);
        }
        $this->session->set_userdata('successmsg','Data berhasil di simpan');
        redirect('Akademik/Aturkelas/Tawarmatkul?idthnkls='.$post['idthnkls'].'&idprodikls='.$post['idprodikls']);
    }

    public function delete($idkelas)
    {
        $this->db->delete('tkelas',['idkelas' => $idkelas]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function ajax_cekIdKelas()
    {
        $idkelas = $this->input->post('idkelas');
        $this->db->where('idkelas',$idkelas);
        $cek_id = $this->db->get('tkelas')->row();
        if($cek_id){
            echo '201';
        } else {
            echo '200';
        }
    }
}