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
		// var_dump($resp);
		// exit;

		if($resp['code'] == 200){

			$data = array();
			foreach ($resp['data'] as $key => $value) {
				# code...
				$data[$key] = $value;

			}

			$data['login'] = true;
			unset($data['password']);
			
			$this->session->set_userdata($data);
			// print_r($this->session->userdata());
			// exit;

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
