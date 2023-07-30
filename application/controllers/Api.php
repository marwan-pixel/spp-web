<?php
header("Content-Type: application/json; charset=utf-8");
defined('BASEPATH') or exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: origin, x-requested-with, content-type");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
require_once 'vendor/autoload.php';

class Api extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    error_reporting(0);
		$this->load->helper('url');
    $this->load->model('M_Spp');
    $this->load->library('password');

  }
  

public function upload()
{
    $token = $this->input->get_request_header('Authorization');

    if ($token !== 'Bearer KE9NDFUZ7KO2XNG43QQXVMIFKOL4L7H9') {
        return $this->output
            ->set_status_header(401)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'Invalid token']));
    }

    $this->load->library('form_validation');
    
    $this->form_validation->set_rules('nipd', 'nipd', 'required');
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
    $this->form_validation->set_rules('instansi', 'Instansi', 'required');
    $this->form_validation->set_rules('nominal', 'nominal', 'required');
    $this->form_validation->set_rules('thn_akademik', 'Tahun Akademik', 'required');
    $this->form_validation->set_rules('start_range_date', 'Start Range Date', 'required');
    $this->form_validation->set_rules('end_range_date', 'End Range Date', 'required');

    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'jpg|png';
    $config['max_size'] = 5120; 
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('image')) {
        $error = array('error' => $this->upload->display_errors());
        echo json_encode($error);
        return;
    }

    if ($this->form_validation->run() == FALSE) {
        $error = array('error' => validation_errors());
        echo json_encode($error);
        return;
    }

    $nipd = $this->input->post('nipd', true);
    $thn_akademik = $this->input->post('thn_akademik', true);
    $instansi = $this->input->post('instansi', true);
    $nominal = $this->input->post('nominal', true);
    
    $statusSiswaAktif = $this->M_Spp->SiswaAktif($nipd);
    
    if (!$statusSiswaAktif) {
        return $this->output
            ->set_status_header(401)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'Status Siswa anda sudah tidak aktif, Silahkan hubungi bagian tata usaha untuk informasi lebih lanjut']));
    }

    $tahunAkademikAvailable = $this->M_Spp->checkTahunAkademikAvailability($thn_akademik);
    if (!$tahunAkademikAvailable) {
        return $this->output
            ->set_status_header(401)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'Tahun Akademik Tidak Tersedia']));
    }

    $transactions = $this->M_Spp->check($nipd, $thn_akademik, $instansi);
  
	

    $previousAcademicYear = $this->M_Spp->getPreviousAcademicYear($thn_akademik, $nipd, $instansi);

    $previousTransactions = false;
    if ($previousAcademicYear !== $thn_akademik) {
        $previousTransactions = $this->M_Spp->check($nipd, $previousAcademicYear, $instansi);
    }

    if ($transactions) {
        return $this->output
            ->set_status_header(401)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'Akses upload anda telah dikunci, karena telah melunasi biaya sekolah tahun ajaran saat ini']));
	} elseif ($previousAcademicYear !== $thn_akademik && !$previousTransactions) {
        return $this->output
            ->set_status_header(401)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'Akses upload anda telah dikunci, karena belum melunasi biaya sekolah tahun ajaran sebelumnya']));
    }

  
    $startRangeDate = $this->input->post('start_range_date');
    $endRangeDate = $this->input->post('end_range_date');

    if (empty($startRangeDate) || empty($endRangeDate)) {
        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'Start and end range dates are required']));
    }

 
    $startRangeDate = new DateTime($startRangeDate);
    $endRangeDate = new DateTime($endRangeDate);

   
    if ($endRangeDate < $startRangeDate) {
        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'End date cannot be before the start date']));
    }

  
    $interval = $startRangeDate->diff($endRangeDate);
    $numMonths = $interval->format('%m') + 1;


    $existingTransactions = $this->M_Spp->getTransactionsInRange($nipd, $instansi, $startRangeDate->format('Y-m-d'), $endRangeDate->format('Y-m-d'));

    if (count($existingTransactions) > 0) {
        return $this->output
            ->set_status_header(401)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'Transaksi Sudah Lunas Bulan Yang Kamu Tuju']));
    }

  
    $nominalPerMonth = $nominal / $numMonths;


    $currentDate = $startRangeDate;
    for ($i = 0; $i < $numMonths; $i++) {
     
        if ($currentDate > $endRangeDate) {
            break;
        }

        $data = array(
            'nipd' => $nipd,
            'keterangan' => $this->input->post('keterangan', true),
            'status' => 1,
            'instansi' => $instansi,
            'nominal' => $nominalPerMonth,
            'image' => $this->upload->data('file_name'),
            'thn_akademik' => $thn_akademik,
            'bulan' => $currentDate->format('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );

        $this->db->insert('transactions', $data);

        $currentDate->add(new DateInterval('P1M'));
    }
	echo json_encode($data);
}
}
 
