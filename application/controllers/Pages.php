<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	private string $page;

	public function getPage(): string
	{
		return $this->page;
	}

	public function setPage(string $page) {
		$this->page = $page;
	}
	public function index()
	{
        $this->load->view('template/header');
		$this->load->view('home');
        $this->load->view('template/footer');
	}

	public function login(){
		$this->load->view('login');
	}

	public function registrasi(){
		$this->load->view('registrasi');
	}
	public function datasiswa()
	{
        $this->load->view('template/header');
		$this->load->view('datasiswa');
        $this->load->view('template/footer');
	}
	public function datakelas()
	{
        $this->load->view('template/header');
		$this->load->view('datakelas');
        $this->load->view('template/footer');
	}
	public function databiaya()
	{
        $this->load->view('template/header');
		$this->load->view('databiaya');
        $this->load->view('template/footer');
	}
	public function dataadmin()
	{
        $this->load->view('template/header');
		$this->load->view('dataadmin');
        $this->load->view('template/footer');
	}
	public function datatransaksi()
	{
        $this->load->view('template/header');
		$this->load->view('datatransaksi');
        $this->load->view('template/footer');
	}
}

