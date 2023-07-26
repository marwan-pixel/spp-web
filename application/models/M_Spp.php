<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Spp extends CI_Model
{

public function getPreviousAcademicYear($thn_akademik)
{
    
    $previousYear = $this->getPreviousYear($thn_akademik, 1);

   
    $previousYearCount = $this->db
        ->where('thn_akademik', $previousYear)
        ->count_all_results('transactions');

    
    if ($previousYearCount > 0) {
        $previousTransactions = $this->M_Spp->check($nipd, $previousYear, $instansi);
        return $previousTransactions ? $previousYear : $thn_akademik;
    }

  
    return $thn_akademik;
}


private function getPreviousYear($thn_akademik, $lompatan)
{
    $startYear = intval(substr($thn_akademik, 0, 4));
    $previousStartYear = $startYear - $lompatan;
    $previousEndYear = $previousStartYear + 1;

    return $previousStartYear . '/' . $previousEndYear;
}

public function check($nipd, $thn_akademik, $instansi) {

    $this->db->select_sum('nominal');
    $this->db->where('nipd', $nipd);
    $this->db->where('thn_akademik', $thn_akademik);
    $this->db->where('status', 2);
    $query = $this->db->get('transactions');
    $result = $query->row();
    $totalNominal = $result->nominal;

  
	$this->db->select('s.potongan * 12 as potongan', FALSE);
	$this->db->from('siswa as s');
	$this->db->join('kelas as k', 's.kelas = k.kelas', 'left');
	$this->db->join('jenis_pembayaran as j', 'k.instansi = j.instansi', 'left');
	$this->db->where('s.nipd', $nipd);
	$this->db->where('k.instansi', $instansi);
	$query_potongan = $this->db->get();
	$result_potongan = $query_potongan->row();
	$totalPotongan = $result_potongan ? $result_potongan->potongan : 0;
	

   
    $query = $this->db
        ->select('SUM(biaya) * 12 AS total_biaya', FALSE)
        ->where('instansi', $instansi)
        ->get('jenis_pembayaran');
    $result_biaya = $query->row();
    $totalBiaya = $result_biaya->total_biaya - $totalPotongan;

  

    
    return $totalNominal >= $totalBiaya;
}

public function totalBiaya($nipd, $instansi) {

	 $this->db->select('s.potongan * 12 as potongan', FALSE);
	 $this->db->from('siswa as s');
	 $this->db->join('kelas as k', 's.kelas = k.kelas', 'left');
	 $this->db->join('jenis_pembayaran as j', 'k.instansi = j.instansi', 'left');
	 $this->db->where('s.nipd', $nipd);
	 $this->db->where('k.instansi', $instansi);
	 $query_potongan = $this->db->get();
	 $result_potongan = $query_potongan->row();
	 $totalPotongan = $result_potongan ? $result_potongan->potongan : 0;
	 
 
	
	 $query = $this->db
		 ->select('SUM(biaya) * 12 AS total_biaya', FALSE)
		 ->where('instansi', $instansi)
		 ->get('jenis_pembayaran');
	 $result_biaya = $query->row();
	 $totalBiaya = $result_biaya->total_biaya - $totalPotongan;

	return $totalBiaya;
}



public function checkTahunAkademikAvailability($thn_akademik)
{
    $this->db->where('thn_akademik', $thn_akademik);
    $query = $this->db->get('tahun_akademik');
    return $query->num_rows() > 0;
}



public function getTransactionsInRange($nipd, $instansi, $startDate, $endDate)
    {
        $this->db->select('*');
        $this->db->where('nipd', $nipd);
        $this->db->where('instansi', $instansi);
        $this->db->where('status', 2);
        $this->db->where('bulan >=', $startDate);
        $this->db->where('bulan <=', $endDate);
        $query = $this->db->get('transactions');
        return $query->result();
    }



public function login($nipd, $password)
{
    $this->db->select('siswa.*, kelas.instansi');
    $this->db->from('siswa');
    $this->db->join('kelas', 'siswa.kelas = kelas.kelas');
    $this->db->where('siswa.nipd', $nipd);
    $query = $this->db->get();
    $user = $query->row();

    if ($user && password_verify($password, $user->password)) {
        unset($user->password);
        
        return $user;
    }

    return ['error' => 'Invalid nipd or password'];
}


public function getActiveTahunAkademik()
{
    $this->db->where('status', '1');
    $query = $this->db->get('tahun_akademik');

    if ($query->num_rows() > 0) {
        return $query->row()->thn_akademik;
    } else {
        throw new Exception('No active academic year found');
    }
}

public function SiswaAktif($nipd)
{
    $query = $this->db->get_where('siswa', ['nipd' => $nipd]);
    $result = $query->row();

    return $result && $result->status === '1';
}


}
