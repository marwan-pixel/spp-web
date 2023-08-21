<?php
header("Content-Type: application/json; charset=utf-8");
defined('BASEPATH') or exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: origin, x-requested-with, content-type");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use React\EventLoop\Factory;
use React\Promise\Deferred;


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
  
public function login()
{
    $nipd = $this->security->xss_clean($this->input->post('nipd', true));
    $password = $this->security->xss_clean($this->input->post('password', true));
    $token = $this->input->get_request_header('Authorization');

    if ($token !== 'Bearer KE9NDFUZ7KO2XNG43QQXVMIFKOL4L7H9') {
        return $this->output
            ->set_status_header(401)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'Invalid token']));
    }

   $result = $this->M_Spp->login($nipd, $password);

if ($result) {
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    } else {
        return $this->output
            ->set_status_header(404)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'Invalid NIS and Password']));
    }
}

public function getStatus() {
    $nipd = $this->input->post('nipd');
    $status = $this->input->post('status');
    $sort = $this->input->get('sort'); 

    $result = $this->M_Spp->getPending($nipd, $status, $sort, $start_date, $end_date);

    if ($result) {
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    return $this->output
        ->set_status_header(401)
        ->set_content_type('application/json')
        ->set_output(json_encode(['error' => 'Error']));
}

public function getAkademik() {
    $nipd = $this->input->post('nipd');
    $thn_akademik = $this->input->post('thn_akademik');
    $sort = $this->input->get('sort'); 

    $result = $this->M_Spp->getakademik($nipd, $thn_akademik, $sort, $start_date, $end_date);

    if ($result) {
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    }

    return $this->output
        ->set_status_header(401)
        ->set_content_type('application/json')
        ->set_output(json_encode(['error' => 'Error']));
}

public function getdatasiswa() {
    $nipd = $this->input->post('nipd');
    $result = $this->M_Spp->getDataSiswa($nipd);

    if ($result) {
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($result));
    } else {
        return $this->output
            ->set_status_header(404)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'Data siswa tidak ditemukan.']));
    }
}

public function countStatus()
{
    $token = $this->input->get_request_header('Authorization');

    if ($token !== 'Bearer KE9NDFUZ7KO2XNG43QQXVMIFKOL4L7H9') {
        return $this->output
            ->set_status_header(401)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'Invalid token']));
    }

    $nipd = $this->input->get('nipd', true);
    $instansi = $this->input->get('instansi', true);
    $thn_akademik = $this->input->get('thn_akademik', true);
    $diterimaData = $this->M_Spp->countStatusDiterima($nipd,$thn_akademik);
    $ditolakData = $this->M_Spp->countStatusDitolak($nipd,$thn_akademik);
    $pendingData = $this->M_Spp->countStatusPending($nipd,$thn_akademik);

   
    $totalNominal = $diterimaData['nominal'];
    $totalBiaya = $this->M_Spp->totalBiaya($nipd, $instansi);
  
    $presentase = ($totalNominal / $totalBiaya) * 100;

    $result = array(
        'DITERIMA' => $diterimaData,
        'PENDING' => $pendingData,
        'DITOLAK' => $ditolakData,
        'analytics' => array(
            'total_nominal' => $totalNominal,
            'total_biaya' => $totalBiaya,
            'presentase' =>  number_format($presentase, 2) . '%'
        )
    );

    echo json_encode($result);
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
    $this->form_validation->set_rules([
        ['field' => 'nipd', 'label' => 'NIPD', 'rules' => 'required'],
        ['field' => 'keterangan', 'label' => 'Keterangan', 'rules' => 'required'],
        ['field' => 'instansi', 'label' => 'Instansi', 'rules' => 'required'],
        ['field' => 'nominal', 'label' => 'Nominal', 'rules' => 'required'],
        ['field' => 'thn_akademik', 'label' => 'Tahun Akademik', 'rules' => 'required'],
        ['field' => 'start_range_date', 'label' => 'Start Range Date', 'rules' => 'required'],
        ['field' => 'end_range_date', 'label' => 'End Range Date', 'rules' => 'required']
    ]);

    $config['upload_path'] = './uploads/';
    $config['allowed_types'] = 'jpg|png';
    $config['max_size'] = 5120;
    $config['encrypt_name'] = TRUE;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('image')) {
        $error = $this->upload->display_errors();
        return $this->output
            ->set_status_header(401)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => $error]));
    }

    if ($this->form_validation->run() == FALSE) {
        $error = validation_errors();
        return $this->output
            ->set_status_header(401)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => $error]));
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

    
        $startRangeDate = DateTime::createFromFormat('Y-m-d', $this->input->post('start_range_date'));
        $endRangeDate = DateTime::createFromFormat('Y-m-d', $this->input->post('end_range_date'));

        
        if (!$startRangeDate || !$endRangeDate) {
        return $this->output
            ->set_status_header(400)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'Format tanggal tidak valid. Gunakan format Y-m-d, contoh: 2023-08-13']));
}

        if ($endRangeDate < $startRangeDate) {
            return $this->output
                ->set_status_header(400)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => 'Tanggal akhir tidak boleh sebelum tanggal mulai']));
        }
        
        
    

    $startRangeDate = new DateTime($this->input->post('start_range_date'));
    $endRangeDate = new DateTime($this->input->post('end_range_date'));
    $interval = $startRangeDate->diff($endRangeDate);
    $numYears = $interval->format('%y');
    $numMonths = $interval->format('%m');
    

    $totalMonths = ($numYears * 12) + $numMonths;
    if ($totalMonths === 0) {
        $totalMonths = 1;
    }
    
    
    
   
    $errorMessage = '';
    $nominal = $this->input->post('nominal', true);
    $totalBiayaPertahun = $this->M_Spp->totalBiaya($nipd, $instansi);
    $totalBiayaPerbulan = $this->M_Spp->totalBiayaMonth($nipd, $instansi);

    
    

    $startYear = (int)$startRangeDate->format('Y');
    $endYear = (int)$endRangeDate->format('Y');
    $numYearsInRange = $endYear - $startYear + 1;
    $totalMonthsInRange = ($numYearsInRange * 12); 
    $totalBiayaInRange = $totalBiayaPertahun * $numYearsInRange;
    


    $interval = $startRangeDate->diff($endRangeDate);
    $totalMonths = ($interval->format('%y') * 12) + $interval->format('%m') + 1;
    

    $nominalPerMonth = $nominal / $totalMonths;
    
    $remainingAmount = $nominal;
    $currentDate = $startRangeDate;
    
    $allFullyPaid = true;  
    
    
    $isStartFullyPaid = $this->M_Spp->checkFullInstallmentPayment($nipd, $instansi, $startRangeDate, $startRangeDate);
    if ($isStartFullyPaid) {
    $errorMessage = 'Kamu Telah Melunasi Biaya SPP Pada Bulan ' . $startRangeDate->format('F') . '';
    return $this->output
        ->set_status_header(401)
        ->set_content_type('application/json')
        ->set_output(json_encode(['error' => $errorMessage]));
}


    
    $remainingAmount = $nominal;
    $currentDate = $startRangeDate;
    $allFullyPaid = true;
    
  


    for ($i = 0; $i < $totalMonths; $i++) {
      
        if ($currentDate > $endRangeDate) {
            break;
        }
    
   

  
    $lastDateOfMonth = $currentDate->format('Y-m-t');


    if ($currentDate->format('Y-m') == $endRangeDate->format('Y-m')) {
        $nominalForMonth = $remainingAmount;
    } else {

        $nominalForMonth = $nominalPerMonth;
    }


    // $isFullyPaid = $this->M_Spp->checkFullInstallmentPayment($nipd, $instansi, $currentDate, $endRangeDate);

    // if (!$isFullyPaid) {
    //     $allFullyPaid = false;
    // }


    if ($nominalForMonth > $remainingAmount) {
        $nominalForMonth = $remainingAmount;
    }
    
     if ($nominalForMonth > $totalBiayaPerbulan) {
            $errorMessage = 'Nominal tidak boleh lebih besar dari biaya perbulan yang sudah ditentukan';

            return $this->output
                ->set_status_header(401)
                ->set_content_type('application/json')
                ->set_output(json_encode(['error' => $errorMessage]));
        }
        
       
// if ($allFullyPaid) {
 
//     $message = 'Tanggal yang kamu tuju saat ini sudah lunas';
//     // Return the success response
//     return $this->output
//         ->set_status_header(401)
//         ->set_content_type('application/json')
//         ->set_output(json_encode(['error' => $message]));
// }

   
    $data = array(
        'nipd' => $nipd,
        'keterangan' => $this->input->post('keterangan', true),
        'status' => 1,
        'instansi' => $instansi,
        'nominal' => (int)$nominalForMonth,
        'image' => $this->upload->data('file_name'),
        'thn_akademik' => $thn_akademik,
        'bulan' => $currentDate->format('Y-m-d'),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    );

  
    $this->db->insert('transactions', $data);

   
    $remainingAmount -= $nominalForMonth;

   
    $currentDate = new DateTime($lastDateOfMonth);
    $currentDate->add(new DateInterval('P1D')); 
}

    $subject = 'Notifikasi Data Transaksi Terbaru';
	date_default_timezone_set('Asia/Jakarta');
    $message = '<p>Orang Tua Siswa Telah Melakukan Upload Bukti Pembayaran </p>' .
        '<p>nipd : ' . $nipd . '</p>' .
        '<p>Instansi : ' . $instansi . '</p>' .
        '<p>Tanggal Upload : ' . date('Y-m-d H:i:s') . '</p>' .
        '<p>Silahkan Untuk Melakukan Pengecekan Data Siswa Pada Website <a href="https://arrahman.site/spp-web/">https://arrahman.site/spp-web/</a> Untuk Melihat Detail Transaksi</p>' .
        '<p>Jl. Cagak Palasari No.22, RT.04/RW.2, Palasari, Kec. Cijeruk, Kabupaten Bogor, Jawa Barat 16136</p>';

    
    $loop = React\EventLoop\Factory::create();
    $deferred = new React\Promise\Deferred();

    $mail = new PHPMailer(true);

    
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'yayasanarrahmahboardingschool@gmail.com';
    $mail->Password = 'eoegwuoygpasizsq';
    $mail->SMTPSecure = 'ssl'; 
    $mail->Port = 465;

    
    $mail->setFrom('yracijerukbogor@gmail.com', 'Notification Upload');
    $mail->addAddress('yracijerukbogor@gmail.com', 'Harya');

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

  
    $loop->futureTick(function () use ($mail, $deferred) {
        try {
           
            $mail->send();

          
            $deferred->resolve();
        } catch (Exception $e) {
            
            $deferred->reject($e);
        }
    });

    
	$deferred->promise()->then(function () use ($data, $thn_akademik) {
		try {
		
			$this->db->insert('transactions', $data, function ($error) use ($data) {
				if ($error !== null) {
					echo json_encode(['error' => 'Error in inserting data to the database: ' . $error->getMessage()]);
				} else {
					echo json_encode($data);
				}
			});
		} catch (Exception $e) {
			echo json_encode(['error' => 'Error in inserting data to the database: ' . $e->getMessage()]);
		}
	}, function (Exception $e) {
		echo json_encode(['error' => 'Pesan tidak dapat dikirim: ' . $e->getMessage()]);
	});
	

	$deferred->promise()->then(function () use ($loop) {
		$loop->stop();
	});
	echo json_encode($data);
}


public function nominalFilter()
{
    $bulan = $this->input->get('bulan'); 
    $nipd = $this->input->get('nipd'); 

    if (!empty($bulan) && !empty($nipd)) {
        $result = $this->M_Spp->nominalByMonth($nipd, $bulan); 
        if (!empty($result)) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
        } else {
            $this->output
                ->set_status_header(404)
                ->set_output(json_encode(['error' => 'Data Not Found.']));
        }
    } else {
        $this->output
            ->set_status_header(400)
            ->set_output(json_encode(['error' => 'Missing "bulan" or "nipd" parameter.']));
    }
}

// public function avg()
// {
//     $thn_akademik = $this->input->get('thn_akademik'); 
//     $tahunAkademikAvailable = $this->M_Spp->checkTahunAkademikAvailability($thn_akademik);

//     if (!$tahunAkademikAvailable) {
//         return $this->output
//             ->set_status_header(401)
//             ->set_content_type('application/json')
//             ->set_output(json_encode(['error' => 'Tahun Akademik Tidak Tersedia']));
//     }

//     $nipd = $this->input->get('nipd'); 
//     if (!empty($nipd)) {
//         $result = $this->M_Spp->avgNominal($nipd, $thn_akademik);
//         if (!empty($result['data'])) {
//             $this->output
//                 ->set_content_type('application/json')
//                 ->set_output(json_encode($result));
//         } else {
//             $this->output
//                 ->set_status_header(404)
//                 ->set_output(json_encode(['error' => 'Data Not Found.']));
//         }
//     } else {
//         $this->output
//             ->set_status_header(400)
//             ->set_output(json_encode(['error' => 'Missing "nipd" parameter.']));
//     }
// }



public function nominal()
{
	
	
	$nipd = $this->input->get('nipd'); 
	$result = $this->M_Spp->nominalByMonth($nipd);
	if (!empty($nipd)) {
       
        if (!empty($result['data'])) {
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($result));
        } else {
            $this->output
                ->set_status_header(404)
                ->set_output(json_encode(['error' => 'Data Not Found.']));
        }
    } else {
        $this->output
            ->set_status_header(400)
            ->set_output(json_encode(['error' => 'Missing "nipd" parameter.']));
    }
}

public function getPrice()
{
    try {
		$nipd = $this->input->get('nipd');
		$instansi = $this->input->get('instansi');

        $this->db->select('j.jenis_pembayaran, j.biaya');
        $this->db->from('siswa as s');
        $this->db->join('kelas as k', 's.kelas = k.kelas', 'left');
        $this->db->join('jenis_pembayaran as j', 'k.instansi = j.instansi', 'left');
        $this->db->where('s.nipd', $nipd);
        $this->db->where('k.instansi', $instansi);
        $this->db->group_by('j.jenis_pembayaran, j.biaya');
        $query = $this->db->get();

      
        $this->db->select('s.potongan');
        $this->db->from('siswa as s');
        $this->db->join('kelas as k', 's.kelas = k.kelas', 'left');
        $this->db->join('jenis_pembayaran as j', 'k.instansi = j.instansi', 'left');
        $this->db->where('s.nipd', $nipd);
        $this->db->where('k.instansi', $instansi);
        $query_potongan = $this->db->get();

       
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
            $totalBiaya = 0;

           
            foreach ($result as $row) {
                $totalBiaya += $row['biaya'];
            }

            
            if ($query_potongan->num_rows() > 0) {
                $result_potongan = $query_potongan->row_array();
                $potongan = $result_potongan['potongan'];

                
                $totalBiaya -= $potongan;

                $response = [
                    'message' => 'Success',
                    'data' => $result,
                    'potongan' => $potongan,
                    'total' => $totalBiaya
                ];
            } else {
                $response = [
                    'message' => 'Success',
                    'data' => $result,
                    'potongan' => null,
                    'total' => $totalBiaya
                ];
            }

            
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode($response);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Data not found"]);
        }
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(["error" => $e->getMessage()]);
    }
}


public function getPayments($nipd)
{
    try {
        $sort = $this->input->get('sort');
      
        $statusSiswa = $this->M_Spp->isSiswaAktif($nipd);

        if ( !$statusSiswa) {
            throw new Exception('Status Siswa tidak aktif');
        }

        $token = $this->input->get_request_header('Authorization');

        if ($token !== 'Bearer KE9NDFUZ7KO2XNG43QQXVMIFKOL4L7H9') {
            throw new Exception('Invalid token');
        }

        $this->output->set_content_type('application/json');

       
        $this->output->set_header('Transfer-Encoding', 'chunked');
        $this->output->set_header('X-Content-Type-Options', 'nosniff');

      
        $this->M_Spp->streamPaymentData($nipd, $sort);

        $this->output->_display(); 
        exit();
    } catch (Exception $e) {
        $this->output
            ->set_status_header(400)
            ->set_output(json_encode(["error" => $e->getMessage()]));
    }
}

public function filterdate()
{
    try {
        $nipd = $this->input->get('nipd');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');
        $sort = $this->input->get('sort');

        // $thn_akademik = $this->M_Spp->getActiveTahunAkademik(); 
        $statusSiswa = $this->M_Spp->isSiswaAktif($nipd);

        if (!$statusSiswa) {
            throw new Exception('Status Siswa tidak aktif');
        }

        $token = $this->input->get_request_header('Authorization');

        if ($token !== 'Bearer KE9NDFUZ7KO2XNG43QQXVMIFKOL4L7H9') {
            throw new Exception('Invalid token');
        }

        $payments = $this->M_Spp->getPaymentsByDateRange($nipd, $start_date, $end_date, $sort);

        $status_code = $payments ? 200 : 404;
        $this->output
            ->set_content_type('application/json')
            ->set_status_header($status_code)
            ->set_output(json_encode($payments ?: ['message' => 'Data not found.']));
    } catch (Exception $e) {
        $this->output
            ->set_status_header(400)
            ->set_output(json_encode(['error' => $e->getMessage()]));
    }
}



public function update()
{
    $user_id = $this->security->xss_clean($this->input->post('nipd', true));

    $this->db->select('password');
    $this->db->from('siswa');
    $this->db->where('nipd', $user_id);
    $user = $this->db->get()->row();

    $token = $this->input->get_request_header('Authorization');
    if ($token !== 'Bearer KE9NDFUZ7KO2XNG43QQXVMIFKOL4L7H9') {
        return $this->output
            ->set_status_header(401)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'Invalid token']));
    }

  
    if (!$user) {
        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(['message' => 'User not found']));
    }

    $new_password = $this->security->xss_clean($this->input->post('password', true));

   
    if (password_verify($new_password, $user->password)) {
        return $this->output
            ->set_status_header(401)
            ->set_content_type('application/json')
            ->set_output(json_encode(['error' => 'New password must be different from old password']));
    }

    $user_data = [
        'nama_siswa' => $this->security->xss_clean($this->input->post('nama_siswa', true)),
        'password' => password_hash($new_password, PASSWORD_BCRYPT)
    ];
    $this->db->where('nipd', $user_id)->update('siswa', $user_data);


    return $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode(['status' => true, 'message' => 'User data updated successfully']));
}

  public function logout(){
    $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'nipd' && $key != 'password') {
                $this->session->unset_userdata($key);
                if($key){
                  $status = [
                    "message" => "Success",
                  ];
                  echo json_encode($status);
                }
            }
        }
    $this->session->sess_destroy();
}
}
 