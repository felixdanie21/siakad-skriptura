<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CsvModel extends CI_Model
{
    public function setupForm()
    {
        $folder = 'D:/csv/siakad/';
		$file_array = array();
		if (!($buka_folder = opendir($folder))) die('Erorr... Tidak bisa membuka Folder');
		while ($baca_folder = readdir($buka_folder)) {
			$file_array[] = $baca_folder;
		}
		$data['file'] = $file_array;
		$data['table'] = $this->db->list_tables();
        return $data;
    }

    public function insert($f)
    {
        $folder = 'D:/csv/siakad/';
		$foldername = $folder . $f['file'];
		$table = $f['table'];
		$conn = mysqli_connect('localhost', 'root', '', 'dbsiakad');
		$sql = "load data infile '$foldername'
				replace into table $table
				fields terminated by '~'
				enclosed by '\"'
				lines terminated by '\n'
				ignore 0 rows";

		$hasil = mysqli_query($conn, $sql);
		if (!$hasil) {
			$this->session->set_userdata('message', mysqli_errno($conn) . mysqli_error($conn));
			redirect('SuperAdmin/importCsv');
		}
		unlink($foldername);
        return 'Ok';
    }
}