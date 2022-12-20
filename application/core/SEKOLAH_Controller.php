<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class SEKOLAH_Controller extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $CI = & get_instance();
        //$CI->load->helper('dbconfig_helper');
        //$CI->load->helper('my_helper');
        // $CI->load->model('auth_model');
        // $CI->load->model('api_model');
        // $CI->load->library('user_agent');
        $class = $CI->router->fetch_class();
        $method = $CI->router->fetch_method();

        if($this->session->userdata('login') && strtolower($class) == "auth" && strtolower($method) == 'login_page'){
            redirect("dashboard");
        }else{
            //redirect("");
            if(!$this->session->userdata('login') && strtolower($class) !== "auth"){
                redirect("logout");
            }
        }


    }

}