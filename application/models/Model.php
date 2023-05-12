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

    public function insertDataModel($table, $selectedData ,$dataInput){
        try {
            //Mengecek apakah di field yang jadi primary key terdapat duplikasi
            $checkSameId = $this->db->select($selectedData);
            $checkSameId = $this->db->get_where($table, [$selectedData => $dataInput[$selectedData]])->row_array();
            if(!is_null($checkSameId)) {
                if($checkSameId[$selectedData] == $dataInput[$selectedData]) {
                    return [
                        'status' => false,
                        'message' => "{$selectedData} sudah tersedia!"    
                    ];
                } else {
                    $this->db->insert($table, $dataInput);
                    if ($this->db->affected_rows() > 0) {
                    return [
                        'status' => true,
                        'message' => 'Data berhasil ditambahkan'    
                    ];
                    }
                }
            } else {
                $this->db->insert($table, $dataInput);
                if ($this->db->affected_rows() > 0) {
                return [
                    'status' => true,
                    'message' => 'Data berhasil ditambahkan'    
                ];
                }
            }

        } catch (Exception $e) {
            return [
                        'status' => true,
                        'message' => $e->getMessage()    
                    ];  
        }
    }

    public function updateDataModel($table, $data){

    }
}