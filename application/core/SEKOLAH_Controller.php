<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class SEKOLAH_Controller extends CI_Controller {
    
    function __construct()
    {
        parent::__construct();
        $CI = & get_instance();
        // $CI->load->helper('function');
        // $CI->load->model('auth_model');
        // $CI->load->model('api_model');
        // $CI->load->library('user_agent');




    }

    public function config_globals(){

        $ci = & get_instance();
        $ci->load->model('config_model');
        $query = $ci->config_model->global_vars();

        foreach ($query as $key => $value) {
            $data[$value['key']] = $value['value'];
        }

        return $data;

    }

    public function configApp(){

        $ci = & get_instance();
        $ci->load->model('config_model');
        $query = $ci->config_model->global_vars();

        foreach ($query as $key => $value) {
            $data[$value['key']] = $value['value'];
        }

        return (object)$data;
        
    }

}