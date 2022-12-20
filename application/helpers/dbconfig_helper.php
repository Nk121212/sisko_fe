<?php

    function getConfig($my_key){

        $ci = & get_instance();
        $ci->load->model('config_model');
        $query = $ci->config_model->global_vars();

        $data = array();
        foreach ($query as $key => $value) {
            $data[$value['ac_key']][] = $value['ac_value'];
        }

        return $data[$my_key][0];
    }

    function getMenu(){

        $ci = & get_instance();
        $ci->load->model('config_model');
        $query = $ci->config_model->global_menu();

        $data = array();
        foreach ($query as $key => $value) {
            //print_r($value);
            $data[] = $value;
        }

        return $data;
    }

?>