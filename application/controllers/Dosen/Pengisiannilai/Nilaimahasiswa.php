<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nilaimahasiswa extends CI_Controller {


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
        $data['mkomnil'] = $this->db->get('mkomnil')->result_array();
        $this->db->where('iddosen',$this->session->userdata('userid'));
        $data['mdosen'] = $this->db->get('mdosen')->row();

       
        $data['table'] = [];
        $data['idkelaskrs'] = '';
        $data['kodepenilaian'] = '';
        if($post || $get) {
            if(!$post) {
                $post = $get;
            }
            $data['idkelaskrs'] = $post['idkelas'];
            $this->db->select('*');
            $this->db->from('tkrs');
            $this->db->join('mhsbio','mhsbio.idnim=tkrs.idnimkls');
           
            $this->db->join('tkelas','tkelas.idkelas=tkrs.idkelaskrs');
            $this->db->where('iddosenkelas',$this->session->userdata('userid'));
            $this->db->where('idkelaskrs',$post['idkelas']);
            $data['table'] = $this->db->get()->result_array();

            // $data['kodepenilaian'] = $post['kodepenilaian'];
            $data['mkomnil'] = $this->db->get('mkomnil')->result_array();

            $data['tnildetkom'] = $this->db->get('tnildetkom')->result_array();

            
            $this->db->join('matkul','matkul.idmtk=tkelas.idmtkkls');
            $this->db->where('idkelas',$post['idkelas']);
            $data['tkelas1'] = $this->db->get('tkelas')->row();

            
        }
        
        $data['indukmenu'] = 'BD000000';
        $data['submenu'] = 'BD040000';
        $data['mmenu'] = $this->MenuModel->listmenu('BD');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('dosen/pengisiannilai/index');
        $this->load->view('layout/home/footer');
    }
    public function index_komponenpnl($idnimkls)
    {
        
        $idkelaskrs = $this->input->get('idkelaskrs');
        
        $this->db->where('idnim',$idnimkls);
        $data['mhsbio'] = $this->db->get('mhsbio')->row();
        $this->db->where('idnimnil',$idnimkls);
        $this->db->join('mhsbio','mhsbio.idnim=tnildetkom.idnimnil');
        $this->db->join('mkomnil','mkomnil.kodepenilaian=tnildetkom.kodepenilaian');
        $data['tnildetkom'] = $this->db->get('tnildetkom')->result_array();

        $this->db->select('*');
        $this->db->from('tnildetkom');
        $this->db->join('mhsbio','mhsbio.idnim=tnildetkom.idnimnil');
        $this->db->join('mkomnil','mkomnil.kodepenilaian=tnildetkom.kodepenilaian');
        $this->db->where('idnimnil',$idnimkls);
        $this->db->select('SUM(tnildetkom.nilperolehan) as total_nilperolehan');
        $data['table1'] = $this->db->get()->row();

        // $this->db->join('tkelas','tkelas.idkelas=tkrs.idnimkls');
        $this->db->where('idnimkls',$idnimkls);
        $data['tkrs'] = $this->db->get('tkrs')->row();

        $this->db->where('idnim',$idnimkls);
        $data['mhsbio'] = $this->db->get('mhsbio')->row();

       
        $this->db->where('idkelas',$idkelaskrs);
        $data['tkelas'] = $this->db->get('tkelas')->row();




        $data['indukmenu'] = 'BD000000';
        $data['submenu'] = 'BD040000';
        $data['mmenu'] = $this->MenuModel->listmenu('BD');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('dosen/pengisiannilai/index_komponenpnl');
        $this->load->view('layout/home/footer');
    }
    public function form($idnim,$idkelaskrs)
    {
        $idnimnil = $this->input->get('idnimnil');
        $kodepenilaian = $this->input->get('kodepenilaian');
        $kodepenilaian1 = $this->input->get('kodepenilaian');
        // $idkelaskrs = $this->input->get('idkelaskrs');

        $data['jenis'] = 'TAMBAH';
        if ($idnimnil) {
            $data['jenis'] = 'EDIT';
            
            $this->db->join('mhsbio','mhsbio.idnim=tnildetkom.idnimnil');
            $this->db->join('mkomnil ','mkomnil.kodepenilaian=tnildetkom.kodepenilaian');
            $this->db->where('idnimnil',$idnimnil);
            $this->db->where('tnildetkom.kodepenilaian',$kodepenilaian1);
            $data['tnildetkom'] = $this->db->get('tnildetkom')->row();
        }
        
        
        $this->db->where('idkelas',$idkelaskrs);
        $data['tkelas'] = $this->db->get('tkelas')->row();

        $this->db->select('*');
        $this->db->from('tnildetkom');
        $this->db->join('mhsbio','mhsbio.idnim=tnildetkom.idnimnil');
        $this->db->join('mkomnil ','mkomnil.kodepenilaian=tnildetkom.kodepenilaian');
        $this->db->where('idnimnil',$idnimnil);
        // $this->db->where('tnildetkom.kodepenilaian',$kodepenilaian);
        $data['tnildetkom1'] = $this->db->get()->row();
        $this->db->where('idnim',$idnim);
        $data['mhsbio'] = $this->db->get('mhsbio')->row();

        $this->db->where('kodepenilaian',$kodepenilaian);
        $data['mkomnil'] = $this->db->get('mkomnil')->row();

        $this->db->where('idkelasnil',$idkelaskrs);
        $this->db->join('mkomnil','mkomnil.kodepenilaian=tkomnilbot.kodepenilaian');
        $data['tkomnilbot'] = $this->db->get('tkomnilbot')->result_array();

        $data['indukmenu'] = 'BD000000';
        $data['submenu'] = 'BD040000';
        $data['mmenu'] = $this->MenuModel->listmenu('BD');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('dosen/pengisiannilai/form');
        $this->load->view('layout/home/footer');
    }
    public function simpan($jenis)
    {
        $post = $this->input->post();
        if ($jenis == 'TAMBAH') {
            $this->db->where('kodepenilaian',$post['kodepenilaian']);
            $this->db->where('idnimnil',$post['idnimnil']);
            $cek_id = $this->db->get('tnildetkom')->row();
            if ($cek_id) {
                $this->session->set_userdata('errormsg','Kode penilaian sudah di isi');
                redirect($SERVER['HTTP_REFERER']);            
            }
            $insert = [
                'idnimnil'=> $post['idnimnil'],
                'idkelas'=> $post['idkelas'],
                'kodepenilaian'=> $post['kodepenilaian'],
                'nilangka'=> $post['nilangka'],
                'nilperolehan'=> $post['nilperolehan'],
            ];
            $this->db->insert('tnildetkom',$insert);

            $this->db->where('idnimnil',$post['idnimnil']);
            $cek_idnimnil = $this->db->get('tnilstd')->row();

            if($cek_idnimnil){
                $this->db->set('nilaiangka', 'COALESCE(nilaiangka, 0) + ' . $post['nilperolehan'], FALSE);
                $this->db->where('idnimnil', $post['idnimnil']);
                $this->db->update('tnilstd');
            }else{
                $insert_tnilstd = [
                    'idthnnil' => $post['idthnkls'],
                    'idnimnil' => $post['idnimnil'],
                    'idmtknil' => $post['idmtkkls'],
                    'nilaiangka' => $post['nilperolehan'],
                ];
                $this->db->insert('tnilstd', $insert_tnilstd);
            }

        }elseif ($jenis == "EDIT") 
        {
            $upadate = [
                'nilangka'=> $post['nilangka'],
                'nilperolehan'=> $post['nilperolehan']
            ];
            $this->db->update('tnildetkom',$upadate,['idnimnil'=>$post['idnimnil'], 'kodepenilaian'=>$post['kodepenilaian']]);

            $this->db->select('SUM(tnildetkom.nilperolehan) as total_nilperolehan');
            $this->db->where('idnimnil', $post['idnimnil']);
            $totalNilPerolehan = $this->db->get('tnildetkom')->row()->total_nilperolehan;
            
            // Update the total nilaiangka in tnilstd
            $update_tnilstd = [
                'nilaiangka' => $totalNilPerolehan,
            ];
            $this->db->update('tnilstd', $update_tnilstd, ['idnimnil' => $post['idnimnil']]);
        }
        $this->session->set_userdata('successmsg','Data berhasil di simpan');
        redirect('Dosen/Pengisiannilai/Nilaimahasiswa');
    }
   
    public function ajax_cekRiwayat()
    {
        

        // $idkelas = $this->input->post('idkelas');
        $kodepenilaian = $this->input->post('kodepenilaian');
        $idkelas = $this->input->post('idkelas');
        $this->db->where('idkelasnil',$idkelas);
        $this->db->where('kodepenilaian',$kodepenilaian);
        $tkomnilbot = $this->db->get('tkomnilbot')->row();

        $this->db->where('idkelas',$idkelas);
        $tkelas = $this->db->get('tkelas')->row();
        
        header('Content-Type: application/json');

        if ($tkomnilbot) {
            echo json_encode(array('status' => '201', 'bobotprosen' => $tkomnilbot->bobotprosen, 'idthnkls' => $tkelas->idthnkls, 'idmtkkls' => $tkelas->idmtkkls));
        } else {
            echo json_encode(array('status' => '200'));
        }
        exit;

    }
    public function delete($idnimnil,$kodepenilaian,$idkelas)
    {
        $this->db->delete('tnildetkom',['idnimnil' => $idnimnil, 'kodepenilaian' => $kodepenilaian]);
        // proses update nilai angka di tnilstd
        $this->db->select('SUM(tnildetkom.nilperolehan) as total_nilperolehan');
        $this->db->where('idnimnil', $idnimnil);
        $totalNilPerolehan = $this->db->get('tnildetkom')->row()->total_nilperolehan;

        // Update the total nilaiangka in tnilstd
        $update_tnilstd = [
            'nilaiangka' => $totalNilPerolehan,
            ];
        $this->db->update('tnilstd', $update_tnilstd, ['idnimnil' => $idnimnil]);
        
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect("Dosen/Pengisiannilai/Nilaimahasiswa?idnimnil=$idnimnil&idkelas=$idkelas");
    }
}
