<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends SEKOLAH_Controller {

	public function users_page(){

        $role = $this->M_curl->getRoleAll("", "");
        //print_r($role);
        $list_role = ($role['code'] == '200') ? $role['data'] : array();

        $data = array(
            'page' => 'logged_in/master/user',
            'title' => 'Master Users',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "User",
            'breadcrumb_3' => "",
            'role' => $list_role
        );

        $this->load->view("main", $data);
    }

    public function guru_page(){

        $data = array(
            'page' => 'logged_in/master/guru',
            'title' => 'Master Guru',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Guru",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }
    
    public function jnilai_page(){

        $data = array(
            'page' => 'logged_in/master/jenis_nilai',
            'title' => 'Master Jenis Nilai',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Jenis Nilai",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }

    public function murid_page(){

        $data = array(
            'page' => 'logged_in/master/murid',
            'title' => 'Master Murid',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Murid",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }

    public function option_page(){

        $data = array(
            'page' => 'logged_in/master/option',
            'title' => 'Master Option',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Option",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }

    public function pelajaran_page(){

        $data = array(
            'page' => 'logged_in/master/pelajaran',
            'title' => 'Master Pelajaran',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Pelajaran",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }

    public function role_page(){

        $data = array(
            'page' => 'logged_in/master/role',
            'title' => 'Master Role',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Role",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }

    public function tingkat_page(){

        $data = array(
            'page' => 'logged_in/master/tingkat',
            'title' => 'Master Tingkat',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Tingkat",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }

    public function kelas_page(){

        $data = array(
            'page' => 'logged_in/master/kelas',
            'title' => 'Master Kelas',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Kelas",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }

    public function menu_page(){

        $data = array(
            'page' => 'logged_in/master/menu',
            'title' => 'Master Menu',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Menu",
            'breadcrumb_3' => ""
        );

        $this->load->view("main", $data);
    }

    public function akses_page(){

        $role = $this->M_curl->getRoleAll("", "");
        $menu = $this->M_curl->getMenuAll("", "");

        $data = array(
            'page' => 'logged_in/master/akses',
            'title' => 'Master Akses',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Akses",
            'breadcrumb_3' => "",
            'list_role' => $role['data'],
            'list_menu' => $menu['data'],
        );

        $this->load->view("main", $data);
    }

    public function mapping_murid_page(){

        $users = $this->M_curl->getUserAll("", "");
        $murid = $this->M_curl->getMuridAll("", "");

        $data = array(
            'page' => 'logged_in/master/mapping_murid',
            'title' => 'Master Mapping Murid',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "Mapping Murid",
            'breadcrumb_3' => "",
            'list_users' => $users['data'],
            'list_murid' => $murid['data'],
        );

        $this->load->view("main", $data);
    }

    

    //guru 
    
    public function add_guru(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->addGuru($this->input->post());

        echo json_encode($resp);
    }

    public function get_guru_by_nip(){

        //print_r($this->input->post());
        header('Content-Type: application/json');

        $resp = $this->M_curl->getGuruByNip($this->input->post('nip'));

        echo json_encode($resp);

    }

    public function update_guru_by_nip(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $nip = $this->input->post('nip');
        unset($_POST['nip']);

        $resp = $this->M_curl->updateGuruByNip($nip, $this->input->post());

        echo json_encode($resp);
    }

    public function delete_guru_by_nip(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $nip = $this->input->post('nip');

        $resp = $this->M_curl->deleteGuruByNip($nip);

        echo json_encode($resp);
    }

    public function get_guru_all(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->getGuruAll("", "");

        echo json_encode($resp);
    }

    //pelajaran
    public function get_pelajaran_all(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->getPelajaranAll("", "");

        echo json_encode($resp);
    }

    public function add_pelajaran(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->addPelajaran($this->input->post());

        echo json_encode($resp);
    }

    public function get_pelajaran_by_id(){

        //print_r($this->input->post());exit;
        header('Content-Type: application/json');

        $resp = $this->M_curl->getPelajaranById($this->input->post('id'));

        echo json_encode($resp);

    }

    public function update_pelajaran_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');
        unset($_POST['id']);

        $resp = $this->M_curl->updatePelajaranById($id, $this->input->post());

        echo json_encode($resp);
    }

    public function delete_pelajaran_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');

        $resp = $this->M_curl->deletePelajaranById($id);

        echo json_encode($resp);
    }

    //user
    public function get_user_all(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->getUserAll("", "");

        echo json_encode($resp);
    }

    public function add_user(){

        header('Content-Type: application/json');

        $this->load->helper('config_upload_helper');

        $filename = base64_encode($this->input->post('username'));
        $dir = './upload/users/';

        $config = configUpload($filename, $dir);

        $this->load->library('upload', $config);

        $upload = $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('upload')) {
            // saat gagal, tampilkan pesan error
            // $resp = array();
            // $resp['title'] = 'Insert User';
            // $resp['code'] = 409;
            // $resp['data'] = array();
            // $resp['message'] = 'Upload Failed '.$this->upload->display_errors();

            // $up_resp = $this->upload->display_errors();
            $postData = $this->input->post();
            $resp = $this->M_curl->addUser($postData);
            $resp['message'] = $this->upload->display_errors();

        } else {
            // saat berhasil ambil datanya
            $up_resp = $this->upload->data();

            $folder = basename(dirname($up_resp['full_path']));
            $file = basename($up_resp['full_path']);

            $location = 'upload/'.$folder.'/'.$file;

            $postData = array_merge(array('image' => $location), $this->input->post());

            $resp = $this->M_curl->addUser($postData);
            $resp['message'] = 'Insert User Sukses !';
        }

        echo json_encode($resp);
    }

    public function get_user_by_id(){

        //print_r($this->input->post());exit;
        header('Content-Type: application/json');

        $resp = $this->M_curl->getUserById($this->input->post('id'));

        echo json_encode($resp);

    }

    public function update_user_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');
        unset($_POST['id']);

        $this->load->helper('config_upload_helper');

        $filename = base64_encode($this->input->post('username'));
        $dir = './upload/users/';

        $config = configUpload($filename, $dir);

        $this->load->library('upload', $config);

        $upload = $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('upload')) {
            // saat gagal, tampilkan pesan error
            // // $resp = array();
            // // $resp['title'] = 'Insert User';
            // // $resp['code'] = 409;
            // // $resp['data'] = array();
            // // $resp['message'] = 'Upload Failed '.$this->upload->display_errors();

            // $up_resp = $this->upload->display_errors();

            $postData = $this->input->post();
            $resp = $this->M_curl->updateUserById($id, $postData);
            $resp['message'] = $this->upload->display_errors();

        } else {
            // saat berhasil ambil datanya
            $up_resp = $this->upload->data();

            $folder = basename(dirname($up_resp['full_path']));
            $file = basename($up_resp['full_path']);

            $location = 'upload/'.$folder.'/'.$file;

            $postData = array_merge(array('image' => $location), $this->input->post());

            $resp = $this->M_curl->updateUserById($id, $postData);
            $resp['message'] = 'Update User Sukses !';
        }

        echo json_encode($resp);
    }

    public function delete_user_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');

        $resp = $this->M_curl->deleteUserById($id);

        echo json_encode($resp);
    }

    //jenis nilai
    public function get_jenisnilai_all(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->getJenisNilaiAll("", "");

        echo json_encode($resp);
    }

    public function add_jenisnilai(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->addJenisNilai($this->input->post());

        echo json_encode($resp);
    }

    public function get_jenisnilai_by_id(){

        //print_r($this->input->post());exit;
        header('Content-Type: application/json');

        $resp = $this->M_curl->getJenisNilaiById($this->input->post('id'));

        echo json_encode($resp);

    }

    public function update_jenisnilai_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');
        unset($_POST['id']);

        // echo $id;
        // exit;

        $resp = $this->M_curl->updateJenisNilaiById($id, $this->input->post());

        echo json_encode($resp);
    }

    public function delete_jenisnilai_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');

        $resp = $this->M_curl->deleteJenisNilaiById($id);

        echo json_encode($resp);
    }

    //user
    public function get_murid_all(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->getMuridAll("", "");

        echo json_encode($resp);
    }

    public function add_murid(){

        header('Content-Type: application/json');

        $this->load->helper('config_upload_helper');

        $filename = base64_encode($this->input->post('id'));
        $dir = './upload/murid/';

        $config = configUpload($filename, $dir);

        $this->load->library('upload', $config);

        $upload = $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('upload')) {
            // saat gagal, tampilkan pesan error
            // $resp = array();
            // $resp['title'] = 'Insert User';
            // $resp['code'] = 409;
            // $resp['data'] = array();
            // $resp['message'] = 'Upload Failed '.$this->upload->display_errors();

            // $up_resp = $this->upload->display_errors();
            $postData = $this->input->post();
            $resp = $this->M_curl->addMurid($postData);
            $resp['message'] = $this->upload->display_errors();

        } else {
            // saat berhasil ambil datanya
            $up_resp = $this->upload->data();

            $folder = basename(dirname($up_resp['full_path']));
            $file = basename($up_resp['full_path']);

            $location = 'upload/'.$folder.'/'.$file;

            $postData = array_merge(array('image' => $location), $this->input->post());

            $resp = $this->M_curl->addMurid($postData);
            $resp['message'] = 'Insert Murid Sukses !';
        }

        echo json_encode($resp);
    }

    public function get_murid_by_id(){

        //print_r($this->input->post());exit;
        header('Content-Type: application/json');

        $resp = $this->M_curl->getMuridById($this->input->post('id'));

        echo json_encode($resp);

    }

    public function update_murid_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');
        unset($_POST['id']);

        $this->load->helper('config_upload_helper');

        $filename = base64_encode($this->input->post('id'));
        $dir = './upload/murid/';

        $config = configUpload($filename, $dir);

        $this->load->library('upload', $config);

        $upload = $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('upload')) {
            // saat gagal, tampilkan pesan error
            // $resp = array();
            // $resp['title'] = 'Insert User';
            // $resp['code'] = 409;
            // $resp['data'] = array();
            // $resp['message'] = 'Upload Failed '.$this->upload->display_errors();

            // $up_resp = $this->upload->display_errors();
            $postData = $this->input->post();
            $resp = $this->M_curl->updateMuridById($id, $postData);
            $resp['message'] = $this->upload->display_errors();

        } else {
            // saat berhasil ambil datanya
            $up_resp = $this->upload->data();

            $folder = basename(dirname($up_resp['full_path']));
            $file = basename($up_resp['full_path']);

            $location = 'upload/'.$folder.'/'.$file;

            $postData = array_merge(array('image' => $location), $this->input->post());

            $resp = $this->M_curl->updateMuridById($id, $postData);
            $resp['message'] = 'Update Murid Sukses !';
        }

        echo json_encode($resp);
    }

    public function delete_murid_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');

        $resp = $this->M_curl->deleteMuridById($id);

        echo json_encode($resp);
    }

    //option

    public function get_option_all(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->getOptionAll("", "");

        echo json_encode($resp);
    }

    public function add_option(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->addOption($this->input->post());

        echo json_encode($resp);
    }

    public function get_option_by_id(){

        //print_r($this->input->post());exit;
        header('Content-Type: application/json');

        $resp = $this->M_curl->getOptionById($this->input->post('id'));

        echo json_encode($resp);

    }

    public function update_option_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');
        unset($_POST['id']);

        // echo $id;
        // exit;

        $resp = $this->M_curl->updateOptionById($id, $this->input->post());

        echo json_encode($resp);
    }

    public function delete_option_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');

        $resp = $this->M_curl->deleteOptionById($id);

        echo json_encode($resp);
    }

    //role

    public function get_role_all(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->getRoleAll("", "");

        echo json_encode($resp);
    }

    public function add_role(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->addRole($this->input->post());

        echo json_encode($resp);
    }

    public function get_role_by_id(){

        //print_r($this->input->post());exit;
        header('Content-Type: application/json');

        $resp = $this->M_curl->getRoleById($this->input->post('id'));

        echo json_encode($resp);

    }

    public function update_role_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');
        unset($_POST['id']);

        // echo $id;
        // exit;

        $resp = $this->M_curl->updateRoleById($id, $this->input->post());

        echo json_encode($resp);
    }

    public function delete_role_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');

        $resp = $this->M_curl->deleteRoleById($id);

        echo json_encode($resp);
    }

    //tingkat

    public function get_tingkat_all(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->getTingkatAll("", "");

        echo json_encode($resp);
    }

    public function add_tingkat(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->addTingkat($this->input->post());

        echo json_encode($resp);
    }

    public function get_tingkat_by_id(){

        //print_r($this->input->post());exit;
        header('Content-Type: application/json');

        $resp = $this->M_curl->getTingkatById($this->input->post('id'));

        echo json_encode($resp);

    }

    public function update_tingkat_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');
        unset($_POST['id']);

        // echo $id;
        // exit;

        $resp = $this->M_curl->updateTingkatById($id, $this->input->post());

        echo json_encode($resp);
    }

    public function delete_tingkat_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');

        $resp = $this->M_curl->deleteTingkatById($id);

        echo json_encode($resp);
    }

    //kelas

    public function get_kelas_all(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->getKelasAll("", "");

        echo json_encode($resp);
    }

    public function add_kelas(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->addKelas($this->input->post());

        echo json_encode($resp);
    }

    public function get_kelas_by_id(){

        //print_r($this->input->post());exit;
        header('Content-Type: application/json');

        $resp = $this->M_curl->getKelasById($this->input->post('id'));

        echo json_encode($resp);

    }

    public function update_kelas_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');
        unset($_POST['id']);

        // echo $id;
        // exit;

        $resp = $this->M_curl->updateKelasById($id, $this->input->post());

        echo json_encode($resp);
    }

    public function delete_kelas_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');

        $resp = $this->M_curl->deleteKelasById($id);

        echo json_encode($resp);
    }

    //menu

    public function get_menu_all(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->getMenuAll("", "");

        echo json_encode($resp);
    }

    public function add_menu(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->addMenu($this->input->post());

        echo json_encode($resp);
    }

    public function get_menu_by_id(){

        //print_r($this->input->post());exit;
        header('Content-Type: application/json');

        $resp = $this->M_curl->getMenuById($this->input->post('id'));

        echo json_encode($resp);

    }

    public function update_menu_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');
        unset($_POST['id']);

        // echo $id;
        // exit;

        $resp = $this->M_curl->updateMenuById($id, $this->input->post());

        echo json_encode($resp);
    }

    public function delete_menu_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');

        $resp = $this->M_curl->deleteMenuById($id);

        echo json_encode($resp);
    }

    //akses

    public function get_akses_all(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->getAksesAll("", "");

        echo json_encode($resp);
    }

    public function add_akses(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->addAkses($this->input->post());
        if($resp['code'] == '201'){
            $resp['alert'] = 'anda harus login kembali untuk get menu dengan akses baru, <a href="'.base_url().'logout">logout</a>';
        }

        echo json_encode($resp);
    }

    public function get_akses_by_id(){

        //print_r($this->input->post());exit;
        header('Content-Type: application/json');

        $resp = $this->M_curl->getAksesById($this->input->post('id'));

        echo json_encode($resp);

    }

    public function update_akses_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');
        unset($_POST['id']);

        // echo $id;
        // exit;

        $resp = $this->M_curl->updateAksesById($id, $this->input->post());
        if($resp['code'] == '200'){
            $resp['alert'] = 'anda harus login kembali untuk get menu dengan akses baru, <a href="'.base_url().'logout">logout</a>';
        }

        // print_r($resp);
        // exit;

        echo json_encode($resp);
    }

    public function delete_akses_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');

        $resp = $this->M_curl->deleteAksesById($id);
        if($resp['code'] == '200'){
            $resp['alert'] = 'anda harus login kembali untuk get menu dengan akses baru, <a href="'.base_url().'logout">logout</a>';
        }

        echo json_encode($resp);
    }

    //mapping murid

    public function get_mapping_murid_all(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->getMappingMuridAll("", "");

        echo json_encode($resp);
    }

    public function add_mapping_murid(){

        header('Content-Type: application/json');

        $resp = $this->M_curl->addMappingMurid($this->input->post());

        echo json_encode($resp);
    }

    public function get_mapping_murid_by_id(){

        //print_r($this->input->post());exit;
        header('Content-Type: application/json');

        $resp = $this->M_curl->getMappingMuridById($this->input->post('id'));

        echo json_encode($resp);

    }

    public function update_mapping_murid_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');
        unset($_POST['id']);

        // echo $id;
        // exit;

        $resp = $this->M_curl->updateMappingMuridById($id, $this->input->post());

        // print_r($resp);
        // exit;

        echo json_encode($resp);
    }

    public function delete_mapping_murid_by_id(){
        //print_r($this->input->post());
        header('Content-Type: application/json');

        $id = $this->input->post('id');

        $resp = $this->M_curl->deleteMappingMuridById($id);

        echo json_encode($resp);
    }

    public function get_murid_by_class(){
        header('Content-Type: application/json');

        $tingkat = $this->input->post("id_tingkat");
        $kelas = $this->input->post("id_kelas");

        $resp = $this->M_curl->getMuridByClass($tingkat, $kelas);

        echo json_encode($resp);
    }

    
}
