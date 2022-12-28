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
        
        //get isp provider
        // $res = cURL(getConfig('api_get_isp').$_SERVER['REMOTE_ADDR'].'?fields=status,message,continent,continentCode,country,countryCode,region,regionName,city,district,zip,lat,lon,timezone,offset,currency,isp,org,as,asname,reverse,mobile,proxy,hosting,query');
        // print_r($res);

        // $curl = curl_init();

        // curl_setopt_array($curl, array(
        // CURLOPT_URL => "https://api.apilayer.com/number_verification/countries",
        // CURLOPT_HTTPHEADER => array(
        //     "Content-Type: text/plain",
        //     "apikey: ZUjEKnZpvhiSoKL4GCbZ7MUlvyzLX2HJ"
        // ),
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => "",
        // CURLOPT_MAXREDIRS => 10,
        // CURLOPT_TIMEOUT => 0,
        // CURLOPT_FOLLOWLOCATION => true,
        // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        // CURLOPT_CUSTOMREQUEST => "GET"
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        // echo $response;
        // exit;

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