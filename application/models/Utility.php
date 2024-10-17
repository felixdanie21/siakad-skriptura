<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Utility extends CI_Model
{
    function hariIndo($id)
    {
        if ($id == "7") {
            $id = "0";
        }
        if ($id == "0") {
            return 'Minggu';
        } else if ($id == "1") {
            return 'Senin';
        } else if ($id == "2") {
            return 'Selasa';
        } else if ($id == "3") {
            return 'Rabu';
        } else if ($id == "4") {
            return 'Kamis';
        } else if ($id == "5") {
            return 'Jumat';
        } else if ($id == "6") {
            return 'Sabtu';
        }
    }

    function tanggalIndonesia($tanggal)
    {
        $bulan = array(
            1 =>   'JANUARI',
            'FEBRUARI',
            'MARET',
            'APRIL',
            'MEI',
            'JUNI',
            'JULI',
            'AGUSTUS',
            'SEPTEMBER',
            'OKTOBER',
            'NOVEMBER',
            'DESEMBER'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . ucfirst(strtolower($bulan[(int)$pecahkan[1]])) . ' ' . $pecahkan[0];
    }

    function bulanIndonesia($id)
    {
        if ($id == "01") {
            return 'JANUARI';
        } else if ($id == "02") {
            return 'FEBRUARI';
        } else if ($id == "03") {
            return 'MARET';
        } else if ($id == "04") {
            return 'APRIL';
        } else if ($id == "05") {
            return 'MEI';
        } else if ($id == "06") {
            return 'JUNI';
        } else if ($id == "07") {
            return 'JULI';
        } else if ($id == "08") {
            return 'AGUSTUS';
        } else if ($id == "09") {
            return 'SEPTEMBER';
        } else if ($id == "10") {
            return 'OKTOBER';
        } else if ($id == "11") {
            return 'NOVEMBER';
        } else if ($id == "12") {
            return 'DESEMBER';
        }
    }

    function listBulanIndonesia()
    {
        $data = [
            'bulan' => ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'],
            'value' => ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'],
        ];
        return $data;
    }

    function nomorurut($length, $number, $posisi = 'L')
    {
        $lnum = strlen($number); // length number
        $nol = '';
        for ($i = 1; $i <= $length; $i++) {
            if ($i > $lnum) {
                $nol = $nol . "0";
            }
        }
        if ($posisi == 'L') {
            return $nol . $number;
        } elseif ($posisi == 'R') {
            return $number . $nol;
        }
    }

    function echoArray($data)
    {
        return '<pre>' . var_export($data, true) . '</pre>';
    }

    function cutString($length, $string)
    {
        if (strlen($string) > $length) {
            $string = substr($string, 0, $length) . '...';
        }
        return $string;
    }

    function formatdate($date, $format = '1')
    {
        if ($format == '1') {
            return date('d-m-Y', strtotime($date));
        }
    }

    function formatstatus($symtru, $symfal, $txttrue, $txtfal, $value)
    {
        if ($symtru == $value) {
            return $txttrue;
        } elseif ($symfal == $value) {
            return $txtfal;
        }
    }

    function formatharga($value, $decimals = 0, $decimal_separator = '.', $thousands_separator = ',')
    {
        return number_format($value, $decimals, $decimal_separator, $thousands_separator);
    }

    function formatnilai($value)
    {
        return str_replace(',', '', $value);
    }

    function bolddata($symtru, $value)
    {
        if ($symtru == $value) {
            return "bg-ryubold";
        }
    }

    function tambahchar($char, $jumchar)
    {
        $value = '';
        for ($i = 0; $i < $jumchar; $i++) {
            $value = $value . $char;
        }
        return $value;
    }

    public function cuttext($string, $maxlength)
    {
        $i = 1;
        while (strlen($string) > $maxlength) {
            $newstring  = substr($string, 0, $maxlength);
            if ($string[$maxlength] !== ' ') {
                do {
                    $newstring = substr($newstring, 0, strlen($newstring) - 1);
                    $stop = '1';
                    if (strlen($newstring) > 0) {
                        if (ctype_alnum($newstring[strlen($newstring) - 1])) {
                            $stop = '0';
                        }
                    }
                    if (strlen($newstring) == '0') {
                        $stop = '1';
                        $newstring  = substr($string, 0, $maxlength);
                    }
                } while ($stop == '0' && strlen($newstring) !== 0);
            }
            $arraystring[$i] = $newstring;
            $i++;
            $string = substr($string, strlen($newstring));
        }
        if ($string !== '') {
            $arraystring[$i] = $string;
        }
        return $arraystring;
    }

    public function potongnama($nama, $length)
    {
        $arraynama = explode(' ', $nama);
        $fullnama = '';
        for ($i = 0; $i < count($arraynama); $i++) {
            if ($i < $length) {
                $fullnama = $fullnama . ' ' . $arraynama[$i];
            } else {
                if(strlen($arraynama[$i]) > 0){
                    $fullnama = $fullnama . ' . ' . $arraynama[$i][0];
                }
            }
        }
        echo $fullnama;
    }

    public function hitungLamaNotifikasi($tanggal_notifikasi, $tanggal_target) {
        $timestamp_notifikasi = strtotime($tanggal_notifikasi);
        $timestamp_target = strtotime($tanggal_target);
    
        $lama_notifikasi = round(($timestamp_target - $timestamp_notifikasi), 0); // konversi ke detik
    
        if ($lama_notifikasi < 60) {
            return $lama_notifikasi . " detik";
        } elseif ($lama_notifikasi < 3600) {
            return round($lama_notifikasi / 60, 0) . " Menit";
        } elseif ($lama_notifikasi < 86400) {
            return round($lama_notifikasi / 3600, 0) . " Jam";
        } elseif ($lama_notifikasi < 604800) {
            return round($lama_notifikasi / 86400, 0) . " Hari";
        } else {
            return round($lama_notifikasi / 604800, 0) . " Minggu";
        }
    }

    public function isLogin()
	{
		if(!$this->session->userdata('userid')){
            $this->session->set_userdata('authinfomsg','LOGIN TERLEBIH DAHULU.');
            redirect('Auth');
        }
	}

    public function modulSecurity($moduluser)
	{
		if($this->session->userdata('userstat') !== $moduluser && $this->session->userdata('userstat') !== 'DV'){
            if($moduluser == 'AA' || $moduluser || 'AK'){
                if($this->session->userdata('userstat') == 'SA'){
                    return true;
                }
            }
            $this->modulRedirect();
        }
	}

    public function modulRedirect()
    {
        switch($this->session->userdata('userstat')){
            case "AA":
                redirect('Akademik/Index');
                break;
            case "AK":
                redirect('Keuangan/Index');
                break;
            case "MH":
                redirect('Mahasiswa/Index');
                break;
            case "DS":
                redirect('Dosen/Index');
                break;
            case "OT":
                redirect('Ortu/Index');
                break;
            case "SA":
                redirect('Dashboard/Index');
                break;
        }
    }
    
}
