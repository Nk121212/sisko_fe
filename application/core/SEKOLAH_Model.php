<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SEKOLAH_Model extends CI_Model {

	public function __construct()
    {
		parent::__construct();

		date_default_timezone_set('Asia/Jakarta');
		$class = $this->router->fetch_class();
		$method = $this->router->fetch_method();
		//echo $class;
	}
    
}
