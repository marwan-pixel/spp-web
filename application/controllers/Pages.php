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
	private $_userdata;

	public function __construct()
	{
		parent::__construct();
		$this->_userdata = $this->session->userdata('name');
	}

	public function render(string $view, $model)
	{
        $this->load->view('template/header', $model);
		$this->load->view($view);
        $this->load->view('template/footer');
	}

	public function home()
	{
		$this->render('home', ["title" => "Dashboard", 'name' => $this->_userdata]);
	}

	public function datasiswa()
	{
        $this->render('datasiswa', ['title' => 'Data Siswa', 'name' => $this->_userdata]);
	}
	public function datakelas()
	{
        $this->render('datakelas', ['title' => 'Data Kelas', 'name' => $this->_userdata]);
	}
	public function databiaya()
	{
        $this->render('databiaya', ['title' => 'Data Biaya', 'name' => $this->_userdata]);
	}
	public function dataadmin()
	{
        $this->render('dataadmin', ['title' => 'Data Admin', 'name' => $this->_userdata]);
	}
	public function datatransaksi()
	{
        $this->render('datatransaksi', ['title' => 'Data Transaksi', 'name' => $this->_userdata]);
	}
}

