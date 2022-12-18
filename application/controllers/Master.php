<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends SEKOLAH_Controller {

	public function users_page(){

        $data = array(
            'page' => 'logged_in/master/user',
            'title' => 'Master Users',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "User",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }

    public function guru_page(){

        $data = array(
            'page' => 'logged_in/master/guru',
            'title' => 'Master Guru',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Guru",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }
    
    public function jnilai_page(){

        $data = array(
            'page' => 'logged_in/master/jenis_nilai',
            'title' => 'Master Jenis Nilai',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Jenis Nilai",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }

    public function murid_page(){

        $data = array(
            'page' => 'logged_in/master/murid',
            'title' => 'Master Murid',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Murid",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }

    public function option_page(){

        $data = array(
            'page' => 'logged_in/master/option',
            'title' => 'Master Option',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Option",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }

    public function pelajaran_page(){

        $data = array(
            'page' => 'logged_in/master/pelajaran',
            'title' => 'Master Pelajaran',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Pelajaran",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }
}
