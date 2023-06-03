<?php 
class Model extends CI_Model {

    public function getDataModel($table, $data, $param = null, $limit = null ,$start = null, $keyword = null) {
        $process = $this->db->select(implode(",",$data));
        if($keyword) {
            $process = $this->db->like($keyword[0], $keyword[1]);
        }
        if($param == null) {
            $process = $this->db->get($table, $limit, $start)->result_array();
        } else {
            $process = $this->db->get_where($table, [$data[0] => $param[$data[0]]])->row_array();
        }
        return $process;
    }

    public function getDataJoinModel($table1, $table2, $data ,$column, $where = null){
        $this->db->select($data)->from($table1)->join($table2, "$table2.$column[0] = $table1.$column[0]");
        if(!is_null($where)){
            $this->db->where("$table1.$column[1]", $where);
        }
        $process = $this->db->get()->row_array();
        return $process;
    }
    public function countAllData($table, $where = null ,$param = null){
        if(!is_null($param)){
            $this->db->like($where, $param);
        }
        return $this->db->get($table)->num_rows();
    }

    public function insertDataModel($table, $dataInput){
        try {
             $this->db->insert($table, $dataInput);
                if ($this->db->affected_rows() > 0) {
                return [
                    'status' => true,
                    'message' => 'Data berhasil ditambahkan'    
                ];
                }
        } catch (Exception $e) {
            return [
                        'status' => true,
                        'message' => $e->getMessage()    
                    ];  
        }
    }

    public function updateDataModel($table, $data, $where){
        try {
            $this->db->set($data);
            $this->db->where($where[0], $where[1]);
            $this->db->update($table, $data);          
            if($this->db->affected_rows() > 0) {
                 return [
                    'status' => true,
                    'message' => 'Data berhasil diubah'    
                ];
            } else {
                return [
                    'status' => false,
                    'message' => 'Data gagal diubah',    
                ];
            }
        } catch (Exception $e) {
            return [
                        'status' => false,
                        'message' => $e->getMessage()    
                    ];  
        }
    } 
}