<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataKelas extends CI_Controller {
    public function index() {
        $this->load->view('template/header');
        $this->load->view('dataKelas');
        $this->load->view('template/footer');
    }
}
