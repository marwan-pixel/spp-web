<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataSiswa extends CI_Controller {
    public function index() {
        $this->load->view('template/header');
        $this->load->view('dataSiswa');
        $this->load->view('template/footer');

    }
}
