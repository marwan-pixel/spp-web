<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataTahunAkademik extends CI_Controller {
    public function index() {
        $this->load->view('template/header');
        $this->load->view('dataTahunAkademik');
        $this->load->view('template/footer');
    }
}
