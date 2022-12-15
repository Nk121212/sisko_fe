<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends SEKOLAH_Controller {

	function __construct(){
		parent::__construct();

		if ($_SERVER['REQUEST_METHOD'] != 'POST') {
			echo skl_response(405, $title="Error", array(), getCodeText(405));
			exit;
		}
	}

	public function login(){
		
		//print_r($this->input->post());
		$this->load->model('M_crud');

		$where = array(
			'username' => $this->input->post('username'),
			'password' => MD5($this->input->post('password'))
		);

		$resp = $this->M_crud->pub_multi_where('skl_master_user', $where);

		$title = 'Get User';
		$data = array();
		$code = ($resp->num_rows() > 0) ? 200 : 404;

		echo skl_response($code, $title, array(), getCodeText($code));
		
	}
}
