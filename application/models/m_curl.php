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
            
            $res = cURL(getConfig('api_url').'getmurid?id='.$this->session->userdata('id'));
            //return $res;
            return json_decode($res, true);
        }

        public function getAllOpsi(){
            
            $res = cURL(getConfig('api_url').'getOpsi');
            //return $res;
            return json_decode($res, true);
        }

        public function getNilaiByNis($nis, $offset, $limit, $orderBy="", $orderType=""){
            
            $res = cURL(getConfig('api_url').'getNilaiByNis?nis='.$nis.'&offset='.$offset.'&limit='.$limit.'&order_by='.$orderBy.'&order_type='.$orderType);
            //return $res;
            return json_decode($res, true);
        }

        //crud guru

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

        //crud pelajaran

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

        public function getPelajaranById($id){
            
            $res = cURL(getConfig('api_url').'get/pelajaran/byId?id='.$id);
            //return $res;
            return json_decode($res, true);
        }

        public function updatePelajaranById($id, $body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'patch/pelajaran/byId/'.$id, $body, 'custom', $header, 'PATCH');

            return json_decode($res, true);
        }

        public function deletePelajaranById($id){

            $header = array();
            
            $res = cURL(getConfig('api_url').'delete/pelajaran/byId/'.$id, array(), 'custom', $header, 'DELETE');
            return json_decode($res, true);
        }

        //crud pelajaran

        public function getUserAll($start, $limit, $orderBy="", $orderType=""){
            
            $res = cURL(getConfig('api_url').'get/user/all?start='.$start.'&limit='.$limit.'&order_by='.$orderBy.'&order_type='.$orderType);
            //return $res;
            return json_decode($res, true);
        }

        public function addUser($body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'adduser', $body, 'post', $header);

            //return $res;
            return json_decode($res, true);
        }

        public function getUserById($id){
            
            $res = cURL(getConfig('api_url').'get/user/byId?id='.$id);
            //return $res;
            return json_decode($res, true);
        }

        public function updateUserById($id, $body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'patch/user/byId/'.$id, $body, 'custom', $header, 'PATCH');

            return json_decode($res, true);
        }

        public function deleteUserById($id){

            $header = array();
            
            $res = cURL(getConfig('api_url').'delete/user/byId/'.$id, array(), 'custom', $header, 'DELETE');
            return json_decode($res, true);
        }
        
    }

?>