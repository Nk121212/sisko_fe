<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class M_curl extends SEKOLAH_Model
    {

        public function login($username, $password){

            $header = array();
    
            $body = array(
                'username' => $username,
                'password' => $password
            );
            
            $res = cURL(getConfig('api_url').'login', $body, 'post', $header);
            //return $res;
            return json_decode($res, true);
        }

    }

?>