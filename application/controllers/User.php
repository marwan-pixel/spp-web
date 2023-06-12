<?php
defined('BASEPATH') or exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: origin, x-requested-with, content-type");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");

class User extends CI_Controller {

    private $data = array();
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('model');
        $this->load->helper('download');
    }

    //Ambil data yang sudah di set
    public function getData(){
        return $this->data;
    }

    //Set data yang akan diinputkan
    public function setData($data){
        $this->data = $data;
    }

    public function login($data){
        $process = $this->model->getDataModel($data['table'],$data['selectedData'],$data['value']);
        return $process;
	}

    public function logout() {
        $this->session->unset_userdata('kode_petugas');
        redirect('login');
    }
}

