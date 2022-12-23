<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends SEKOLAH_Controller {

public function absen_page(){

        $data = array(
            'page' => 'logged_in/transaksi/absen',
            'title' => 'Transaksi Absen',
            'breadcrumb_1' => "Transaksi",
            'breadcrumb_2' => "Absen",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }

    public function nilai_page(){

        $data = array(
            'page' => 'logged_in/transaksi/nilai',
            'title' => 'Transaksi Nilai',
            'breadcrumb_1' => "Transaksi",
            'breadcrumb_2' => "Nilai",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }
}

?>