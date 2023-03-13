<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataBiaya extends CI_Controller {
    public function index() {
        $this->load->view('template/header');
        $this->load->view('dataBiaya');
        $this->load->view('template/footer');
    }
}
