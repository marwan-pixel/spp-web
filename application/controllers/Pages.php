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
		$thnAkademik = $this->model->getDataModel('tahun_akademik', ['thn_akademik']);
		$thnAkademikSelected = $this->model->getDataModel('tahun_akademik', ['thn_akademik', 'status'], ['status' => 1]);
		try {
			$this->render('home', ["title" => "Dashboard", 'name' => $this->_userdata['nama_petugas'], 'data' => [$thnAkademik, $thnAkademikSelected]]);
		} catch (Exception $e) {
			$e->getMessage();
		}
		
	}

	public function homeData(){
		header('Content-Type: application/json');
		$thn_akademik = (string) $this->input->get('thn_akademik');
		$data = 
			array(
				'totalPemasukan' => array(
					'curdate' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->where('MONTH(created_at) = MONTH(CURDATE())')->where("thn_akademik", $thn_akademik)->get()->row_array(),
					'januari' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->where("bulan = 'January'")->where("thn_akademik", $thn_akademik)->get()->row_array(),
					'februari' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->where("MONTHNAME(created_at) = 'February'")->where("thn_akademik", $thn_akademik)->get()->row_array(),
					'maret' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->where("MONTHNAME(created_at) = 'March'")->where("thn_akademik", $thn_akademik)->get()->row_array(),
					'april' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->where("MONTHNAME(created_at) = 'April'")->where("thn_akademik", $thn_akademik)->get()->row_array(),
					'mei' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->where("MONTHNAME(created_at) = 'May'")->where("thn_akademik", $thn_akademik)->get()->row_array(),
					'juni' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->where("MONTHNAME(created_at) = 'June'")->where("thn_akademik", $thn_akademik)->get()->row_array(),
					'juli' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->where("MONTHNAME(created_at) = 'July'")->where("thn_akademik", $thn_akademik)->get()->row_array(),
					'agustus' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->where("MONTHNAME(created_at) = 'August'")->where("thn_akademik", $thn_akademik)->get()->row_array(),
					'september' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->where("MONTHNAME(created_at) = 'September'")->where("thn_akademik", $thn_akademik)->get()->row_array(),
					'oktober' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->where("MONTHNAME(created_at) = 'October'")->where("thn_akademik", $thn_akademik)->get()->row_array(),
					'november' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->where("MONTHNAME(created_at) = 'November'")->where("thn_akademik", $thn_akademik)->get()->row_array(),
					'desember' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->where("MONTHNAME(created_at) = 'Desember'")->where("thn_akademik", $thn_akademik)->get()->row_array(),
					'tahun' => $this->db->select_sum('nominal')->from('transactions')->where('status', 2)->where("thn_akademik", $thn_akademik)->get()->row_array()
				),
				'dataTransaksi' => array(
					'curdate' => $this->db->select('nipd')->from('transactions')->where('status', 2)->where('MONTH(created_at) = MONTH(CURDATE())')->where("thn_akademik", $thn_akademik)->get()->num_rows(),
					'januari' => $this->model->countAllData('transactions', ['status', 'MONTHNAME(created_at)', "thn_akademik" ], [2, 'January', $thn_akademik]),
					'februari' => $this->model->countAllData('transactions', ['status', 'MONTHNAME(created_at)', "thn_akademik" ], [2, 'February', $thn_akademik]),
					'maret' => $this->model->countAllData('transactions', ['status', 'MONTHNAME(created_at)', "thn_akademik" ], [2, 'March', $thn_akademik]),
					'april' => $this->model->countAllData('transactions', ['status', 'MONTHNAME(created_at)', "thn_akademik" ], [2, 'April', $thn_akademik]),
					'mei' => $this->model->countAllData('transactions', ['status', 'MONTHNAME(created_at)', "thn_akademik" ], [2, 'May', $thn_akademik]),
					'juni' => $this->model->countAllData('transactions', ['status', 'MONTHNAME(created_at)', "thn_akademik" ], [2, 'June', $thn_akademik]),
					'juli' => $this->model->countAllData('transactions', ['status', 'MONTHNAME(created_at)', "thn_akademik" ], [2, 'July', $thn_akademik]),
					'agustus' => $this->model->countAllData('transactions', ['status', 'MONTHNAME(created_at)', "thn_akademik" ], [2, 'August', $thn_akademik]),
					'september' => $this->model->countAllData('transactions', ['status', 'MONTHNAME(created_at)', "thn_akademik" ], [2, 'September', $thn_akademik]),
					'oktober' => $this->model->countAllData('transactions', ['status', 'MONTHNAME(created_at)', "thn_akademik" ], [2, 'October', $thn_akademik]),
					'november' => $this->model->countAllData('transactions', ['status', 'MONTHNAME(created_at)', "thn_akademik" ], [2, 'November', $thn_akademik]),
					'desember' => $this->model->countAllData('transactions', ['status', 'MONTHNAME(created_at)', "thn_akademik" ], [2, 'Desember', $thn_akademik]),
					'tahun' => $this->model->countAllData('transactions', ['status', "thn_akademik" ], [2, $thn_akademik]),
				),				
			);
		echo json_encode($data);
		exit();
	}

	public function dataSiswa()
	{
		$this->setData(
			array(
				'base_url' => base_url('pages/datasiswa/'),
				'total_rows' => $this->db->from('siswa')->count_all_results(),

				'per_page' => 20,
			)
		);
		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		if(($this->input->post('keyword'))){
			$keyword = array('nama_siswa' => $this->input->post('keyword'));
			$this->db->like($keyword);
			$this->session->set_userdata('keyword', $keyword['nama_siswa']);
		} else {
			$keyword = $this->session->unset_userdata('keyword');
		}

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
				'base_url' => base_url('pages/datanonaktifsiswa/'),
				'total_rows' => $this->db->from('siswa')->where(['status' => 0])->count_all_results(),

				'per_page' => 20,
			)
		);
		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		if(($this->input->post('keyword'))){
			$keyword = array('nama_siswa' => $this->input->post('keyword'));
			$this->db->like($keyword);
			$this->session->set_userdata('keyword', $keyword['nama_siswa']);
		} else {
			$keyword = $this->session->unset_userdata('keyword');
		}
		
		$dataSiswa = $this->db->select(['nipd', 'nama_siswa', 'kelas', 'potongan' ,'siswa.thn_akademik', 'siswa.status'])
		->join('tahun_akademik', "tahun_akademik.thn_akademik = siswa.thn_akademik")
		->get_where('siswa', ['siswa.status' => 0], $this->getData()['per_page'], $start)
		->result_array();

		try {
			$this->render('datanonaktifsiswa', ['title' => 'Data Nonaktif Siswa', 'name' => $this->_userdata['nama_petugas'], 
			'data' => $dataSiswa, 'start' => $start]);
			
		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	public function dataKelas()
	{
		$this->setData(
			array(
				'base_url' => base_url('pages/datakelas/'),
				'total_rows' => $this->db->from('kelas')->count_all_results(),

				'per_page' => 20,
			)
		);
		
		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		if(($this->input->post('keyword'))){
			$keyword = array('kelas' => $this->input->post('keyword'));
			$this->db->like($keyword);
			$this->session->set_userdata('keyword', $keyword['kelas']);
		} else {
			$keyword = $this->session->unset_userdata('keyword');
		}

		$dataKelas = $this->model->getDataModel('kelas', ['kelas', 'instansi'], ['status' => 1], $this->getData()['per_page'], $start);
		$dataInstansi = $this->model->getDataModel('instansi', ['jenis_instansi'],['status' => 1]);

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
				'base_url' => base_url('pages/datanonaktifkelas/'),
				'total_rows' => $this->db->from('kelas')->where(['status' => 0])->count_all_results(),

				'per_page' => 20,
			)
		);

		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		if(($this->input->post('keyword'))){
			$keyword = array('kelas' => $this->input->post('keyword'));
			$this->db->like($keyword);
			$this->session->set_userdata('keyword', $keyword['kelas']);
		} else {
			$keyword = $this->session->unset_userdata('keyword');
		}

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
				'total_rows' => $this->db->from('jenis_pembayaran')->count_all_results(),

				'per_page' => 20,
			)
		);
		
		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		if(($this->input->post('keyword'))){
			$keyword = array('jenis_pembayaran' => $this->input->post('keyword'));
			$this->db->like($keyword);
			$this->session->set_userdata('keyword', $keyword['jenis_pembayaran']);
		} else {
			$keyword = $this->session->unset_userdata('keyword');
		}

		$dataBiaya = $this->model->getDataModel('jenis_pembayaran', ['id_jenis_pembayaran','jenis_pembayaran', 'biaya', 'instansi'], 
		['status' => 1], $this->getData()['per_page'], $start);
		$dataInstansi = $this->model->getDataModel('instansi', ['jenis_instansi'], ['status' => 1]);
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
				'total_rows' => $this->db->from('jenis_pembayaran')->where(['status' => 0])->count_all_results(),

				'per_page' => 20,
			)
		);
		
		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		if(($this->input->post('keyword'))){
			$keyword = array('jenis_pembayaran' => $this->input->post('keyword'));
			$this->db->like($keyword);
			$this->session->set_userdata('keyword', $keyword['jenis_pembayaran']);
		} else {
			$keyword = $this->session->unset_userdata('keyword');
		}

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
				'total_rows' => $this->db->from('jenis_pembayaran')->count_all_results(),

				'per_page' => 20,
			)
		);

		if(($this->input->post('keyword'))){
			$keyword = array('jenis_instansi' => $this->input->post('keyword'));
			$this->db->like($keyword);
			$this->session->set_userdata('keyword', $keyword['jenis_instansi']);
		} else {
			$keyword = $this->session->unset_userdata('keyword');
		}

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
				'total_rows' => $this->db->from('jenis_pembayaran')->where(['status' => 0])->count_all_results(),
				'per_page' => 20,
				
			)
		);

		if(($this->input->post('keyword'))){
			$keyword = array('jenis_instansi' => $this->input->post('keyword'));
			$this->db->like($keyword);
			$this->session->set_userdata('keyword', $keyword['jenis_instansi']);
		} else {
			$keyword = $this->session->unset_userdata('keyword');
		}

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
				'total_rows' => $this->db->from('admin')->count_all_results(),
				'per_page' => 20,
				
			)
		);

		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		if(($this->input->post('keyword'))){
			$keyword = array('nama_petugas' => $this->input->post('keyword'));
			$this->db->like($keyword);
			$this->session->set_userdata('keyword', $keyword['nama_petugas']);
		} else {
			$keyword = $this->session->unset_userdata('keyword');
		}

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
				'total_rows' => $this->db->from('admin')->where(['status' => 0])->count_all_results(),
				'per_page' => 20,
				
			)
		);

		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		if(($this->input->post('keyword'))){
			$keyword = array('nama_petugas' => $this->input->post('keyword'));
			$this->db->like($keyword);
			$this->session->set_userdata('keyword', $keyword['nama_petugas']);
		} else {
			$keyword = $this->session->unset_userdata('keyword');
		}

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
		$dataTahunAkademik = $this->model->getDataModel('tahun_akademik', ['thn_akademik']);
		$dataTahunAkademikSelected = $this->model->getDataModel('tahun_akademik', ['thn_akademik', 'status'], ['status' => 1]);
		try {
			$this->render('datatransaksi', ['title' => 'Data Transaksi', 'name' => $this->_userdata['nama_petugas'], 'data' => [$dataTahunAkademik, $dataTahunAkademikSelected]]);
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataTransaksiData(){
		$nipd = $this->input->get('query');
		$tahunAkademik = $this->input->get('thn_akademik');
		$dataSiswa = $this->model->getDataJoinModel(['siswa', 'kelas'] ,['nama_siswa', 'siswa.kelas', 'potongan', 'instansi', 'nipd', 'thn_akademik', 'siswa.status'], 
		["kelas", "nipd"], ['nipd' => $nipd]);
		
		if(is_null($dataSiswa)) {
			$response['errors'] = "Data tidak ditemukan!";
		} else {

			//Ambil Riwayat Data Transaksi Berdasarkan NIPD
			$dataTransaksi = $this->model->getDataModel('transactions', 
			['nipd', 'nominal', 'status', 'image', 'keterangan', 'bulan' ,'created_at'], ['nipd' => $dataSiswa['nipd'], 'thn_akademik' => $tahunAkademik]);

			//Ambil Jumlah Nominal dari tabel jenis_pembayaran Berdasarkan instansi
			$dataBiaya = $this->model->getDataModel('jenis_pembayaran', ['biaya', 'jenis_pembayaran'], ['instansi' => $dataSiswa['instansi'], 'status' => 1]);

			//Ambil Jumlah Uang Masuk Berdasarkan NIPD
			$dataNominalMasuk = $this->db->select(['nominal', 'bulan'])
				->from('transactions')->join('siswa', "transactions.nipd = siswa.nipd")->join('tahun_akademik', "tahun_akademik.thn_akademik = siswa.thn_akademik")
				->where(['transactions.status' => 2, 'siswa.nipd' => $dataSiswa['nipd'], 'siswa.status' => 1, 'transactions.thn_akademik' => $tahunAkademik,])
				->get()
				->result_array();
			
			$dataSumNominalMasuk = $this->db->select(['sum(nominal)'])
				->from('transactions')->join('siswa', "transactions.nipd = siswa.nipd")->join('tahun_akademik', "tahun_akademik.thn_akademik = siswa.thn_akademik")
				->where(['transactions.status' => 2, 'siswa.nipd' => $dataSiswa['nipd'], 'siswa.status' => 1, 'transactions.thn_akademik' => $tahunAkademik,])
				->get()
				->result_array();
			
			$total = 0;
			if(empty($dataBiaya)){
				$response['biaya'] = 0;
			} else {
				foreach ($dataBiaya as $biaya) {
					# code...
					$total += $biaya['biaya'];
				}
				$response['biaya'] = $total;

			}
			$response['dataBiaya'] = $dataBiaya;
			
			$response['nominalMasuk'] = $dataSumNominalMasuk[0]['sum(nominal)'];

			$response['dataNominalMasuk'] = $dataNominalMasuk;

			if(is_null($dataTransaksi) || empty($dataTransaksi)){
				$response['errors'] = "Data Transaksi Belum Tersedia!";
			} else {
				$response['dataTransaksi'] = $dataTransaksi;
			}

			if($dataSiswa['status'] == 1){
				$dataSiswa['status'] = "Aktif";
			} else {
				$dataSiswa['status'] = "Tidak Aktif";
			}

			$response['dataSiswa'] = array('nipd' => $dataSiswa['nipd'], 'nama_siswa' => $dataSiswa['nama_siswa'], 'kelas' => $dataSiswa['kelas'], 
			'instansi' => $dataSiswa['instansi'], 'potongan' => $dataSiswa['potongan'], 'thn_akademik' => $dataSiswa['thn_akademik'], 'status' => $dataSiswa['status']);
			header('Content-Type: application/json');
            echo json_encode($response);
		}
	}

	public function dataTransaksiHome()
	{

		$dataKelas = $this->model->getDataModel('kelas', ['kelas']);
		try {
			$this->render('datatransaksiHome', ['title' => 'Data Transaksi', 'name' => $this->_userdata['nama_petugas'], 'data' => [$dataKelas]]);
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataTransaksiHomeData()
	{
		header('Content-Type: application/json');
		$kelas = $this->input->get('kelas');
		$status = $this->input->get('status');
		$keyword = $this->input->get('keyword');

		$data = [];
		if(!(empty($kelas)) && !(empty($status)) && !(empty($keyword))) {
			if($status == 'aktif') {
				$status = 1;
			} else {
				$status = 0;
			}
			$dataSiswa = $this->model->getDataModel(table: 'siswa', data: ['nipd, nama_siswa, kelas, status, potongan'], param: ['status' => $status, 'kelas' => $kelas], 
			keyword: ['nama_siswa' => $keyword]);
		} elseif(!(empty($keyword))) {
			$dataSiswa = $this->model->getDataModel(table: 'siswa', data: ['nipd, nama_siswa, kelas, status, potongan'], keyword: ['nama_siswa' => $keyword]);
		} elseif(!(empty($kelas))) {
			$dataSiswa = $this->model->getDataModel(table: 'siswa', data: ['nipd, nama_siswa, kelas, status, potongan'], param: ['kelas' => $kelas]);
		} elseif(!(empty($status))){
			if($status == 'aktif') {
				$status = 1;
			} else {
				$status = 0;
			}
			$dataSiswa = $this->model->getDataModel(table: 'siswa', data: ['nipd, nama_siswa, kelas, status, potongan'], param: ['status' => $status]);
		} else {
			$dataSiswa = $this->model->getDataModel(table: 'siswa', data: ['nipd, nama_siswa, kelas, status, potongan']);
		}
		for ($i=0; $i < count($dataSiswa); $i++) { 
			# code...
			$dataTransaksi = $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal_masuk'], param: ['nipd' => $dataSiswa[$i]['nipd'], "bulan" => date('Y-m-01')]);
			$dataSiswa[$i]['nominal_masuk'] = $dataTransaksi[0]['nominal_masuk'];
			$dataInstansi = $this->model->getDataModel(table: 'kelas', data: ['instansi'], param: ['kelas' => $dataSiswa[$i]['kelas']]);
			$dataBiaya = $this->model->getDataModel(table: 'jenis_pembayaran', data: ['sum(biaya) as biaya'], param: ['instansi' => $dataInstansi[0]['instansi']]);
			if($dataSiswa[$i]['nominal_masuk'] == ($dataBiaya[0]['biaya'] - $dataSiswa[$i]['potongan'])){
				$dataSiswa[$i]['status'] = 'Lunas'; 
			} else {
				$dataSiswa[$i]['status'] = 'Belum Lunas'; 
				
			}
		}
		echo json_encode($dataSiswa);
		$data['dataSiswa'] = $dataSiswa;
		exit();
	}

	public function dataTahunAkademik() {
		$this->setData(
			array(
				'base_url' => base_url('pages/datatahunakademik/'),
				'total_rows' => $this->db->from('tahun_akademik')->count_all_results(),
				'per_page' => 20,
			)
		);

		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		if(($this->input->post('keyword'))){
			$keyword = array('thn_akademik' => $this->input->post('keyword'));
			$this->db->like($keyword);
			$this->session->set_userdata('keyword', $keyword['thn_akademik']);
		} else {
			$keyword = $this->session->unset_userdata('keyword');
		}

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
				'total_rows' => $this->db->from('pengeluaran')->count_all_results(),
				'per_page' => 10,
			)
		);

		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		if(($this->input->post('keyword'))){
			$keyword = array('keterangan' => $this->input->post('keyword'));
			$this->db->like($keyword);
			$this->session->set_userdata('keyword', $keyword['keterangan']);
		} else {
			$keyword = $this->session->unset_userdata('keyword');
		}

		$dataPengeluaran = $this->model->getDataModel('pengeluaran', ['id_pengeluaran', 'nominal', 'arus_kas' ,'keterangan'], ['arus_kas' => 0, 'status' => 1], $this->getData()['per_page'], $start);
		try {
			$this->render('datapengeluaran', ['title' => 'Data Pengeluaran', 'name' => $this->_userdata['nama_petugas'], 'data' => $dataPengeluaran, 'start' => $start]);

		} catch (Exception $e){
			$e->getMessage();
		}
	}
	public function datanonaktifPengeluaran() {
		$this->setData(
			array(
				'base_url' => base_url('pages/datanonaktifpengeluaran/'),
				'total_rows' => $this->db->from('pengeluaran')->where(['status' => 0])->count_all_results(),
				'per_page' => 20,
			)
		);

		$start = $this->uri->segment(3);
		$this->pagination->initialize($this->getData());

		if(($this->input->post('keyword'))){
			$keyword = array('keterangan' => $this->input->post('keyword'));
			$this->db->like($keyword);
			$this->session->set_userdata('keyword', $keyword['keterangan']);
		} else {
			$keyword = $this->session->unset_userdata('keyword');
		}

		$dataPengeluaran = $this->model->getDataModel('pengeluaran', ['id_pengeluaran', 'nominal', 'arus_kas' ,'keterangan'], ['arus_kas' => 0, 'status' => 1], $this->getData()['per_page'], $start);
		try {
			$this->render('datanonaktifpengeluaran', ['title' => 'Data Nonaktif Pengeluaran', 'name' => $this->_userdata['nama_petugas'], 'data' => $dataPengeluaran, 'start' => $start]);

		} catch (Exception $e){
			$e->getMessage();
		}
	}
}
