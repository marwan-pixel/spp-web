<?php 
class Model extends CI_Model {
    public function loginModel($table,$data,$param) {
        $user = $this->db->select(implode(",",$data));
        $user = $this->db->get_where($table, [$data[0] => $param['id']])->row_array();
        return $user;
    }

    public function getDataModel($table, $data, $param = null) {
        $this->db->select(implode(",",$data));
        if($param == null) {
            $this->db->get($table)->row_array();
        } else {
            $this->db->get_where($table, [$data[0] => $param['']])->row_array();
        }
    }

    public function insertDataModel($table, $data){
        $this->db->insert($table, $data);
    }
}