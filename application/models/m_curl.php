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
            
            $res = cURL(getConfig('api_url').'getmurid?id='.$this->session->userdata('id_user'));
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

        //crud user

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

        //crud jenis nilai

        public function getJenisNilaiAll($start, $limit, $orderBy="", $orderType=""){
            
            $res = cURL(getConfig('api_url').'get/jenisnilai/all?start='.$start.'&limit='.$limit.'&order_by='.$orderBy.'&order_type='.$orderType);
            //return $res;
            return json_decode($res, true);
        }

        public function addJenisNilai($body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'addjenisnilai', $body, 'post', $header);

            //return $res;
            return json_decode($res, true);
        }

        public function getJenisNilaiById($id){
            
            $res = cURL(getConfig('api_url').'get/jenisnilai/byId?id='.$id);
            //return $res;
            return json_decode($res, true);
        }

        public function updateJenisNilaiById($id, $body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'patch/jenisnilai/byId/'.$id, $body, 'custom', $header, 'PATCH');
            //return $res;
            return json_decode($res, true);
        }

        public function deleteJenisNilaiById($id){

            $header = array();
            
            $res = cURL(getConfig('api_url').'delete/jenisnilai/byId/'.$id, array(), 'custom', $header, 'DELETE');
            return json_decode($res, true);
        }

        //crud murid

        public function getMuridAll($start, $limit, $orderBy="", $orderType=""){
            
            $res = cURL(getConfig('api_url').'get/murid/all?start='.$start.'&limit='.$limit.'&order_by='.$orderBy.'&order_type='.$orderType);
            //return $res;
            return json_decode($res, true);
        }

        public function addMurid($body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'addmurid', $body, 'post', $header);

            //return $res;
            return json_decode($res, true);
        }

        public function getMuridById($id){
            
            $res = cURL(getConfig('api_url').'get/murid/byId?id='.$id);
            //return $res;
            return json_decode($res, true);
        }

        public function updateMuridById($id, $body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'patch/murid/byId/'.$id, $body, 'custom', $header, 'PATCH');
            //return $res;
            return json_decode($res, true);
        }

        public function deleteMuridById($id){

            $header = array();
            
            $res = cURL(getConfig('api_url').'delete/murid/byId/'.$id, array(), 'custom', $header, 'DELETE');
            return json_decode($res, true);
        }

        //crud option

        public function getOptionAll($start, $limit, $orderBy="", $orderType=""){
            
            $res = cURL(getConfig('api_url').'get/opsi/all?start='.$start.'&limit='.$limit.'&order_by='.$orderBy.'&order_type='.$orderType);
            //return $res;
            return json_decode($res, true);
        }

        public function addOption($body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'addopsi', $body, 'post', $header);

            //return $res;
            return json_decode($res, true);
        }

        public function getOptionById($id){
            
            $res = cURL(getConfig('api_url').'get/opsi/byId?id='.$id);
            //return $res;
            return json_decode($res, true);
        }

        public function updateOptionById($id, $body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'patch/opsi/byId/'.$id, $body, 'custom', $header, 'PATCH');
            //return $res;
            return json_decode($res, true);
        }

        public function deleteOptionById($id){

            $header = array();
            
            $res = cURL(getConfig('api_url').'delete/opsi/byId/'.$id, array(), 'custom', $header, 'DELETE');
            return json_decode($res, true);
        }

        //crud role

        public function getRoleAll($start, $limit, $orderBy="", $orderType=""){
            
            $res = cURL(getConfig('api_url').'get/role/all?start='.$start.'&limit='.$limit.'&order_by='.$orderBy.'&order_type='.$orderType);
            //return $res;
            return json_decode($res, true);
        }

        public function addRole($body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'addrole', $body, 'post', $header);

            //return $res;
            return json_decode($res, true);
        }

        public function getRoleById($id){
            
            $res = cURL(getConfig('api_url').'get/role/byId?id='.$id);
            //return $res;
            return json_decode($res, true);
        }

        public function updateRoleById($id, $body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'patch/role/byId/'.$id, $body, 'custom', $header, 'PATCH');
            //return $res;
            return json_decode($res, true);
        }

        public function deleteRoleById($id){

            $header = array();
            
            $res = cURL(getConfig('api_url').'delete/role/byId/'.$id, array(), 'custom', $header, 'DELETE');
            return json_decode($res, true);
        }

        //crud tingkat

        public function getTingkatAll($start, $limit, $orderBy="", $orderType=""){
            
            $res = cURL(getConfig('api_url').'get/tingkat/all?start='.$start.'&limit='.$limit.'&order_by='.$orderBy.'&order_type='.$orderType);
            //return $res;
            return json_decode($res, true);
        }

        public function addTingkat($body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'addtingkat', $body, 'post', $header);

            //return $res;
            return json_decode($res, true);
        }

        public function getTingkatById($id){
            
            $res = cURL(getConfig('api_url').'get/tingkat/byId?id='.$id);
            //return $res;
            return json_decode($res, true);
        }

        public function updateTingkatById($id, $body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'patch/tingkat/byId/'.$id, $body, 'custom', $header, 'PATCH');
            //return $res;
            return json_decode($res, true);
        }

        public function deleteTingkatById($id){

            $header = array();
            
            $res = cURL(getConfig('api_url').'delete/tingkat/byId/'.$id, array(), 'custom', $header, 'DELETE');
            return json_decode($res, true);
        }

        //crud kelas

        public function getKelasAll($start, $limit, $orderBy="", $orderType=""){
            
            $res = cURL(getConfig('api_url').'get/kelas/all?start='.$start.'&limit='.$limit.'&order_by='.$orderBy.'&order_type='.$orderType);
            //return $res;
            return json_decode($res, true);
        }

        public function addKelas($body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'addkelas', $body, 'post', $header);

            //return $res;
            return json_decode($res, true);
        }

        public function getKelasById($id){
            
            $res = cURL(getConfig('api_url').'get/kelas/byId?id='.$id);
            //return $res;
            return json_decode($res, true);
        }

        public function updateKelasById($id, $body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'patch/kelas/byId/'.$id, $body, 'custom', $header, 'PATCH');
            //return $res;
            return json_decode($res, true);
        }

        public function deleteKelasById($id){

            $header = array();
            
            $res = cURL(getConfig('api_url').'delete/kelas/byId/'.$id, array(), 'custom', $header, 'DELETE');
            return json_decode($res, true);
        }

        public function getMuridByClass($tingkat, $kelas){
            
            $res = cURL(getConfig('api_url').'get/murid/byClass?id_tingkat='.$tingkat.'&id_kelas='.$kelas);
            //return $res;
            return json_decode($res, true);
        }

        public function addAbsen($body){
            
            // $res = cURL(getConfig('api_url').'addabsen?id_murid='.$id_murid.'&status='.$status.'&keterangan='.$keterangan);
            // //return $res;
            // return json_decode($res, true);
            $header = array();
            
            $res = cURL(getConfig('api_url').'addabsen', $body, 'post', $header);

            //return $res;
            return json_decode($res, true);

        }

        //crud menu

        public function getMenuAll($start, $limit, $orderBy="", $orderType=""){
            
            $res = cURL(getConfig('api_url').'get/menu/all?start='.$start.'&limit='.$limit.'&order_by='.$orderBy.'&order_type='.$orderType);
            //return $res;
            return json_decode($res, true);
        }

        public function addMenu($body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'addmenu', $body, 'post', $header);

            //return $res;
            return json_decode($res, true);
        }

        public function getMenuById($id){
            
            $res = cURL(getConfig('api_url').'get/menu/byId?id='.$id);
            //return $res;
            return json_decode($res, true);
        }

        public function updateMenuById($id, $body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'patch/menu/byId/'.$id, $body, 'custom', $header, 'PATCH');
            //return $res;
            return json_decode($res, true);
        }

        public function deleteMenuById($id){

            $header = array();
            
            $res = cURL(getConfig('api_url').'delete/menu/byId/'.$id, array(), 'custom', $header, 'DELETE');
            return json_decode($res, true);
        }

        //crud akses

        public function getAksesAll($start, $limit, $orderBy="", $orderType=""){
            
            $res = cURL(getConfig('api_url').'get/akses/all?start='.$start.'&limit='.$limit.'&order_by='.$orderBy.'&order_type='.$orderType);
            //return $res;
            return json_decode($res, true);
        }

        public function addAkses($body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'addakses', $body, 'post', $header);

            //return $res;
            return json_decode($res, true);
        }

        public function getAksesById($id){
            
            $res = cURL(getConfig('api_url').'get/akses/byId?id='.$id);
            //return $res;
            return json_decode($res, true);
        }

        public function updateAksesById($id, $body){

            $header = array();
            
            $res = cURL(getConfig('api_url').'patch/akses/byId/'.$id, $body, 'custom', $header, 'PATCH');
            //return $res;
            return json_decode($res, true);
        }

        public function deleteAksesById($id){

            $header = array();
            
            $res = cURL(getConfig('api_url').'delete/akses/byId/'.$id, array(), 'custom', $header, 'DELETE');
            return json_decode($res, true);
        }
        
    }

?>