<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends SEKOLAH_Controller {

	public function users_page(){

        $data = array(
            'page' => 'logged_in/master/user',
            'title' => 'Master Users',
            'breadcrumb_1' => "Master",
            'breadcrumb_2' => "User",
            'breadcrumb_3' => ""
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
            $resp = $this->M_curl->addUser($id, $postData);

        } else {
            // saat berhasil ambil datanya
            $up_resp = $this->upload->data();

            $folder = basename(dirname($up_resp['full_path']));
            $file = basename($up_resp['full_path']);

            $location = 'upload/'.$folder.'/'.$file;

            $postData = array_merge(array('image' => $location), $this->input->post());

            $resp = $this->M_curl->addUser($postData);
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

        } else {
            // saat berhasil ambil datanya
            $up_resp = $this->upload->data();

            $folder = basename(dirname($up_resp['full_path']));
            $file = basename($up_resp['full_path']);

            $location = 'upload/'.$folder.'/'.$file;

            $postData = array_merge(array('image' => $location), $this->input->post());

            $resp = $this->M_curl->updateUserById($id, $postData);
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
            $resp = $this->M_curl->addMurid($id, $postData);

        } else {
            // saat berhasil ambil datanya
            $up_resp = $this->upload->data();

            $folder = basename(dirname($up_resp['full_path']));
            $file = basename($up_resp['full_path']);

            $location = 'upload/'.$folder.'/'.$file;

            $postData = array_merge(array('image' => $location), $this->input->post());

            $resp = $this->M_curl->addMurid($postData);
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

        } else {
            // saat berhasil ambil datanya
            $up_resp = $this->upload->data();

            $folder = basename(dirname($up_resp['full_path']));
            $file = basename($up_resp['full_path']);

            $location = 'upload/'.$folder.'/'.$file;

            $postData = array_merge(array('image' => $location), $this->input->post());

            $resp = $this->M_curl->updateMuridById($id, $postData);
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
}
