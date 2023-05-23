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
		$this->load->library('pagination');

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
		$this->setData(
			array(
				'base_url' => 'https://arrahman.site/spp-web/pages/datasiswa/',
				'total_rows' => $this->model->countAllData('siswa'),
				'per_page' => 10,
				'full_tag_open' => '<nav> <ul class="pagination">',
				'full_tag_close' => '</ul></nav>',
				'first_link' => 'First',
				'first_tag_open' => '<li class="page-item">',
				'first_tag_close' => '</li>',
				'last_link' => 'Last',
				'last_tag_open' => '<li class="page-item">',
				'last_tag_close' => '</li>',
				'next_link' => '&raquo',
				'next_tag_open' => '<li class="page-item">',
				'next_tag_close' => '</li>',
				'prev_link' => '&laquo',
				'prev_tag_open' => '<li class="page-item">',
				'prev_tag_close' => '</li>',
				'cur_tag_open' => '<li class="page-item active"><a class="page-link" href="#">',
				'cur_tag_close' => '</a></li>',
				'num_tag_open' => '<li class="page-item">',
				'num_tag_close' => '</li>',
				'attributes' => array('class' => 'page-link')
			)
		);

		$start = $this->uri->segment(3);
		
		$this->pagination->initialize($this->getData());
		$dataSiswa = $this->model->getDataModel('siswa', ['nis', 'nama_siswa', 'kelas', 'biaya', 'ket_biaya'], null, $this->getData()['per_page'], $start);
		$dataKelas = $this->model->getDataModel('kelas', ['kelas']);	
        $this->render('dataSiswa', ['title' => 'Data Siswa', 'name' => $this->_userdata['kode_petugas'], 
		'data' => array('dataSiswa' => $dataSiswa, 'dataKelas' => $dataKelas), 'start' => $start]);
	}
	public function datakelas()
	{
		$this->setData(
			array(
				'base_url' => 'https://arrahman.site/spp-web/pages/datakelas/',
				'total_rows' => $this->model->countAllData('kelas'),
				'per_page' => 10,
				'full_tag_open' => '<nav> <ul class="pagination">',
				'full_tag_close' => '</ul></nav>',
				'first_link' => 'First',
				'first_tag_open' => '<li class="page-item">',
				'first_tag_close' => '</li>',
				'last_link' => 'Last',
				'last_tag_open' => '<li class="page-item">',
				'last_tag_close' => '</li>',
				'next_link' => '&raquo',
				'next_tag_open' => '<li class="page-item">',
				'next_tag_close' => '</li>',
				'prev_link' => '&laquo',
				'prev_tag_open' => '<li class="page-item">',
				'prev_tag_close' => '</li>',
				'cur_tag_open' => '<li class="page-item active"><a class="page-link" href="#">',
				'cur_tag_close' => '</a></li>',
				'num_tag_open' => '<li class="page-item">',
				'num_tag_close' => '</li>',
				'attributes' => array('class' => 'page-link')
			)
		);

		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		$dataKelas = $this->model->getDataModel('kelas', ['kelas', 'instansi'], null, $this->getData()['per_page'], $start);
        $this->render('dataKelas', ['title' => 'Data Kelas', 'name' => $this->_userdata['kode_petugas'], 
		'data' => array('dataKelas' => $dataKelas),'start' => $start]);
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
			$this->render('dataAdmin', ['title' => 'Data Admin', 'name' => $this->_userdata['kode_petugas'], 'info' => $dataAdmin['nama_petugas']]);
		} catch (Exception $e){
			$e->getMessage();
		}
	}
	public function datatransaksi()
	{
		$this->setData(
			array(
				'base_url' => 'https://arrahman.site/spp-web/pages/datatransaksi',
				'total_rows' => $this->model->countAllData('transactions'),
				'per_page' => 10,
				'full_tag_open' => '<nav> <ul class="pagination">',
				'full_tag_close' => '</ul></nav>',
				'first_link' => 'First',
				'first_tag_open' => '<li class="page-item">',
				'first_tag_close' => '</li>',
				'last_link' => 'Last',
				'last_tag_open' => '<li class="page-item">',
				'last_tag_close' => '</li>',
				'next_link' => '&raquo',
				'next_tag_open' => '<li class="page-item">',
				'next_tag_close' => '</li>',
				'prev_link' => '&laquo',
				'prev_tag_open' => '<li class="page-item">',
				'prev_tag_close' => '</li>',
				'cur_tag_open' => '<li class="page-item active"><a class="page-link" href="#">',
				'cur_tag_close' => '</a></li>',
				'num_tag_open' => '<li class="page-item">',
				'num_tag_close' => '</li>',
				'attributes' => array('class' => 'page-link')
			)
		);
		
		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());
		$dataTransaksi = $this->model->getDataModel('transactions', ['*'], null, $this->getData()['per_page'], $start);
        $this->render('dataTransaksi', ['title' => 'Data Transaksi', 'name' => $this->_userdata['kode_petugas'], 
        'data' => array('dataTransaksi' => $dataTransaksi),'start' => $start]);
	}
}
