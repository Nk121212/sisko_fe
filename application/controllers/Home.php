<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends SEKOLAH_Controller {

	public function dashboard(){

        $get_murid_by_user_logged_in = $this->M_curl->getMuridByUserLoggedIn();
        //print_r($get_murid_by_user_logged_in['data']);
        //print_r($this->session->userdata());
        //exit;
        $totalAnak = count($get_murid_by_user_logged_in['data']);
        $splitDiv = (12/$totalAnak);
        $splitDivUsed = ($splitDiv > 1) ? $splitDiv : 2;
        //echo $splitDiv;
        //exit;

        $data = array(
            'page' => 'logged_in/dashboard',
            'title' => 'Dashboard',
            'data_murid' => $get_murid_by_user_logged_in['data'],
            'div' => $splitDivUsed
        );

        $this->load->view("main", $data);
    }
}
