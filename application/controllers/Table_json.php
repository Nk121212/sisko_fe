<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Content-Type: application/json');

class Table_json extends SEKOLAH_Controller {

    private $limit = '10';

	public function get_nilai_by_nis(){

        // echo $this->limit;
        // exit;

        $offset = $this->input->post('start') ? $this->input->post('start') : 0;

        // $sorting = $this->input->post('order')[0]['column'];
        // $sortingType = $this->input->post('order')[0]['dir'];

        // if($sorting == '1'){
        //     $sortingBy = 'app_name';
        // }elseif ($sorting == '2') {
        //     $sortingBy = 'doc_type';
        // }elseif ($sorting == '4') {
        //     $sortingBy = 'requested';
        // }elseif ($sorting == '5') {
        //     $sortingBy = 'status';
        // }elseif ($sorting == '6') {
        //     $sortingBy = 'description';
        // }

        $nis = $this->input->post()['search']['nis'];

        $resp = $this->M_curl->getNilaiByNis($nis, $offset, $this->limit);

        $data = array(
            //'limit' => $this->limit,
            'real_resp' => $resp,
            'postData' => $this->input->post(),
            'recordsTotal'=> $resp['total_record'],
            'recordsFiltered'=> $resp['total_record'],
            'data'=>array()
        );
        
        $i=1+(integer)$this->input->post('start');

        foreach($resp['data'] as $res){

            $data['data'][] = array(
                'no' => $i,
                'nama_pelajaran'=> strtoupper($res['nama_pelajaran']),
                'jenis_nilai'=> $res['jenis_nilai'],
                'nilai' => $res['nilai']
            );
            
            $i++;
        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function get_guru_all(){

        $start = $this->input->post('start') ? $this->input->post('start') : 0;

        $resp = $this->M_curl->getGuruAll($start, $this->limit);

        $data = array(
            //'limit' => $this->limit,
            'real_resp' => $resp,
            'postData' => $this->input->post(),
            'recordsTotal'=> $resp['total_record'],
            'recordsFiltered'=> $resp['total_record'],
            'data'=>array()
        );
        
        $i=1+(integer)$this->input->post('start');

        foreach($resp['data'] as $res){

            $data['data'][] = array(
                'no' => $i,
                'nip'=> $res['nip'],
                'nama_guru'=> $res['nama_guru'],
                'alamat' => $res['alamat'],
                'no_telepon' => $res['no_telepon'],
                'action' => '
                    <a class="btn btn-warning edit" data-nip="'.$res['nip'].'"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger delete" data-nip="'.$res['nip'].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                '
            );
            
            $i++;
        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function get_pelajaran_all(){

        $start = $this->input->post('start') ? $this->input->post('start') : 0;

        $resp = $this->M_curl->getPelajaranAll($start, $this->limit);

        $data = array(
            //'limit' => $this->limit,
            'real_resp' => $resp,
            'postData' => $this->input->post(),
            'recordsTotal'=> $resp['total_record'],
            'recordsFiltered'=> $resp['total_record'],
            'data'=>array()
        );
        
        $i=1+(integer)$this->input->post('start');

        foreach($resp['data'] as $res){

            $data['data'][] = array(
                'no' => $i,
                'id_pelajaran'=> $res['id'],
                'nama_pelajaran'=> strtoupper($res['nama_pelajaran']),
                'keterangan' => $res['keterangan'],
                'action' => '
                    <a class="btn btn-warning edit" data-id="'.$res['id'].'"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger delete" data-id="'.$res['id'].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                '
            );
            
            $i++;
        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function get_user_all(){

        $start = $this->input->post('start') ? $this->input->post('start') : 0;

        $resp = $this->M_curl->getUserAll($start, $this->limit);

        $data = array(
            //'limit' => $this->limit,
            'real_resp' => $resp,
            'postData' => $this->input->post(),
            'recordsTotal'=> $resp['total_record'],
            'recordsFiltered'=> $resp['total_record'],
            'data'=>array()
        );
        
        $i=1+(integer)$this->input->post('start');

        foreach($resp['data'] as $res){

            $image_location = ($res['image'] == "" || $res['image'] === null) ? "" : base_url().$res['image'];

            $data['data'][] = array(
                'no' => $i,
                'id'=> $res['id'],
                'role'=> strtoupper($res['role']),
                'username'=> $res['username'],
                'password' => $res['password'],
                'nama'=> strtoupper($res['nama']),
                'alamat' => $res['alamat'],
                'no_telp'=> strtoupper($res['no_telp']),
                'image' => '<image style="width: 30%;" src="'.$image_location.'" alt="No Image"></image>',
                'action' => '
                    <a class="btn btn-warning edit" data-id="'.$res['id'].'"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger delete" data-id="'.$res['id'].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                '
            );
            
            $i++;
        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function get_jenisnilai_all(){

        $start = $this->input->post('start') ? $this->input->post('start') : 0;

        $resp = $this->M_curl->getJenisNilaiAll($start, $this->limit);

        $data = array(
            //'limit' => $this->limit,
            'real_resp' => $resp,
            'postData' => $this->input->post(),
            'recordsTotal'=> $resp['total_record'],
            'recordsFiltered'=> $resp['total_record'],
            'data'=>array()
        );
        
        $i=1+(integer)$this->input->post('start');

        foreach($resp['data'] as $res){

            $data['data'][] = array(
                'no' => $i,
                'id'=> $res['id'],
                'jenis_nilai'=> strtoupper($res['jenis_nilai']),
                'keterangan' => $res['keterangan'],
                'action' => '
                    <a class="btn btn-warning edit" data-id="'.$res['id'].'"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger delete" data-id="'.$res['id'].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                '
            );
            
            $i++;
        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function get_murid_all(){

        $start = $this->input->post('start') ? $this->input->post('start') : 0;

        $resp = $this->M_curl->getMuridAll($start, $this->limit);

        $data = array(
            //'limit' => $this->limit,
            'real_resp' => $resp,
            'postData' => $this->input->post(),
            'recordsTotal'=> $resp['total_record'],
            'recordsFiltered'=> $resp['total_record'],
            'data'=>array()
        );
        
        $i=1+(integer)$this->input->post('start');

        foreach($resp['data'] as $res){

            $image_location = ($res['image'] == "" || $res['image'] === null) ? "" : base_url().$res['image'];

            $data['data'][] = array(
                'no' => $i,
                'id'=> $res['id'],
                'nama'=> strtoupper($res['nama']),
                'alamat' => $res['alamat'],
                'telepon'=> strtoupper($res['telepon']),
                'image' => '<image style="width: 30%;" src="'.$image_location.'" alt="No Image"></image>',
                'action' => '
                    <a class="btn btn-warning edit" data-id="'.$res['id'].'"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger delete" data-id="'.$res['id'].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                '
            );
            
            $i++;
        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function get_option_all(){

        $start = $this->input->post('start') ? $this->input->post('start') : 0;

        $resp = $this->M_curl->getOptionAll($start, $this->limit);

        $data = array(
            //'limit' => $this->limit,
            'real_resp' => $resp,
            'postData' => $this->input->post(),
            'recordsTotal'=> $resp['total_record'],
            'recordsFiltered'=> $resp['total_record'],
            'data'=>array()
        );
        
        $i=1+(integer)$this->input->post('start');

        foreach($resp['data'] as $res){

            $data['data'][] = array(
                'no' => $i,
                'id'=> $res['id'],
                'nama_opsi'=> strtoupper($res['nama_opsi']),
                'keterangan' => $res['keterangan'],
                'api' => $res['api'],
                'action' => '
                    <a class="btn btn-warning edit" data-id="'.$res['id'].'"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger delete" data-id="'.$res['id'].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                '
            );
            
            $i++;
        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

    public function get_role_all(){

        $start = $this->input->post('start') ? $this->input->post('start') : 0;

        $resp = $this->M_curl->getRoleAll($start, $this->limit);

        $data = array(
            //'limit' => $this->limit,
            'real_resp' => $resp,
            'postData' => $this->input->post(),
            'recordsTotal'=> $resp['total_record'],
            'recordsFiltered'=> $resp['total_record'],
            'data'=>array()
        );
        
        $i=1+(integer)$this->input->post('start');

        foreach($resp['data'] as $res){

            $data['data'][] = array(
                'no' => $i,
                'id'=> $res['id'],
                'nama_role'=> strtoupper($res['nama_role']),
                'keterangan' => $res['keterangan'],
                'action' => '
                    <a class="btn btn-warning edit" data-id="'.$res['id'].'"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-danger delete" data-id="'.$res['id'].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                '
            );
            
            $i++;
        }

        echo json_encode($data, JSON_PRETTY_PRINT);
    }

}
