<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTransaksi extends CI_Controller {
    public function index() {
        $this->load->view('template/header');
        $this->load->view('dataTransaksi');
        $this->load->view('template/footer');
    }
}
