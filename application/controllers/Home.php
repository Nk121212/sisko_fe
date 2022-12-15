<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends SEKOLAH_Controller {

	public function dashboard(){

        $data = array(
            'page' => 'logged_in/dashboard',
            'title' => 'Dashboard'
        );

        $this->load->view("main", $data);
    }
}
