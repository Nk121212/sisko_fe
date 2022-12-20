<?php

    class Config_model extends SEKOLAH_Model
    {
        public function global_vars(){
            $query = $this->db->get('app_config');
            return $query->result_array();
        }

        public function global_menu(){
            $query = $this->db->get('menu_config');
            return $query->result_array();
        }
    }

?>