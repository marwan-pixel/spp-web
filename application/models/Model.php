<?php 
class Model extends CI_Model {

    public function getDataModel($table, $data, $param = null, $limit = null, $start = null, $keyword = null, $array = 1, $groupBy = null) {
        $process = $this->db->select(implode(",",$data));
        if($keyword) {
            $process = $this->db->like($keyword);
        }
        if($param !== null) {
            $process = $this->db->where($param);
        } 
        if(!is_null($groupBy)){
           $process = $this->db->order_by($groupBy, 'ASC');
        }
        if($array != 1) {
            $process = $this->db->get($table, $limit, $start)->row_array();
        } else {
            $process = $this->db->get($table, $limit, $start)->result_array();
        }
        return $process;
    }

    public function printDataModel($table, $data, $param){
        $this->db->select(implode(",",$data))->from($table)->
        join("siswa", "siswa.nipd = $table.nipd")->
        join("kelas", "kelas.kelas = siswa.kelas");
        if(!empty($param['nipd'])){
            $this->db->where('transactions.nipd', $param['nipd']);
        }
        if(empty($param['since']) && empty($param['to'])) {
            $process = $this->db->get()->result_array();
        } else {
            $this->db->where('created_at >=', $param['since']);
            $this->db->where('created_at <=', $param['to']);
            $process = $this->db->get()->result_array();
        }
        return $process;
    }

    public function getDataJoinModel($table, $data, $column, $params = null, $keyword = null, $array = 0, $groupBy = null){
        
        $this->db->select($data)->from($table[0]);
        for ($i = 1; $i < count($table); $i++) {
            $this->db->join($table[$i], "$table[$i].{$column[$i-1]} = $table[0].{$column[$i-1]}");
        }
        if(!is_null($params)){
            $this->db->where($params);
        }
        if(!is_null($keyword)){
            $this->db->group_start();
            $this->db->like($keyword);
            $this->db->or_like($keyword);
            $this->db->group_end();
        }
        if(!is_null($groupBy)){
            $process = $this->db->order_by($groupBy, 'ASC');
         }
        if($array == 1) {
           
            $process = $this->db->get()->result_array();
        } else {
            $process = $this->db->get()->row_array();
        }
        return $process;

    }
    public function getSearchDataJoinModel($table, $data, $column, $keyword = null, $array = 0, $groupBy = null){
        
        $this->db->select($data)->from($table[0]);
          // Loop through the remaining tables for JOIN
        for ($i = 1; $i < count($table); $i++) {
            $this->db->join($table[$i], "$table[$i].{$column[$i-1]} = $table[0].{$column[$i-1]}");
        }
        if(!is_null($keyword)){
            $this->db->group_start();
            $this->db->like($keyword);
            $this->db->or_like($keyword);
            $this->db->group_end();
        }
        if($array == 1) {
            $this->db->group_by("$groupBy");
            $process = $this->db->get()->result_array();
        } else {
            $process = $this->db->get()->row_array();
        }
        return $process;

    }

    public function countAllData($table, $where = null, $params = null){
        if(!is_null($params)){
            for ($i=0; $i < count($where); $i++) { 
                # code...
                $this->db->like($where[$i], $params[$i]);
            }
        }
        return $this->db->get($table)->num_rows();
    }

    public function insertDataModel($table, $dataInput){
        try {
             $this->db->insert($table, $dataInput);
             if($table == 'tahun_akademik' && $dataInput['status'] == 1) {
                $this->db->update('tahun_akademik', array('status' => 0));
                $this->db->where('thn_akademik', $dataInput['thn_akademik']);
                $this->db->update('tahun_akademik', array('status' => 1));
             }
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
            $this->db->where($where);
            $this->db->update($table, $data);
            if($table == 'tahun_akademik') {
                if($data['status'] == 1){
                    $this->db->update('tahun_akademik', array('status' => 0));
                    $this->db->where('thn_akademik', $data['thn_akademik']);
                    $this->db->update('tahun_akademik', array('status' => 1));
                }
            }
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