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

        public function getMuridByUserLoggedIn(){
            
            $res = cURL(getConfig('api_url').'getmurid?id_user='.$this->session->userdata('id'));
            //return $res;
            return json_decode($res, true);
        }

        public function getAllOpsi(){
            
            $res = cURL(getConfig('api_url').'getOpsi');
            //return $res;
            return json_decode($res, true);
        }

        public function getNilaiByNik($nik, $offset, $limit, $orderBy="", $orderType=""){
            
            $res = cURL(getConfig('api_url').'getNilaiByNik?nik='.$nik.'&offset='.$offset.'&limit='.$limit.'&order_by='.$orderBy.'&order_type='.$orderType);
            //return $res;
            return json_decode($res, true);
        }

    }

?>