<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends SEKOLAH_Controller {

	public function login_page(){
		
		$this->load->view('auth/login');
		
	}

	public function register_page(){
		
		$this->load->view('auth/register');
		
	}
}
