<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class M_crud extends CI_Model
    {

        private $table_name;
        private $where;

        private function multi_where(){
            // print_r($this->where);
            // print_r($this->table_name);
            // exit;
            $this->db->where($this->where);
            $query = $this->db->get($this->table_name);

            //print_r($this->db->last_query());
            //exit;

            return $query;
        }

        public function pub_multi_where($table, $arr){
            $this->table_name = $table;
            $this->where = $arr;
            return $this->multi_where();
        }
    }

?>