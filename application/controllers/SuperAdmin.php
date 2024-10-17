<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperAdmin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// cek login
		$this->load->model('Utility');
		$this->load->model('CsvModel');
		$this->Utility->isLogin();
		$this->Utility->modulSecurity('*');
	}

	public function importCsv()
	{
		$data = $this->CsvModel->setupForm();
		$this->load->view('superadmin/importcsv',$data);
	}

	public function importCsv_insert()
	{
		$f = $this->input->post();
		$this->CsvModel->insert($f);
		$this->session->set_userdata('message', 'Data berhasil diimport.');
		redirect('SuperAdmin/importCsv');
	}
}
