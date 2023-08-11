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
		$thn_akademik = $this->input->get('thn_akademik');
		$data = 
			array(
				'totalPemasukan' => array(
					'curdate' => $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal'], param: ["status" => 2, "MONTH(created_at)" => date("m"), "thn_akademik" => $thn_akademik], array: 0),
					'januari' => $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal'], param: ["status" => 2, "MONTHNAME(created_at)" => "January", "thn_akademik" => $thn_akademik], array: 0),
					'februari' => $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal'], param: ["status" => 2, "MONTHNAME(created_at)" => "February", "thn_akademik" => $thn_akademik], array: 0),
					'maret' => $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal'], param: ["status" => 2, "MONTHNAME(created_at)" => "March", "thn_akademik" => $thn_akademik], array: 0),
					'april' => $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal'], param: ["status" => 2, "MONTHNAME(created_at)" => "April", "thn_akademik" => $thn_akademik], array: 0),
					'mei' => $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal'], param: ["status" => 2, "MONTHNAME(created_at)" => "May", "thn_akademik" => $thn_akademik], array: 0),
					'juni' => $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal'], param: ["status" => 2, "MONTHNAME(created_at)" => "June", "thn_akademik" => $thn_akademik], array: 0),
					'juli' => $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal'], param: ["status" => 2, "MONTHNAME(created_at)" => "July", "thn_akademik" => $thn_akademik], array: 0),
					'agustus' => $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal'], param: ["status" => 2, "MONTHNAME(created_at)" => "August", "thn_akademik" => $thn_akademik], array: 0),
					'september' => $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal'], param: ["status" => 2, "MONTHNAME(created_at)" => "September", "thn_akademik" => $thn_akademik], array: 0),
					'oktober' => $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal'], param: ["status" => 2, "MONTHNAME(created_at)" => "October", "thn_akademik" => $thn_akademik], array: 0),
					'november' => $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal'], param: ["status" => 2, "MONTHNAME(created_at)" => "November", "thn_akademik" => $thn_akademik], array: 0),
					'desember' => $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal'], param: ["status" => 2, "MONTHNAME(created_at)" => "December", "thn_akademik" => $thn_akademik], array: 0),
					'tahun' => $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal'], param: ["status" => 2, "thn_akademik" => $thn_akademik], array: 0)
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
					'desember' => $this->model->countAllData('transactions', ['status', 'MONTHNAME(created_at)', "thn_akademik" ], [2, 'December', $thn_akademik]),
					'tahun' => $this->model->countAllData('transactions', ['status', "thn_akademik" ], [2, $thn_akademik]),
				),				
			);
		echo json_encode($data);
		exit();
	}

	public function dataSiswa()
	{
		$dataKelas = $this->model->getDataModel('kelas', ['kelas'], ['status' => 1]);
		$dataTahunAkademik = $this->model->getDataModel('tahun_akademik', ['thn_akademik']);
		try {
			$this->render('datasiswa', ['title' => 'Data Siswa', 'name' => $this->_userdata['nama_petugas'], 
			'data' => array( 'dataKelas' => $dataKelas, 'dataTahunAkademik' => $dataTahunAkademik)]);
			
		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	public function dataSiswaData()
	{
		$kelas = $this->input->get('kelas');
		$keyword = $this->input->get('keyword');
		$status = $this->input->get('status');
		$data = [];
		if(!(empty($kelas)) && !(empty($keyword))) {
			$dataSiswa = $this->model->getDataJoinModel(table: ['siswa', 'tahun_akademik'], data: ['nipd', 'nama_siswa', 'kelas', 'potongan' ,'siswa.thn_akademik as thn_akademik', 'siswa.status as status'],
			column: ['thn_akademik'], params: ['siswa.status' => $status, 'siswa.kelas' => $kelas], keyword: ['nama_siswa' => $keyword], array: 1, groupBy: 'nama_siswa');
			$dataSiswaTotal = $this->model->getDataModel(table: 'siswa', data: ['count(nipd) as total'], param: ['status' => $status, 'kelas' => $kelas], keyword: ['nama_siswa' => $keyword]);
		} elseif(!(empty($keyword))) {
			$dataSiswa = $this->model->getDataJoinModel(table: ['siswa', 'tahun_akademik'], data: ['nipd', 'nama_siswa', 'kelas', 'potongan' ,'siswa.thn_akademik as thn_akademik', 'siswa.status as status'],
			column: ['thn_akademik'], params: ['siswa.status' => $status], keyword: ['nama_siswa' => $keyword], array: 1, groupBy: 'nama_siswa');
			$dataSiswaTotal = $this->model->getDataModel(table: 'siswa', data: ['count(nipd) as total'], param: ['status' => $status], keyword: ['nama_siswa' => $keyword]);
		} elseif(!(empty($kelas))) {
			$dataSiswa = $this->model->getDataJoinModel(table: ['siswa', 'tahun_akademik'], data: ['nipd', 'nama_siswa', 'kelas', 'potongan' ,'siswa.thn_akademik as thn_akademik', 'siswa.status as status'],
			column: ['thn_akademik'], params: ['siswa.status' => $status, 'kelas' => $kelas], array: 1, groupBy: 'nama_siswa');
			$dataSiswaTotal = $this->model->getDataModel(table: 'siswa', data: ['count(nipd) as total'], param: ['status' => $status, 'kelas' => $kelas]);
		} else {
			$dataSiswa = $this->model->getDataJoinModel(table: ['siswa', 'tahun_akademik'], data: ['nipd', 'nama_siswa', 'kelas', 'potongan' ,'siswa.thn_akademik as thn_akademik', 'siswa.status'],
			column: ['thn_akademik'], params: ['siswa.status' => $status], array: 1, groupBy: 'nama_siswa');
			$dataSiswaTotal = $this->model->getDataModel(table: 'siswa', data: ['count(nipd) as total'], param: ['status' => $status]);
		}
		if(empty($dataSiswaTotal)){
			$dataSiswaTotal = 0;
		} else {
			$dataSiswaTotal = $dataSiswaTotal[0]['total'];
		}
		$data['dataSiswa'] = $dataSiswa;
		$data['dataSiswaTotal'] = $dataSiswaTotal;
		header('Content-Type: application/json');
        echo json_encode($data);
	}

	public function datanonaktifSiswa()
	{
		$dataKelas = $this->model->getDataModel(table: 'kelas', data: ['kelas']);
		try {
			$this->render('datanonaktifsiswa', ['title' => 'Data Nonaktif Siswa', 'name' => $this->_userdata['nama_petugas'], 
			'data' => array('dataKelas' => $dataKelas)]);
		} catch (Exception $e) {
			$e->getMessage();
		}
	}

	public function dataKelas()
	{
		$dataInstansi = $this->model->getDataModel('instansi', ['jenis_instansi'],['status' => 1]);
		try {
			$this->render('datakelas', ['title' => 'Data Kelas', 'name' => $this->_userdata['nama_petugas'], 
			'data' => array('dataInstansi' => $dataInstansi)]);		
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataKelasData()
	{
		$instansi = $this->input->get('instansi');
		$keyword = $this->input->get('keyword');
		$status = $this->input->get('status');
		$data = [];
		if(!(empty($instansi)) && !(empty($keyword))) {
			$dataKelas = $this->model->getDataModel(table: 'kelas', data: ['kelas', 'instansi'], param: ['instansi' => $instansi, 'status' => $status], keyword: ['kelas' => $keyword], groupBy: 'kelas');
			$dataKelasTotal = $this->model->getDataModel(table: 'kelas', data: ['count(kelas) as total'], param: ['instansi' => $instansi, 'status' => $status], keyword: ['kelas' => $keyword]);
		} elseif(!(empty($keyword))) {
			$dataKelas = $this->model->getDataModel(table: 'kelas', data: ['kelas', 'instansi'], param: ['status' => $status], keyword: ['kelas' => $keyword], groupBy: 'kelas');
			$dataKelasTotal = $this->model->getDataModel(table: 'kelas', data: ['count(kelas) as total'], param: ['status' => $status], keyword: ['kelas' => $keyword]);
		} elseif(!(empty($instansi))) {
			$dataKelas = $this->model->getDataModel(table: 'kelas', data: ['kelas', 'instansi'], param: ['instansi' => $instansi, 'status' => $status], groupBy: 'kelas');
			$dataKelasTotal = $this->model->getDataModel(table: 'kelas', data: ['count(kelas) as total'], param: ['instansi' => $instansi, 'status' => $status]);
		} else {
			$dataKelas = $this->model->getDataModel(table: 'kelas', data: ['kelas', 'instansi'], param: ['status' => $status], groupBy: 'kelas');
			$dataKelasTotal = $this->model->getDataModel(table: 'kelas', data: ['count(kelas) as total'], param: ['status' => $status]);
		}
		if(empty($dataKelasTotal)){
			$dataKelasTotal = 0;
		} else {
			$dataKelasTotal = $dataKelasTotal[0]['total'];
		}
		$data['dataKelas'] = $dataKelas;
		$data['dataKelasTotal'] = $dataKelasTotal;
		header('Content-Type: application/json');
        echo json_encode($data);
	}

	public function datanonaktifKelas(){
		$dataInstansi = $this->model->getDataModel('instansi', ['jenis_instansi'],['status' => 1]);
		try {
			$this->render('datanonaktifkelas', ['title' => 'Data Non Aktif Kelas', 'name' => $this->_userdata['nama_petugas'], 
			'data' => array('dataInstansi' => $dataInstansi)]);		
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataBiaya()
	{
		$dataInstansi = $this->model->getDataModel('instansi', ['jenis_instansi'], ['status' => 1]);
		try {
			$this->render('databiaya', ['title' => 'Data Biaya', 'name' => $this->_userdata['nama_petugas'], 'data' => array('dataInstansi' => $dataInstansi)]);
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataBiayaData()
	{
		$instansi = $this->input->get('instansi');
		$keyword = $this->input->get('keyword');
		$status = $this->input->get('status');
		$data = [];
		if(!(empty($instansi)) && !(empty($keyword))) {
			$dataBiaya = $this->model->getDataModel(table: 'jenis_pembayaran', data: ['id_jenis_pembayaran', 'jenis_pembayaran', 'biaya' ,'instansi'], param: ['instansi' => $instansi, 'status' => $status], keyword: ['jenis_pembayaran' => $keyword], groupBy: 'instansi');
			$dataBiayaTotal = $this->model->getDataModel(table: 'jenis_pembayaran', data: ['count(jenis_pembayaran) as total'], param: ['instansi' => $instansi, 'status' => $status], keyword: ['jenis_pembayaran' => $keyword]);
		} elseif(!(empty($keyword))) {
			$dataBiaya = $this->model->getDataModel(table: 'jenis_pembayaran', data: ['id_jenis_pembayaran','jenis_pembayaran', 'biaya' , 'instansi'], param: ['status' => $status], keyword: ['jenis_pembayaran' => $keyword], groupBy: 'instansi');
			$dataBiayaTotal = $this->model->getDataModel(table: 'jenis_pembayaran', data: ['count(jenis_pembayaran) as total'], param: ['status' => $status], keyword: ['jenis_pembayaran' => $keyword]);
		} elseif(!(empty($instansi))) {
			$dataBiaya = $this->model->getDataModel(table: 'jenis_pembayaran', data: ['id_jenis_pembayaran', 'jenis_pembayaran', 'biaya', 'instansi'], param: ['instansi' => $instansi, 'status' => $status], groupBy: 'instansi');
			$dataBiayaTotal = $this->model->getDataModel(table: 'jenis_pembayaran', data: ['count(jenis_pembayaran) as total'], param: ['instansi' => $instansi, 'status' => $status]);
		} else {
			$dataBiaya = $this->model->getDataModel(table: 'jenis_pembayaran', data: ['id_jenis_pembayaran', 'jenis_pembayaran', 'biaya', 'instansi'], param: ['status' => $status], groupBy: 'instansi');
			$dataBiayaTotal = $this->model->getDataModel(table: 'jenis_pembayaran', data: ['count(jenis_pembayaran) as total'], param: ['status' => $status]);
		}
		if(empty($dataBiayaTotal)){
			$dataBiayaTotal = 0;
		} else {
			$dataBiayaTotal = $dataBiayaTotal[0]['total'];
		}
		$data['dataBiaya'] = $dataBiaya;
		$data['dataBiayaTotal'] = $dataBiayaTotal;
		header('Content-Type: application/json');
        echo json_encode($data);
	}
	
	public function datanonaktifBiaya()
	{
		$dataInstansi = $this->model->getDataModel('instansi', ['jenis_instansi'], ['status' => 1]);
		try {
			$this->render('datanonaktifbiaya', ['title' => 'Data Non Aktif Biaya', 'name' => $this->_userdata['nama_petugas'], 'data' => array('dataInstansi' => $dataInstansi)]);
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataInstansi()
	{
		try {
			$this->render('datainstansi', ['title' => 'Data Instansi', 'name' => $this->_userdata['nama_petugas']]);
			
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataInstansiData(){
		$keyword = $this->input->get('keyword');
		$status = $this->input->get('status');
		$data = [];
		if(!(empty($keyword))) {
			$dataInstansi = $this->model->getDataModel(table: 'instansi', data: ['*'], param: ['status' => $status], keyword: ['jenis_instansi' => $keyword], groupBy: 'jenis_instansi');
			$dataInstansiTotal = $this->model->getDataModel(table: 'instansi', data: ['count(jenis_instansi) as total'], param: ['status' => $status], keyword: ['jenis_instansi' => $keyword]);
		} else {
			$dataInstansi = $this->model->getDataModel(table: 'instansi', data: ['*'], param: ['status' => $status], groupBy: 'jenis_instansi');
			$dataInstansiTotal = $this->model->getDataModel(table: 'instansi', data: ['count(jenis_instansi) as total'], param: ['status' => $status]);
		}
		if(empty($dataInstansiTotal)){
			$dataInstansiTotal = 0;
		} else {
			$dataInstansiTotal = $dataInstansiTotal[0]['total'];
		}
		$data['dataInstansi'] = $dataInstansi;
		$data['dataInstansiTotal'] = $dataInstansiTotal;
		header('Content-Type: application/json');
        echo json_encode($data);
	}

	public function datanonaktifInstansi()
	{
		try {
			$this->render('datanonaktifinstansi', ['title' => 'Data Non Aktif Instansi', 'name' => $this->_userdata['nama_petugas']]);
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function halamanAdmin()
	{
		$dataAdmin = $this->model->getDataModel('admin', ['kode_petugas', 'nama_petugas'], ['kode_petugas' => $this->session->userdata('kode_petugas')], array: 0);
		try {
			$this->render('halamanadmin', ['title' => 'Halaman Admin', 'name' => $this->_userdata['nama_petugas'], 'kode' => $dataAdmin['kode_petugas']]);

		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataAdmin()
	{
		try {
			$this->render('dataadmin', ['title' => 'Data Admin', 'name' => $this->_userdata['nama_petugas']]);
		} catch (Exception $e){
			$e->getMessage();
		}
	}

	public function dataAdminData()
	{
		$keyword = $this->input->get('keyword');
		$status = $this->input->get('status');
		$data = [];
		if(!(empty($keyword))) {
			$dataAdmin = $this->model->getDataModel(table: 'admin', data: ['kode_petugas, nama_petugas'], param: ['status' => $status], keyword: ['nama_petugas' => $keyword], groupBy: 'nama_petugas');
			$dataAdminTotal = $this->model->getDataModel(table: 'admin', data: ['count(nama_petugas) as total'], param: ['status' => $status], keyword: ['nama_petugas' => $keyword]);
		} else {
			$dataAdmin = $this->model->getDataModel(table: 'admin', data: ['kode_petugas, nama_petugas'], param: ['status' => $status], groupBy: 'nama_petugas');
			$dataAdminTotal = $this->model->getDataModel(table: 'admin', data: ['count(nama_petugas) as total'], param: ['status' => $status]);
		}
		if(empty($dataAdminTotal)){
			$dataAdminTotal = 0;
		} else {
			$dataAdminTotal = $dataAdminTotal[0]['total'];
		}
		$data['dataAdmin'] = $dataAdmin;
		$data['dataAdminTotal'] = $dataAdminTotal;
		header('Content-Type: application/json');
        echo json_encode($data);
	}

	public function datanonaktifAdmin()
	{
		try {
			$this->render('datanonaktifadmin', ['title' => 'Data Non Aktif Admin', 'name' => $this->_userdata['nama_petugas']]);
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

	public function dataTransaksiData()
	{
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
					$total += $biaya['biaya'];
				}
				$response['biaya'] = $total;
			}
			$response['dataBiaya'] = $dataBiaya;
			
			$response['nominalMasuk'] = $dataSumNominalMasuk[0]['sum(nominal)'];

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

		if(!(empty($kelas)) && !(empty($status)) && !(empty($keyword))) {
			if($status == 'aktif') {
				$status = 1;
			} else {
				$status = 0;
			}
			$dataSiswa = $this->model->getDataModel(table: 'siswa', data: ['nipd, nama_siswa, kelas, status, potongan'], param: ['status' => $status, 'kelas' => $kelas], 
			keyword: ['nama_siswa' => $keyword], groupBy: 'nama_petugas');
		} elseif(!(empty($kelas)) && !(empty($status))){
			if($status == 'aktif') {
				$status = 1;
			} else {
				$status = 0;
			}
			$dataSiswa = $this->model->getDataModel(table: 'siswa', data: ['nipd, nama_siswa, kelas, status, potongan'], param: ['status' => $status, 'kelas' => $kelas], groupBy: 'nama_siswa');
		} elseif(!(empty($keyword))) {
			$dataSiswa = $this->model->getDataModel(table: 'siswa', data: ['nipd, nama_siswa, kelas, status, potongan'], keyword: ['nama_siswa' => $keyword], groupBy: 'nama_siswa');
		} elseif(!(empty($kelas))) {
			$dataSiswa = $this->model->getDataModel(table: 'siswa', data: ['nipd, nama_siswa, kelas, status, potongan'], param: ['kelas' => $kelas], groupBy: 'nama_siswa');
		} elseif(!(empty($status))){
			if($status == 'aktif') {
				$status = 1;
			} else {
				$status = 0;
			}
			$dataSiswa = $this->model->getDataModel(table: 'siswa', data: ['nipd, nama_siswa, kelas, status, potongan'], param: ['status' => $status], groupBy: 'nama_siswa');
		} else {
			$dataSiswa = $this->model->getDataModel(table: 'siswa', data: ['nipd, nama_siswa, kelas, status, potongan'], groupBy: 'nama_siswa');
		}
		for ($i=0; $i < count($dataSiswa); $i++) { 
			# code...
			$dataTransaksi = $this->model->getDataModel(table: 'transactions', data: ['sum(nominal) as nominal_masuk'], param: ['nipd' => $dataSiswa[$i]['nipd'], "bulan" => date('Y-m-01')]);
			$dataSiswa[$i]['nominal_masuk'] = $dataTransaksi[0]['nominal_masuk'];
			$dataInstansi = $this->model->getDataModel(table: 'kelas', data: ['instansi'], param: ['kelas' => $dataSiswa[$i]['kelas']], array: 0);
			$dataBiaya = $this->model->getDataModel(table: 'jenis_pembayaran', data: ['sum(biaya) as biaya'], param: ['instansi' => $dataInstansi['instansi']], array: 0);
			if(($dataSiswa[$i]['nominal_masuk'] == ($dataBiaya['biaya'] - $dataSiswa[$i]['potongan'])) && !is_null($dataBiaya['biaya']) && $dataSiswa[$i]['status'] == 2){
				$dataSiswa[$i]['status'] = 'Lunas'; 
			} else {
				$dataSiswa[$i]['status'] = 'Belum Lunas'; 
				
			}
		}
		echo json_encode($dataSiswa);
		exit();
	}

	public function dataTahunAkademik() 
	{
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

	public function dataTahunAkademikData()
	{
		$keyword = $this->input->get('keyword');
		$data = [];
		if(!(empty($keyword))) {
			$dataTahunAkademik = $this->model->getDataModel(table: 'tahun_akademik', data: ['*'], keyword: ['thn_akademik' => $keyword]);
		} else {
			$dataTahunAkademik = $this->model->getDataModel(table: 'tahun_akademik', data: ['*']);
		}
		$data['dataTahunAkademik'] = $dataTahunAkademik;
		header('Content-Type: application/json');
        echo json_encode($data);
	}
}
