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

        public function getGuruAll($start, $limit, $orderBy="", $orderType=""){
            
            $res = cURL(getConfig('api_url').'get/guru/all?start='.$start.'&limit='.$limit.'&order_by='.$orderBy.'&order_type='.$orderType);
            //return $res;
            return json_decode($res, true);
        }

        public function addGuru($body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'addguru', $body, 'post', $header);

            //return $res;
            return json_decode($res, true);
        }

        public function getGuruByNip($nip){
            
            $res = cURL(getConfig('api_url').'get/guru/byNip?nip='.$nip);
            //return $res;
            return json_decode($res, true);
        }

        public function updateGuruByNip($nip, $body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'patch/guru/byNip/'.$nip, $body, 'custom', $header, 'PATCH');

            return json_decode($res, true);
        }

        public function deleteGuruByNip($nip){

            $header = array();
            
            $res = cURL(getConfig('api_url').'delete/guru/byNip/'.$nip, array(), 'custom', $header, 'DELETE');
            return json_decode($res, true);
        }

        public function getPelajaranAll($start, $limit, $orderBy="", $orderType=""){
            
            $res = cURL(getConfig('api_url').'get/pelajaran/all?start='.$start.'&limit='.$limit.'&order_by='.$orderBy.'&order_type='.$orderType);
            //return $res;
            return json_decode($res, true);
        }

        public function addPelajaran($body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'addpelajaran', $body, 'post', $header);

            //return $res;
            return json_decode($res, true);
        }
        
    }

?>