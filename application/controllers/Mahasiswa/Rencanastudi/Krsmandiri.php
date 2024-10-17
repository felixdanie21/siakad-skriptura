<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Krsmandiri extends CI_Controller {


    public function __construct()
	{
		parent::__construct();
        // cek login
        $this->load->model('Utility');
        $this->load->model('MenuModel');
        $this->Utility->isLogin();
        $this->Utility->modulSecurity('MH');
        // get iden pt
        $this->midenpt = $this->db->get('midenpt')->row();
	}
    public function index(){
        $userid = $this->session->userdata('userid');
        if($userid = "IT"){
            $data['mhsbio']= $this->session->userdata('userid') ;     
        }
        $this->db->where('idnim',$this->session->userdata('userid') );
        $data['mhsbio']= $this->db->get('mhsbio')->row();    

        $this->db->select_max('idthn', 'max_idthnkrs');
        $data['mthnak']=$this->db->from('mthnak');
        $max_query = $this->db->get();
        $max_idthnkrs = $max_query->row()->max_idthnkrs;
        
        $this->db->select('*');
        $this->db->from('tkrs');
        $this->db->join('mthnak', 'mthnak.idthn = tkrs.idthnkrs');
        $this->db->join('mhsbio', 'mhsbio.idnim = tkrs.idnimkls');
        $this->db->join('tkelas', 'tkelas.idkelas = tkrs.idkelaskrs');
        $this->db->join('matkul', 'matkul.idmtk = tkelas.idmtkkls');
        $this->db->join('mdosen', 'mdosen.iddosen = tkelas.iddosenkelas');
        $this->db->order_by('harikelas', 'DESC');
        $this->db->order_by('namamtk', 'ASC');
        $this->db->where('idthnkrs', $max_idthnkrs);
        $this->db->where('idnimkls', $this->session->userdata('userid'));
        $data['table'] = $this->db->get()->result_array();

        $this->db->select('*');
        $this->db->from('tkrs');
        $this->db->join('mthnak', 'mthnak.idthn = tkrs.idthnkrs');
        $this->db->join('tkelas', 'tkelas.idkelas = tkrs.idkelaskrs');
        $this->db->join('mprodi', 'mprodi.idprodi = tkelas.idprodikls');
        $this->db->join('matkul', 'matkul.idmtk = tkelas.idmtkkls');
        $this->db->where('idthnkrs', $max_idthnkrs);
        $this->db->group_by('idthnkrs');
        $this->db->where('idnimkls', $this->session->userdata('userid'));
        $this->db->select('SUM(matkul.sksmtk) as total_sksmtk');
        $data['table1'] = $this->db->get()->row();

        $data['indukmenu'] = 'BB020000';
        $data['submenu'] = 'BB020100';
        $data['mmenu'] = $this->MenuModel->listmenu('BB');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);
        $this->load->view('layout/home/sidebar');
        $this->load->view('mahasiswa/rencanastudi/Krsmandiri/index');
        $this->load->view('layout/home/footer');
    }
    public function form($nim){
        $data['nim'] = $nim;
        $this->db->where('idnim',$this->session->userdata('userid') );
        $data['mhsbio']= $this->db->get('mhsbio')->row();

        $this->db->select_max('idthn', 'max_idthnkls');
        $this->db->from('mthnak');
        $max_query = $this->db->get();
        $max_idthnkls = $max_query->row()->max_idthnkls;

        $this->db->from('tkelas');
        $this->db->order_by('idkelas','ASC');
        $this->db->join('mthnak','mthnak.idthn=tkelas.idthnkls');
        $this->db->join('matkul', 'matkul.idmtk = tkelas.idmtkkls');
        $this->db->join('mdosen', 'mdosen.iddosen = tkelas.iddosenkelas');
        $this->db->where('idthnkls',$max_idthnkls);
        $data['table'] = $this->db->get()->result_array();

        $data['indukmenu'] = 'BB020000';
        $data['submenu'] = 'BB020100';
        $data['mmenu'] = $this->MenuModel->listmenu('BB');
        $data['midenpt'] = $this->midenpt;
        $this->load->view('layout/home/header',$data);  
        $this->load->view('layout/home/sidebar');
        $this->load->view('mahasiswa/rencanastudi/krsmandiri/form');
        $this->load->view('layout/home/footer');
    }
    public function simpan()
    {
        $post = $this->input->post();

        $this->db->where('idkelaskrs',$post['idkelas']);
        $this->db->where('idnimkls',$this->session->userdata('userid') );
        $cek_id = $this->db->get('tkrs')->row();
        if($cek_id){
            $this->session->set_userdata('errormsg','Kode Kelas sudah digunakan');
            redirect($_SERVER['HTTP_REFERER']);
        } 
         $insert = [
            'idkelaskrs' => $post['idkelas'],
            'idthnkrs' => $post['idthnkls'],
            'idnimkls' => $post['idnimkls'],
            'rwymtkmhs' => $post['rwymtkmhs'],
        ];
        $this->db->insert('tkrs',$insert);
        $this->session->set_userdata('successmsg','Data berhasil disimpan');
        redirect('Mahasiswa/Rencanastudi/Krsmandiri');
    }
    public function delete($idkelaskrs)
    {
        $this->db->delete('tkrs',['idkelaskrs' => $idkelaskrs]);
        $this->session->set_userdata('successmsg','Data berhasil dihapus');
        redirect('Mahasiswa/Rencanastudi/Krsmandiri');
    }
    public function getkelas()
    {
        $iddosen = $this->input->post('matkul');
        $idmtkkls = $this->input->post('idmtkkls');
        // $this->db->where('iddosen',$iddosen);
        $this->db->select_max('idthn', 'max_idthnkls');
        $this->db->from('mthnak');
        $max_query = $this->db->get();
        $max_idthnkls = $max_query->row()->max_idthnkls;

        $this->db->select('*');
        $this->db->from('tkelas');
        $this->db->join('mthnak','mthnak.idthn=tkelas.idthnkls');
        $this->db->join('matkul', 'matkul.idmtk = tkelas.idmtkkls');
        $this->db->join('mdosen', 'mdosen.iddosen = tkelas.iddosenkelas');
        
        $this->db->where('idkelas',$iddosen);
        $this->db->where('idthnkls',$max_idthnkls);
        $getdatamtk = $this->db->get()->result_array();
        // var_dump($idmtkkls);
        echo json_encode($getdatamtk);
    }
    public function ajax_cekRiwayat()
    {
        $this->db->select_max('idthn', 'max_idthnkls');
        $this->db->from('mthnak');
        $max_query = $this->db->get();
        $max_idthnkls = $max_query->row()->max_idthnkls;

        // $idkelas = $this->input->post('idkelas');
        $idkelas = $this->input->post('idkelas');
        $this->db->select('*');
        $this->db->from('tkrs');
        $this->db->join('tkelas','tkelas.idkelas=tkrs.idkelaskrs');
        // $this->db->join('matkul', 'matkul.idmtk = tkelas.idmtkkls');
        $this->db->where('idnimkls',$this->session->userdata('userid'));
        $this->db->where('idkelaskrs',$idkelas);
        // $this->db->where('idmtkkls',$idmtkkls);
        $this->db->where('idthnkrs',$max_idthnkls);
        $cek_id = $this->db->get()->result_array();

        if($cek_id){
            echo '201';
        } else {
            echo '200';
        }
    }
}