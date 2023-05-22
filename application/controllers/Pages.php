<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'controllers/User.php';

class Pages extends User {

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
		$this->_userdata = $this->session->userdata('id');
	}

	public function render(string $view, $model)
	{
        $this->load->view('template/header', $model);
		$this->load->view($view, $model);
        $this->load->view('template/footer');
	}

	public function home()
	{
		$this->render('home', ["title" => "Dashboard", 'name' => $this->_userdata['kode_petugas']]);
	}

	public function datasiswa()
	{
		$dataSiswa = $this->model->getDataModel('siswa', ['nipd', 'nama_siswa', 'kelas', 'biaya', 'ket_biaya']);
		$dataKelas = $this->model->getDataModel('kelas', ['kelas']);	
        $this->render('datasiswa', ['title' => 'Data Siswa', 'name' => $this->_userdata['kode_petugas'], 
		'data' => array('dataSiswa' => $dataSiswa, 'dataKelas' => $dataKelas)]);
	}
	public function datakelas()
	{
		$dataKelas = $this->model->getDataModel('kelas', ['kelas', 'instansi']);
		$dataInstansi = $this->model->getDataModel('biaya', ['instansi']);	
        $this->render('datakelas', ['title' => 'Data Kelas', 'name' => $this->_userdata['kode_petugas'], 
		'data' => array('dataKelas' => $dataKelas, 'dataInstansi' => $dataInstansi)]);
	}
	public function databiaya()
	{
		$dataAdmin = $this->model->getDataModel('biaya', ['instansi', 'biaya']);
		try {
			$this->render('databiaya', ['title' => 'Data Biaya', 'name' => $this->_userdata['kode_petugas'], 'data' => $dataAdmin]);
			
		} catch (Exception $e){
			$e->getMessage();
		}
	}
	public function dataadmin()
	{
		$dataAdmin = $this->model->getDataModel('admin', ['kode_petugas', 'nama_petugas'], $this->_userdata);
		try {
			$this->render('dataadmin', ['title' => 'Data Admin', 'name' => $this->_userdata['kode_petugas'], 'info' => $dataAdmin['nama_petugas']]);
		} catch (Exception $e){
			$e->getMessage();
		}
	}
	public function datatransaksi()
	{
        $this->render('datatransaksi', ['title' => 'Data Transaksi', 'name' => $this->_userdata['kode_petugas']]);
	}
}
