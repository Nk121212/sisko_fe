<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header('Content-Type: application/json');

class Table_json extends SEKOLAH_Controller {

    private $limit = '10';

	public function get_nilai_by_nik(){

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

        $nik = $this->input->post()['search']['nik'];

        $resp = $this->M_curl->getNilaiByNik($nik, $offset, $this->limit);

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
}
