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

        $config = configUpload($filename);

        $this->load->library('upload', $config);

        $upload = $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('upload')) {
            // saat gagal, tampilkan pesan error
            $resp = array();
            $resp['title'] = 'Insert User';
            $resp['code'] = 409;
            $resp['data'] = array();
            $resp['message'] = 'Upload Failed '.$this->upload->display_errors();

            $up_resp = $this->upload->display_errors();

        } else {
            // saat berhasil ambil datanya
            $up_resp = $this->upload->data();

            $folder = basename(dirname($up_resp['full_path']));
            $file = basename($up_resp['full_path']);

            $location = $folder.'/'.$file;

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

        $this->load->helper('config_upload_helper');

        $filename = base64_encode($this->input->post('username'));

        $config = configUpload($filename);

        $this->load->library('upload', $config);

        $upload = $this->upload->initialize($config);
        
        if (!$this->upload->do_upload('upload')) {
            // saat gagal, tampilkan pesan error
            $resp = array();
            $resp['title'] = 'Insert User';
            $resp['code'] = 409;
            $resp['data'] = array();
            $resp['message'] = 'Upload Failed '.$this->upload->display_errors();

            $up_resp = $this->upload->display_errors();

        } else {
            // saat berhasil ambil datanya
            $up_resp = $this->upload->data();

            $folder = basename(dirname($up_resp['full_path']));
            $file = basename($up_resp['full_path']);

            $location = $folder.'/'.$file;

            $id = $this->input->post('id');
            unset($_POST['id']);

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
}
