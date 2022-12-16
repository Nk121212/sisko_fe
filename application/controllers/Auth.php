<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends SEKOLAH_Controller {

	public function login_page(){
		
		$this->load->view('auth/login');
		
	}

	public function register_page(){
		
		$this->load->view('auth/register');
		
	}

	public function login(){

		// $this->load->model('M_curl');
		$resp = $this->M_curl->login($this->input->post('username'), $this->input->post('password'));

		if($resp['code'] == 200){

			$this->session->set_userdata(
				array(
					'login' => true,
					'id' => $resp['data']['id_user'],
					'username' => $resp['data']['username']
				)
			);

			redirect("dashboard");

		}else{

			$this->session->set_flashdata(
				array('notif' => '<div class="alert alert-danger" role="alert">Username / Password Salah!</div>')
			);
			
			redirect("");
		}

	}

	public function logout(){
		$this->session->sess_destroy();
		redirect("");
	}
}
