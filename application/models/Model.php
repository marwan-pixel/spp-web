<?php 
class Model extends CI_Model {

    public function getDataModel($table, $data, $param = null, $join = null) {
        $process = $this->db->select(implode(",",$data));
        if($param == null) {
            $process = $this->db->get($table)->result_array();
        } else {
            if($table == 'admin' || $table == 'biaya') {
                $process = $this->db->get_where($table, [$data[0] => $param[$data[0]]])->row_array();
            } else {
                $process = $this->db->from($table)->join($join['table'], $join['field'])->get()->row_array();
            }
            
        }
        return $process;
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
                    'message' => $this->db->error(),    
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