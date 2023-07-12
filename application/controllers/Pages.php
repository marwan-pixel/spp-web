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
				'total' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->get()->row_array(),
				'datatransaksi' => array(
					'all' => $this->db->select('nipd')->from('transactions')->where('MONTH(created_at) = MONTH(CURDATE())')->get()->num_rows(),
				)
			)
		);
		try {
			$this->render('home', ["title" => "Dashboard", 'name' => $this->_userdata['nama_petugas'], 'data' => $this->getData()]);
		} catch (Exception $e) {
			$e->getMessage();
		}
		
	}

	public function dataSiswa()
	{
		if(($this->input->post('keyword'))){
			$keyword = array('nama_siswa' => $this->input->post('keyword'));
			$this->db->like($keyword);
			$this->session->set_userdata('keyword', $keyword['nama_siswa']);
		} else {
			$keyword = $this->session->unset_userdata('keyword');
		}
		
		$this->setData(
			array(
				'base_url' => base_url('pages/datasiswa/'),
				'total_rows' => $this->db->from('siswa')->count_all_results(),

				'per_page' => 20,
			)
		);
		$start = $this->uri->segment(3);

		$this->pagination->initialize($this->getData());

		$dataSiswa = $this->db->select(['nipd', 'nama_siswa', 'kelas', 'potongan' ,'siswa.thn_akademik', 'siswa.status'])
		->join('tahun_akademik', "tahun_akademik.thn_akademik = siswa.thn_akademik")
		->get_where('siswa', ['siswa.status' => 1], $this->getData()['per_page'], $start)
		->result_array();
		$dataKelas = $this->model->getDataModel('kelas', ['kelas'], ['status' => 1]);
		$dataTahunAkademik = $this->model->getDataModel('tahun_akademik', ['thn_akademik']);
		try {
			$this->render('datasiswa', ['title' => 'Data Siswa', 'name' => $this->_userdata['nama_petugas'], 
			'data' => array('dataSiswa' => $dataSiswa, 'dataKelas' => $dataKelas, 'dataTahunAkademik' => $dataTahunAkademik), 'start' => $start]);
			
		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	public function datanonaktifSiswa(){
		$this->setData(
			array(
				'base_url' => base_url("pages/datanonaktifsiswa/"),
				'total_rows' => $this->model->countAllData('siswa'),
				'per_page' => 10,
				
			)
		);

		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		$dataSiswa = $this->db->select(['nipd', 'nama_siswa', 'kelas', 'potongan' ,'siswa.thn_akademik', 'siswa.status'])
		->join('tahun_akademik', "tahun_akademik.thn_akademik = siswa.thn_akademik")
		->get_where('siswa', ['siswa.status' => 0], $this->getData()['per_page'], $start)
		->result_array();

		try {
			$this->render('datanonaktifsiswa', ['title' => 'Data Non Aktif Siswa', 'name' => $this->_userdata['nama_petugas'], 
			'data' => array('dataSiswa' => $dataSiswa),'start' => $start]);		
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataKelas()
	{
		$this->setData(
			array(
				'base_url' => base_url("pages/datakelas/"),
				'total_rows' => $this->model->countAllData('kelas'),
				'per_page' => 10,
				
			)
		);

		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		$dataInstansi = $this->model->getDataModel('instansi', ['jenis_instansi'],['status' => 1]);
		$dataKelas = $this->model->getDataModel('kelas', ['kelas', 'instansi'], ['status' => 1], $this->getData()['per_page'], $start);

		try {
			$this->render('datakelas', ['title' => 'Data Kelas', 'name' => $this->_userdata['nama_petugas'], 
			'data' => array('dataKelas' => $dataKelas, 'dataInstansi' => $dataInstansi),'start' => $start]);		
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function datanonaktifKelas(){
		$this->setData(
			array(
				'base_url' => base_url("pages/datanonaktifkelas/"),
				'total_rows' => $this->model->countAllData('kelas'),
				'per_page' => 10,
				
			)
		);

		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		$dataKelas = $this->model->getDataModel('kelas', ['kelas', 'instansi'], ['status' => 0], $this->getData()['per_page'], $start);

		try {
			$this->render('datanonaktifkelas', ['title' => 'Data Non Aktif Kelas', 'name' => $this->_userdata['nama_petugas'], 
			'data' => $dataKelas,'start' => $start]);		
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataBiaya()
	{
		$this->setData(
			array(
				'base_url' => base_url('pages/databiaya/'),
				'total_rows' => $this->model->countAllData('jenis_pembayaran'),
				'per_page' => 10,
				
			)
		);
		
		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());
		$dataInstansi = $this->model->getDataModel('instansi', ['jenis_instansi'], ['status' => 1]);
		$dataBiaya = $this->model->getDataModel('jenis_pembayaran', ['id_jenis_pembayaran','jenis_pembayaran', 'biaya', 'instansi'], 
		['status' => 1], $this->getData()['per_page'], $start);
		try {
			$this->render('databiaya', ['title' => 'Data Biaya', 'name' => $this->_userdata['nama_petugas'], 
			'data' => array('dataBiaya' => $dataBiaya, 'dataInstansi' => $dataInstansi), 
			'start' => $start]);
		} catch (Exception $e){
			$e->getMessage();
		}
	}
	
	public function datanonaktifBiaya()
	{
		$this->setData(
			array(
				'base_url' => base_url('pages/datanonaktifbiaya/'),
				'total_rows' => $this->model->countAllData('jenis_pembayaran'),
				'per_page' => 10,
				
			)
		);
		
		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());
		$dataBiaya = $this->model->getDataModel('jenis_pembayaran', ['id_jenis_pembayaran','jenis_pembayaran', 'biaya', 'instansi'], 
		['status' => 0], $this->getData()['per_page'], $start);
		try {
			$this->render('datanonaktifbiaya', ['title' => 'Data Non Aktif Biaya', 'name' => $this->_userdata['nama_petugas'], 'data' => $dataBiaya,
			'start' => $start]);
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataInstansi()
	{
		$this->setData(
			array(
				'base_url' => base_url('pages/datainstansi/'),
				'total_rows' => $this->model->countAllData('instansi'),
				'per_page' => 10,
				
			)
		);

		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());
		$dataInstansi = $this->model->getDataModel('instansi', ['jenis_instansi'], ['status' => 1], $this->getData()['per_page'], $start);
		try {
			$this->render('datainstansi', ['title' => 'Data Instansi', 'name' => $this->_userdata['nama_petugas'], 
			'data' => array('dataInstansi' => $dataInstansi)]);
			
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function datanonaktifInstansi(){
		$this->setData(
			array(
				'base_url' => base_url('pages/datanonaktifinstansi/'),
				'total_rows' => $this->model->countAllData('instansi'),
				'per_page' => 10,
				
			)
		);

		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());
		$dataInstansi = $this->model->getDataModel('instansi', ['jenis_instansi'], ['status' => 0], $this->getData()['per_page'], $start);
		try {
			$this->render('datanonaktifinstansi', ['title' => 'Data Non Aktif Instansi', 'name' => $this->_userdata['nama_petugas'], 
			'data' => array('dataInstansi' => $dataInstansi), 'start' => $start]);
			
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function halamanAdmin()
	{
		$dataAdmin = $this->model->getDataModel('admin', ['kode_petugas', 'nama_petugas'], ['kode_petugas' => $this->session->userdata('kode_petugas')]);
		try {
			$this->render('halamanadmin', ['title' => 'Halaman Admin', 'name' => $this->_userdata['nama_petugas'], 'kode' => $dataAdmin[0]['kode_petugas']]);

		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataAdmin()
	{
		$this->setData(
			array(
				'base_url' => base_url('pages/datadmin/'),
				'total_rows' => $this->model->countAllData('admin'),
				'per_page' => 10,
				
			)
		);
		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());
		$dataAdmin = $this->model->getDataModel('admin', ['kode_petugas', 'nama_petugas'], ['status' => 1], $this->getData()['per_page'], $start);
		try {
			$this->render('dataadmin', ['title' => 'Data Admin', 'name' => $this->_userdata['nama_petugas'], 'data' => $dataAdmin, 'start' => $start]);

		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function datanonaktifAdmin()
	{
		$this->setData(
			array(
				'base_url' => base_url('pages/datanonaktifadmin/'),
				'total_rows' => $this->model->countAllData('admin'),
				'per_page' => 10,
				
			)
		);
		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());
		$dataAdmin = $this->model->getDataModel('admin', ['kode_petugas', 'nama_petugas'], ['status' => 0], 
		$this->getData()['per_page'], $start);
		try {
			$this->render('datanonaktifadmin', ['title' => 'Data Non Aktif Admin', 'name' => $this->_userdata['nama_petugas'], 
			'data' => $dataAdmin, 'start' => $start]);

		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataTransaksi()
	{
		$this->setData(
			array(
				'base_url' => base_url('spp-web/pages/datatransaksi/'),
				'total_rows' => $this->model->countAllData('transactions'),
				'per_page' => 10,
			)
		);
		$dataTahunAkademik = $this->model->getDataModel('tahun_akademik', ['thn_akademik']);

		try {
			$this->render('datatransaksi', ['title' => 'Data Transaksi', 'name' => $this->_userdata['nama_petugas'], 'data' => $dataTahunAkademik]);
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataTahunAkademik() {
		$this->setData(
			array(
				'base_url' => base_url('pages/datatahunakademik/'),
				'total_rows' => $this->model->countAllData('tahun_akademik'),
				'per_page' => 10,
			)
		);
		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());
		$dataTahunAkademik = $this->model->getDataModel('tahun_akademik', ['thn_akademik', 'status'], null, $this->getData()['per_page'], $start);
		try {
			$this->render('datatahunakademik', ['title' => 'Data Tahun Akademik', 'name' => $this->_userdata['nama_petugas'], 'data' => $dataTahunAkademik, 'start' => $start]);

		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataPengeluaran() {
		$this->setData(
			array(
				'base_url' => base_url('pages/datapengeluaran/'),
				'total_rows' => $this->model->countAllData('pengeluaran'),
				'per_page' => 10,
			)
		);
		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());
		$dataPengeluaran = $this->model->getDataModel('pengeluaran', ['id_pengeluaran', 'nominal', 'arus_kas' ,'keterangan'], ['arus_kas' => 0, 'status' => 1], $this->getData()['per_page'], $start);
		try {
			$this->render('datapengeluaran', ['title' => 'Data Pengeluaran', 'name' => $this->_userdata['nama_petugas'], 'data' => $dataPengeluaran, 'start' => $start]);

		} catch (Exception $e){
			$e->getMessage();
		}
	}
}
