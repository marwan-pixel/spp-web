<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Spp extends CI_Model
{
    public function streamPaymentData($nipd, $sort)
    {
        $this->db->where('nipd', $nipd);

        if ($sort == '-bulan') {
            $this->db->order_by('bulan', 'DESC');
        } else {
            $this->db->order_by('bulan', 'ASC');
        }


        $query = $this->db->get('transactions');

        $this->output->set_content_type('application/json');
        $this->output->set_header('Transfer-Encoding', 'chunked');
        $this->output->set_header('X-Content-Type-Options', 'nosniff');

        echo '[';

        $firstRow = true;
        while ($row = $query->unbuffered_row('array')) {
            if (!$firstRow) {
                echo ',';
            }
            echo json_encode($row);
            ob_flush();
            flush();
            $firstRow = false;
        }

        echo ']';
    }



    public function getDataSiswa($nipd)
    {
        $this->db->select('*');
        $this->db->from('siswa');
        $this->db->where('nipd', $nipd);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();

            return $result;
        } else {
            return null;
        }
    }


    public function getPaymentsByDateRange($nipd, $start_date, $end_date, $sort)
    {
        $this->db->select('*');
        $this->db->from('transactions');
        $this->db->where('nipd', $nipd);
        $this->db->where('bulan >=', $start_date . ' 00:00:00');
        $this->db->where('bulan <=', $end_date . ' 23:59:59');
        $this->db->order_by('bulan', $sort);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }



    public function getPrice($instansi)
    {
        $this->db->select('*');
        $this->db->from('biaya');
        $this->db->where('instansi', $instansi);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function getPending($nipd, $status, $sort, $start_date, $end_date)
    {
        $this->db->select('*');
        $this->db->from('transactions');
        $this->db->where('nipd', $nipd);
        $this->db->where('status', $status);

        if ($start_date != null) {
            $this->db->where('created_at >=', $start_date);
        }

        if ($end_date != null) {
            $this->db->where('created_at <', date('Y-m-d', strtotime($end_date . ' +1 day')));
        }

        $order_by = 'ASC';
        if ($sort == '-created_at') {
            $order_by = 'DESC';
        }

        $this->db->order_by('created_at', $order_by);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function getakademik($nipd, $thn_akademik, $sort, $start_date, $end_date)
    {
        $this->db->select('*');
        $this->db->from('transactions');
        $this->db->where('nipd', $nipd);
        $this->db->where('thn_akademik', $thn_akademik);

        if ($start_date != null) {
            $this->db->where('created_at >=', $start_date);
        }

        if ($end_date != null) {
            $this->db->where('created_at <', date('Y-m-d', strtotime($end_date . ' +1 day')));
        }

        $order_by = 'ASC';
        if ($sort == '-created_at') {
            $order_by = 'DESC';
        }

        $this->db->order_by('created_at', $order_by);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPreviousAcademicYear($thn_akademik)
    {
        $previousYear = $this->getPreviousYear($thn_akademik, 1);

        $previousYearCount = $this->db
            ->where("DATE_FORMAT(bulan, '%Y') BETWEEN '$tahun_awal' AND '$tahun_akhir'", $previousYear)
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



    public function getTransactionsInRange($nipd, $instansi, $startDate, $endDate)
    {
        $this->db->select_sum('nominal');
        $this->db->where('nipd', $nipd);
        $this->db->where('instansi', $instansi);
        $this->db->where('status', 2);
        $this->db->where('bulan >=', $startDate);
        $this->db->where('bulan <=', $endDate);
        $query = $this->db->get('transactions');
        return $query->result();
    }


    public function check($nipd, $thn_akademik, $instansi)
    {

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




        return $totalNominal == $totalBiaya;
    }

    public function checkPaymentMonth($nipd, $thn_akademik, $instansi)
    {

        $this->db->select_sum('nominal');
        $this->db->where('nipd', $nipd);
        $this->db->where('thn_akademik', $thn_akademik);
        $this->db->where('status', 2);
        $query = $this->db->get('transactions');
        $result = $query->row();
        $totalNominal = $result->nominal;


        $this->db->select('s.potongan as potongan', FALSE);
        $this->db->from('siswa as s');
        $this->db->join('kelas as k', 's.kelas = k.kelas', 'left');
        $this->db->join('jenis_pembayaran as j', 'k.instansi = j.instansi', 'left');
        $this->db->where('s.nipd', $nipd);
        $this->db->where('k.instansi', $instansi);
        $query_potongan = $this->db->get();
        $result_potongan = $query_potongan->row();
        $totalPotongan = $result_potongan ? $result_potongan->potongan : 0;



        $query = $this->db
            ->select('biaya AS total_biaya', FALSE)
            ->where('instansi', $instansi)
            ->get('jenis_pembayaran');
        $result_biaya = $query->row();
        $totalBiaya = $result_biaya->total_biaya - $totalPotongan;


        return $totalNominal == $totalBiaya;
    }

    public function totalBiaya($nipd, $instansi)
    {
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
    public function checkNominalAmount($nipd, $instansi, $startRangeDate, $endRangeDate, $nominal)
    {

        $this->db->select_sum('nominal');
        $this->db->where('nipd', $nipd);
        $this->db->where('status', 2);
        $this->db->where('instansi', $instansi);
        $this->db->where('bulan >=', $startRangeDate->format('Y-m-d'));
        $this->db->where('bulan <=', $endRangeDate->format('Y-m-d'));
        $query = $this->db->get('transactions');
        $result = $query->row();

        if ($result) {
            $totalNominal = $result->nominal;

            if ($nominal > $totalNominal) {
                return true;
            }
        }

        return false;
    }

    public function checkFullInstallmentPayment($nipd, $instansi, $startRangeDate, $endRangeDate)
    {
        $currentDate = clone $startRangeDate;
        $endDate = clone $endRangeDate;

        while ($currentDate <= $endDate) {
            $this->db->select_sum('nominal');
            $this->db->where('nipd', $nipd);
            $this->db->where('status', 2);
            $this->db->where('instansi', $instansi);
            $this->db->where('bulan >=', $currentDate->format('Y-m-01'));
            $this->db->where('bulan <=', $currentDate->format('Y-m-t'));
            $query = $this->db->get('transactions');
            $result = $query->row();

            if (!$result || $result->nominal < $this->totalBiayaMonth($nipd, $instansi)) {
                return false;
            }

            $currentDate->modify('first day of next month');
        }

        return true;
    }



    public function totalBiayaMonths($nipd, $instansi)
    {

        $totalBiayaPertahun = $this->totalBiaya($nipd, $instansi);
        return $totalBiayaPertahun / 12;
    }



    public function getTotalPaidAmount($nipd, $instansi, $startRangeDate, $endRangeDate)
    {
        $this->db->select_sum('nominal');
        $this->db->where('nipd', $nipd);
        $this->db->where('status', 2);
        $this->db->where('instansi', $instansi);
        $this->db->where('bulan >=', $startRangeDate->format('Y-m-d'));
        $this->db->where('bulan <=', $endRangeDate->format('Y-m-d'));
        $query = $this->db->get('transactions');
        $result = $query->row();

        if ($result) {
            return $result->nominal ?? 0;
        }

        return 0;
    }




    public function totalBiayaMonth($nipd, $instansi)
    {

        $this->db->select('s.potongan as potongan', FALSE);
        $this->db->from('siswa as s');
        $this->db->join('kelas as k', 's.kelas = k.kelas', 'left');
        $this->db->join('jenis_pembayaran as j', 'k.instansi = j.instansi', 'left');
        $this->db->where('s.nipd', $nipd);
        $this->db->where('k.instansi', $instansi);
        $query_potongan = $this->db->get();
        $result_potongan = $query_potongan->row();
        $totalPotongan = $result_potongan ? $result_potongan->potongan : 0;


        $query = $this->db
            ->select('SUM(biaya) AS total_biaya', FALSE)
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

    public function getsumbiaya($instansi)
    {
        $this->db->select_sum('biaya', 'total_biaya');
        $this->db->where('instansi', $instansi);
        $query = $this->db->get('jenis_pembayaran');
        $result = $query->row();

        return $result;
    }


    public function setcount()
    {
        $this->db->set('status', 2);
        $this->db->where('nipd', $nipd);
        $this->db->update('transactions');
    }

    public function uploadcount($nipd, $thn_akademik)
    {
        $this->db->where('nipd', $nipd);
        $this->db->where('thn_akademik', $thn_akademik);
        $this->db->where('status', 2);
        $this->db->from('transactions');
        $upload_count = $this->db->count_all_results();

        return $upload_count;
    }

    public function thn_akademik_ifchange($nipd)
    {
        $this->db->select('tahun_akademik');
        $this->db->where('nipd', $nipd);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('transactions');

        return $query;
    }

    public function countStatusDiterima($nipd, $thn_akademik)
    {
        $this->db->select_sum('nominal');
        $this->db->where('nipd', $nipd);
        $this->db->where('thn_akademik', $thn_akademik);
        $this->db->where('status', 2);
        $this->db->from('transactions');
        $row = $this->db->get()->row();
        $nominal = $row ? $row->nominal : 0;

        $this->db->where('nipd', $nipd);
        $this->db->where('status', 2);
        $this->db->from('transactions');
        $count = $this->db->count_all_results();

        return ['count' => $count, 'nominal' => $nominal];
    }





    // $tahun_akademik_parts = explode('/', $thn_akademik);
    // if (count($tahun_akademik_parts) !== 2) {
    //     return []; // Invalid format, return empty array
    // }

    // $tahun_awal = trim($tahun_akademik_parts[0]);
    // $tahun_akhir = trim($tahun_akademik_parts[1]);




    public function nominalByMonth($nipd, $thn_akademik)
    {
        $this->db->select('SUM(nominal) as nominal, YEAR(bulan) as year, MONTH(bulan) as month');
        $this->db->where('nipd', $nipd);
        $this->db->where('status', 2);
        $this->db->where('thn_akademik', $thn_akademik);
        $this->db->group_by('year, month');
        $query = $this->db->get('transactions');
        $results = $query->result();

        if ($query->num_rows() === 0) {
            return [];
        }

        $indonesianMonths = array(
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        );

        $nominalByMonthData = array_fill_keys(array_keys($indonesianMonths), 0);
        $result = array();

        foreach ($results as $row) {
            $month = str_pad($row->month, 2, '0', STR_PAD_LEFT);
            $year_akademik = ($row->month < 7) ? ($row->year - 1) : $row->year;
            $thn_akademik_formatted = ($row->month < 7) ? "$year_akademik/$row->year" : "$row->year/" . ($row->year + 1);

            $nominal = (float) $row->nominal;
            $nominalByMonthData[$month] += $nominal;

            if ($nominal > 0) {
                $result[] = array(
                    'bulan' => $indonesianMonths[$month],
                    'nominal' => $nominal,
                    'thn_akademik' => $thn_akademik_formatted
                );
            }
        }

        return $result;
    }








    public function countStatusDitolak($nipd, $thn_akademik)
    {
        $this->db->where('nipd', $nipd);
        $this->db->where('status', 0);
        $this->db->where('thn_akademik', $thn_akademik);
        $this->db->from('transactions');
        $count = $this->db->count_all_results();

        $this->db->select_sum('nominal');
        $this->db->where('nipd', $nipd);
        $this->db->where('status', 0);
        $this->db->from('transactions');
        $row = $this->db->get()->row();
        $nominal = $row ? $row->nominal : 0;

        return ['count' => $count, 'nominal' => $nominal];
    }

    public function countStatusPending($nipd, $thn_akademik)
    {
        $this->db->where('nipd', $nipd);
        $this->db->where('status', 1);
        $this->db->where('thn_akademik', $thn_akademik);
        $this->db->from('transactions');
        $count = $this->db->count_all_results();

        $this->db->select_sum('nominal');
        $this->db->where('nipd', $nipd);
        $this->db->where('status', 1);
        $this->db->from('transactions');
        $row = $this->db->get()->row();
        $nominal = $row ? $row->nominal : 0;

        return ['count' => $count, 'nominal' => $nominal];
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


    public function isTahunAkademikAktif($tahunAkademik)
    {
        $this->db->from('tahun_akademik');
        $this->db->where('thn_akademik', $tahunAkademik);
        $this->db->where('status', '1');
        return $this->db->count_all_results() > 0;
    }

    public function isAktif($statusSiswa)
    {
        return $statusSiswa === '1';
    }


    public function isSiswaAktif($nipd)
    {
        $query = $this->db->get_where('siswa', ['nipd' => $nipd]);
        $result = $query->row();

        return $result && $result->status === '1';
    }



    public function SiswaAktif($nipd)
    {
        $query = $this->db->get_where('siswa', ['nipd' => $nipd]);
        $result = $query->row();

        return $result && $result->status === '1';
    }
}
