<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends SEKOLAH_Controller {

	public function dashboard(){

        // print_r($this->session->userdata('menu'));
        // exit;

        $get_murid_by_user_logged_in = $this->M_curl->getMuridByUserLoggedIn();
        //  print_r($get_murid_by_user_logged_in);
        //  exit;
        $getOpsi = $this->M_curl->getAllOpsi();

        $totalAnak = count($get_murid_by_user_logged_in['data']);
        $splitDiv = ($totalAnak === 0) ? 12 : (12/$totalAnak);
        $splitDivUsed = ($splitDiv > 1) ? $splitDiv : 2;

        //$menu = getMenu();

        $data = array(
            'page' => 'logged_in/dashboard',
            'title' => 'Dashboard',
            'breadcrumb_1' => "Home",
            'breadcrumb_2' => "Dashboard",
            'breadcrumb_3' => "",
            'data_murid' => $get_murid_by_user_logged_in['data'],
            'div' => $splitDivUsed,
            'opsi' => $getOpsi['data']
            // 'menu' => $menu
        );

        $this->load->view("main", $data);
    }
}
