<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends SEKOLAH_Controller {

    public function absen_page(){

        $getTingkat = $this->M_curl->getTingkatAll("", "");
        $getKelas = $this->M_curl->getKelasAll("", "");

        // print_r($getTingkat);
        // print_r($getKelas);
        // exit;
        $listTingkat = ($getTingkat['code'] == '200') ? $getTingkat['data'] : array();
        $listKelas = ($getKelas['code'] == '200') ? $getKelas['data'] : array();

        $data = array(
            'page' => 'logged_in/transaksi/absen',
            'title' => 'Transaksi Absen',
            'breadcrumb_1' => "Transaksi",
            'breadcrumb_2' => "Absen",
            'breadcrumb_3' => "",
            'list_tingkat' => $listTingkat,
            'list_kelas' => $listKelas
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

    public function add_absen(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        // $id_murid = $this->input->post("id_murid");
        // $status = $this->input->post("status");
        // $keterangan = $this->input->post("keterangan");

        $resp = $this->M_curl->addAbsen($this->input->post());

        echo json_encode($resp);
    }
}

?>