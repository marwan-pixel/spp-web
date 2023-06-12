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

		$this->db->select('nama_petugas');
		$this->_userdata =  $this->db->get_where('admin', ['kode_petugas' => $this->session->userdata('kode_petugas')])->row_array();
	}

	public function render(string $view, $model)
	{
        $this->load->view('template/header', $model);
		$this->load->view($view, $model);
        $this->load->view('template/footer');
	}

	public function home()
	{
		$this->setData(
			array(
				'datasiswa' => array( 
					'all' => $this->model->countAllData('siswa'),
					'tk' => $this->model->countAllData('siswa', 'kelas', 'tk'),
					'sd' => $this->db->select('kelas')->from('siswa')->where("kelas REGEXP '[0-6]'")->get()->num_rows(),
					'smp' => $this->db->select('kelas')->from('siswa')->where("kelas REGEXP '[7-9][A-B]'")->get()->num_rows(),
					'ponpes' => $this->model->countAllData('siswa', 'kelas', 'c')
				),
				'datakelas' => array(
					'all' => $this->model->countAllData('kelas'),
					'tk' => $this->model->countAllData('kelas', 'instansi', 'tk'),
					'sd' => $this->model->countAllData('kelas', 'instansi', 'sd'),
					'smp' => $this->model->countAllData('kelas', 'instansi', 'smp'),
					'ponpes' => $this->model->countAllData('kelas', 'instansi', 'ponpes')	
				),
				'total' => $this->db->select_sum('nominal')->from('transactions')->where('status', "Diterima")->get()->row_array(),
				'datatransaksi' => array(
					'all' => $this->db->select('nipd')->from('transactions')->where('MONTH(created_at) = MONTH(CURDATE())')->get()->num_rows(),
				)
			)
		);
		$this->render('home', ["title" => "Dashboard", 'name' => $this->_userdata['nama_petugas'], 'data' => $this->getData()]);
	}

	public function datasiswa()
	{
		if(($this->input->post('keyword'))){
			$keyword = array('nama_siswa', $this->input->post('keyword'));
			$this->db->like($keyword[0], $keyword[1]);
			$this->session->set_userdata('keyword', $keyword[1]);
		} else {
			$keyword = $this->session->userdata('keyword');
		}
		
		$this->setData(
			array(
				'base_url' => 'http://localhost:8080/spp-web/pages/datasiswa/',
				'total_rows' => $this->db->from('siswa')->count_all_results(),

				'per_page' => 10,
			)
		);
		$start = $this->uri->segment(3);

		$this->pagination->initialize($this->getData());
		$dataSiswa = $this->model->getDataModel('siswa', ['nipd', 'nama_siswa', 'kelas', 'potongan'], null, $this->getData()['per_page'], $start, $keyword);
		$dataKelas = $this->model->getDataModel('kelas', ['kelas']);
        $this->render('datasiswa', ['title' => 'Data Siswa', 'name' => $this->_userdata['nama_petugas'], 

		'data' => array('dataSiswa' => $dataSiswa, 'dataKelas' => $dataKelas), 'start' => $start]);
	}

	public function datakelas()
	{
		$this->setData(
			array(
				'base_url' => 'https://arrahman.site/spp-web/pages/datakelas/',
				'total_rows' => $this->model->countAllData('kelas'),
				'per_page' => 10,
				
			)
		);

		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		$dataInstansi = $this->model->getDataModel('instansi', ['instansi']);
		$dataKelas = $this->model->getDataModel('kelas', ['kelas', 'instansi'], null, $this->getData()['per_page'], $start);
        $this->render('datakelas', ['title' => 'Data Kelas', 'name' => $this->_userdata['nama_petugas'], 
		'data' => array('dataKelas' => $dataKelas, 'dataInstansi' => $dataInstansi),'start' => $start]);

	}

	public function databiaya()
	{
		$this->setData(
			array(
				'base_url' => 'http://localhost:8080/spp-web/pages/databiaya/',
				'total_rows' => $this->model->countAllData('jenis_pembayaran'),
				'per_page' => 10,
				
			)
		);
		
		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());
		$dataInstansi = $this->model->getDataModel('instansi', ['instansi']);
		$dataBiaya = $this->model->getDataModel('jenis_pembayaran', ['id_jenis_pembayaran','jenis_pembayaran', 'biaya', 'instansi'], null, $this->getData()['per_page'], $start);
		try {
			$this->render('databiaya', ['title' => 'Data Biaya', 'name' => $this->_userdata['nama_petugas'], 'data' => array('dataBiaya' => $dataBiaya, 'dataInstansi' => $dataInstansi)]);
			
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function datainstansi()
	{
		$this->setData(
			array(
				'base_url' => 'http://localhost:8080/spp-web/pages/datainstansi/',
				'total_rows' => $this->model->countAllData('instansi'),
				'per_page' => 10,
				
			)
		);

		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());
		$dataInstansi = $this->model->getDataModel('instansi', ['instansi'], null, $this->getData()['per_page'], $start);
		try {
			$this->render('datainstansi', ['title' => 'Data Biaya', 'name' => $this->_userdata['nama_petugas'], 'data' => array('dataInstansi' => $dataInstansi)]);
			
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataadmin()
	{
		$dataAdmin = $this->model->getDataModel('admin', ['kode_petugas', 'nama_petugas'], ['kode_petugas' => $this->session->userdata('kode_petugas')]);
		try {
			$this->render('dataadmin', ['title' => 'Data Admin', 'name' => $this->_userdata['nama_petugas'], 'kode' => $dataAdmin['kode_petugas']]);

		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function datatransaksi()
	{
		$this->setData(
			array(
				'base_url' => 'http://localhost:8080/spp-web/pages/datatransaksi/',
				'total_rows' => $this->model->countAllData('transactions'),
				'per_page' => 10,
			)
		);
		$searchInput = $this->input->post('keyword');
		$dataSiswa = null;
		$dataTransaksi = null;
		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());
		// Check if search input is empty
		if (empty($searchInput)) {
			// Clear the search message from session or storage
			$this->session->unset_userdata('search_message');
		} else {

			$keyword = $searchInput;
			$dataSiswa = $this->model->getDataJoinModel('siswa', 'kelas' ,"*", ["kelas", "nipd"], $keyword);
			$dataTransaksi = $this->model->getDataModel('transactions', 
			['nipd', 'nominal', 'status', 'image', 'keterangan', 'created_at'], ['nipd' => $keyword], $this->getData()['per_page'], $start);
			if(is_null($dataSiswa)){
				$this->session->set_userdata('search_message', 'Data tidak ditemukan!');
			}
		}
	
        $this->render('datatransaksi', ['title' => 'Data Transaksi', 'name' => $this->_userdata['nama_petugas'], 
			'data' => array('dataTransaksi' => $dataTransaksi, 'dataSiswa' => $dataSiswa), 'start' => $start]);
	}

}
