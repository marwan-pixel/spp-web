<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'controllers/User.php';
require FCPATH . 'vendor/autoload.php';
require FCPATH . 'vendor/fpdf185/fpdf.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Admin extends User {
    private $response;

    public function __construct()
    {
        parent::__construct();
        $this->response = array(
            'success' => false,
            'errors' => null,
            'redirect' => null,
        );
    }
    //Overriding parent method
    public function login($data = null) {
        $this->setData(
            array(
                'table' => 'admin',
                'selectedData' => array('kode_petugas', 'nama_petugas', 'password'),
                'value' =>  array(
                            'kode_petugas' => htmlspecialchars($this->input->post('id')),
                            ),
                'config' => array(
                                array(
                                    'field' => 'id',
                                    'label' => 'ID',
                                    'rules' => 'required|trim',
                                    'errors' =>
                                    [
                                        'required' => 'ID wajib diisi!'
                                    ]
                                    ),
                                array(
                                    'field' => 'password',
                                    'label' => 'Password',
                                    'rules' => 'required|trim',
                                    'errors' =>
                                    [
                                        'required' => 'Password wajib diisi!'
                                    ]
                                ),
                            )
        ));
        $data = $this->getData();
        $this->form_validation->set_rules($data['config']);
		if($this->form_validation->run() == true) {
            //parent method
            $process = parent::login($data);
            if(is_null($process)){
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                        Akun ini tidak terdaftar
                                        </div>');
                redirect('login');
            } else {
                if(password_verify($this->input->post('password'), $process['password'])){
                    $this->session->set_userdata('kode_petugas', $process['kode_petugas']);
                    redirect('/');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                        Password tidak sesuai
                                        </div>');
                    redirect('login');
                }
            }
        } else {
            $this->load->view('login');
        }
    }

    public function registrasi(){
        $this->setData(
            array(
                'table' => 'admin',
                'config' => array(
                                array(
                                    'field' => 'id',
                                    'label' => 'ID',
                                    'rules' => 'required|trim|min_length[5]|is_unique[admin.kode_petugas]',
                                    'errors' => 
                                    [
                                        'required' => 'ID wajib diisi!',
                                        'is_unique' => 'ID sudah tersedia!'
                                    ]
                                ),
                                array(
                                    'field' => 'nama',
                                    'label' => 'Nama',
                                    'rules' => 'required|trim',
                                    'errors' => 
                                    [
                                        'required' => 'Nama wajib diisi!'
                                    ]
                                ),
                                array(
                                    'field' => 'password',
                                    'label' => 'Password',
                                    'rules' => 'required|trim|min_length[5]',
                                    'errors' =>
                                    [
                                        'required' => 'Password wajib diisi!'
                                    ]
                                ),
                                array(
                                    'field' => 'conf_password',
                                    'label' => 'Confirm Password',
                                    'rules' => 'required|trim|matches[password]',
                                    'errors' =>
                                    [
                                        'matches' => 'Password tidak sama!'
                                    ]
                                )
                            ),
                'value' => array(
                            'kode_petugas' => htmlspecialchars($this->input->post('id')),
                            'nama_petugas' => htmlspecialchars($this->input->post('nama')),
                            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                            )
                )
            );
        $data = $this->getData();
        $this->form_validation->set_rules($data['config']);
        if($this->form_validation->run() == true) {
            $process = $this->model->insertDataModel($data['table'], $data['value']);
            if($process['status'] == true){
                $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                        {$process['message']}
                                        </div>");
                redirect('login');
            } else {
                $process['message'] = "Registrasi berhasil! Silakan login";
                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                        {$process['message']}
                                        </div>");
                redirect('registrasi');
            }
        } else {
            $this->load->view('registrasi');
        }
    }

    public function tambahDataBiaya(){
        $this->setData(
            array(
                'table' => 'jenis_pembayaran',
                'value' => 
                array(
                    'jenis_pembayaran' => htmlspecialchars($this->input->post('jenis_pembayaran')),
                    'biaya' => htmlspecialchars($this->input->post('biaya')),
                    'instansi' => htmlspecialchars($this->input->post('instansi'))                    
                ),
                'config' =>
                array(
                     array(
                            'field' => 'jenis_pembayaran',
                            'label' => 'Jenis Pembayaran',
                            'rules' => 'required|trim',
                            'errors' =>
                            [
                                'required' => 'Jenis pembayaran wajib diisi!',
                            ]
                        ),
                    array(
                            'field' => 'biaya',
                            'label' => 'Biaya',
                            'rules' => 'required|trim',
                            'errors' =>
                            [
                                'required' => 'Biaya wajib diisi!'
                            ]
                        ),
                )
            )
        );
        $response = $this->response;
        $data = $this->getData();
        $this->form_validation->set_rules($data['config']);
        if($this->form_validation->run() == true) {
            $process = $this->model->insertDataModel($data['table'], $data['value']);
            if($process['status'] == true){
                $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                        {$process['message']}
                                        </div>");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                        {$process['message']}
                                        </div>");
            }
            $response['redirect'] = site_url('databiaya');
            $response['success'] = true;
        } else {
            $response['errors'] =  array('jenis_pembayaran' => form_error('jenis_pembayaran'), 'biaya' => form_error('biaya'));
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function ubahDataBiaya(){
         $this->setData(
            array(
                'table' => 'jenis_pembayaran',
                'where' =>  array('id_jenis_pembayaran' => $this->input->post('id_jenis_pembayaran')),
                'value' => 
                array(
                    'jenis_pembayaran' => htmlspecialchars($this->input->post('jenis_pembayaran')),
                    'biaya' => htmlspecialchars($this->input->post('biaya')),
                    'instansi' => htmlspecialchars($this->input->post('instansi'))

                ),
                'config' =>
                array(
                    array(
                            'field' => 'jenis_pembayaran',
                            'label' => 'Biaya',
                            'rules' => 'required|trim',
                            'errors' =>
                            [
                                'required' => 'Jenis Pembayaran wajib diisi!',
                            ]
                        ),
                    array(
                            'field' => 'biaya',
                            'label' => 'Biaya',
                            'rules' => 'required|trim',
                            'errors' =>
                            [
                                'required' => 'Biaya wajib diisi!'
                            ]
                        ),
                    array(
                            'field' => 'instansi',
                            'label' => 'Instansi',
                            'rules' => 'required|trim',
                            'errors' =>
                            [
                                'required' => 'Instansi wajib diisi!'
                            ]
                        ),
                )
            )
        );

        $data = $this->getData();
        $response = $this->response;
        $this->form_validation->set_rules($data['config']);
        if($this->form_validation->run() == true) {
            $existingData = $this->model->getDataModel($data['table'], ['jenis_pembayaran', 'biaya', 'instansi'], $data['value']);
            if($existingData == $data['value']) {
                $response['errors'] = array( 'instansi' => "Data harus berbeda saat ingin diubah!"); 
            } else {
                $process = $this->model->updateDataModel($data['table'],$data['value'], $data['where']);
                if($process['status'] == true){
                    $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                            {$process['message']}
                                            </div>");
                } else {
                    $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                            {$process['message']}
                                            </div>");
                }
                $response['success'] = true;
                $response['redirect'] = site_url('databiaya');
            }  
        } else {
            $response['errors'] = array('jenis_pembayaran' => form_error('jenis_pembayaran'), 'biaya' => form_error('biaya'), 'instansi' => form_error('instansi'));             
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function tambahDataKelas(){
         $this->setData(
            array(
                'table' => 'kelas',
                'value' => 
                array(
                    'kelas' => htmlspecialchars($this->input->post('kelas')),
                    'instansi' => htmlspecialchars($this->input->post('instansi'))
                ),
                'config' =>
                array(
                     array(
                            'field' => 'kelas',
                            'label' => 'Kelas',
                            'rules' => 'required|trim|is_unique[kelas.kelas]',
                            'errors' =>
                            [
                                'required' => 'Kelas wajib diisi!',
                                'is_unique' => 'Kelas sudah tersedia!'
                            ]
                        ),
                    array(
                            'field' => 'instansi',
                            'label' => 'Instansi',
                            'rules' => 'required|trim',
                            'errors' =>
                            [
                                'required' => 'Instansi wajib diisi!'
                            ]
                        ),
                    ),
            )
        );

        $response = $this->response;        
        $data = $this->getData();
        $this->form_validation->set_rules($data['config']);
        if($this->form_validation->run() == true) {
            $process = $this->model->insertDataModel($data['table'], $data['value']);
            if($process['status'] == true){
                $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                        {$process['message']}
                                        </div>");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                        {$process['message']}
                                        </div>");
            }
            $response['success'] = true;
            $response['redirect'] = base_url('pages/datakelas');
        } else {
            $response['error'] = array('kelas' => form_error('kelas'), 'instansi' => form_error('instansi'));
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function ubahDataKelas(){
         $this->setData(
            array(
                'table' => 'kelas',
                'where' =>  array('kelas' => $this->input->post('kelas')),
                'value' => 
                array(
                    'kelas' => htmlspecialchars($this->input->post('kelasnew')),
                    'instansi' => htmlspecialchars($this->input->post('instansi'))
                ),
                'config' =>
                array(
                    array(
                            'field' => 'kelasnew',
                            'label' => 'Kelas',
                            'rules' => 'required|trim',
                            'errors' =>
                            [
                                'required' => 'Kelas wajib diisi!'
                            ]
                        ),
                    array(
                            'field' => 'instansi',
                            'label' => 'Instansi',
                            'rules' => 'required|trim',
                            'errors' =>
                            [
                                'required' => 'Instansi wajib diisi!'
                            ]
                        ),
                )
            )
        );

        $data = $this->getData();
        $response = $this->response;
        $this->form_validation->set_rules($data['config']);

        if($this->form_validation->run() == true) {
            $existingData = $this->model->getDataModel($data['table'], ['kelas','instansi'], $data['value']);
            if($existingData == $data['value']) {
                $response['errors'] = array( 'instansi' => "Data harus berbeda saat ingin diubah!");                
            } else {
                $process = $this->model->updateDataModel($data['table'],$data['value'], $data['where']);
                if($process['status'] == true){
                    $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                            {$process['message']}
                                            </div>");
                } else {
                    $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                            {$process['message']}
                                            </div>");
                }
                $response['success'] = true;
                $response['redirect'] = base_url('pages/datakelas');
            }
        } else {
            $response['errors'] = array('kelasnew' => form_error('kelasnew'), 'instansi' => form_error('instansi'));
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function tambahDataInstansi(){
         $this->setData(
            array(
                'table' => 'instansi',
                'value' => 
                array(
                    'instansi' => htmlspecialchars($this->input->post('instansi'))
                ),
                'config' =>
                array(
                     array(
                            'field' => 'instansi',
                            'label' => 'Instansi',
                            'rules' => 'required|trim|is_unique[kelas.kelas]',
                            'errors' =>
                            [
                                'required' => 'Instansi wajib diisi!',
                                'is_unique' => 'Instansi sudah tersedia!'
                            ]
                        ),
                    ),
            )
        );
        $response = $this->response;
        $data = $this->getData();
        $this->form_validation->set_rules($data['config']);
        if($this->form_validation->run() == true) {
            $process = $this->model->insertDataModel($data['table'], $data['value']);
            if($process['status'] == true){
                $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                        {$process['message']}
                                        </div>");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                        {$process['message']}
                                        </div>");
            }
            $response['success'] = true;
            $response['redirect'] = base_url('pages/datainstansi');
        } else {
            $response['errors'] = array( 'instansi' => form_error('instansi'));
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function ubahDataInstansi(){
        $this->setData(
            array(
                'table' => 'instansi',
                'where' =>  array('instansi' => $this->input->post('instansi')),
                'value' => 
                array(
                    'instansi' => htmlspecialchars($this->input->post('instansinew'))
                ),
                'config' =>
                array(
                     array(
                            'field' => 'instansinew',
                            'label' => 'Instansi',
                            'rules' => 'required|trim',
                            'errors' =>
                            [
                                'required' => 'Instansi wajib diisi!',
                            ]
                        ),
                    ),
            )
        );
        $data = $this->getData();
        $response = $this->response;
        $this->form_validation->set_rules($data['config']);
        if($this->form_validation->run() == true) {
            $existingData = $this->model->getDataModel($data['table'], ['instansi'], $data['value']);
            if($existingData == $data['value']){
                $response['errors'] = array( 'instansinew' => "Data harus berbeda saat ingin diubah!");
            } else {
                $process = $this->model->updateDataModel($data['table'], $data['value'], $data['where']);
                if($process['status'] == true){
                    $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                            {$process['message']}
                                            </div>");
                } else {
                    $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                            {$process['message']}
                                            </div>");
                }
                $response['success'] = true;
                $response['redirect'] = base_url('pages/datainstansi');
            }
        } else {
            $response['errors'] = array( 'instansinew' => form_error('instansinew'));
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function tambahDataSiswa(){
        $this->setData(
            array(
                'table' => 'siswa',
                'value' => 
                array(
                    'nipd' => htmlspecialchars($this->input->post('nipd')),
                    'nama_siswa' => htmlspecialchars($this->input->post('nama')),
                    'kelas' => htmlspecialchars($this->input->post('kelas')),
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'potongan' => htmlspecialchars($this->input->post('potongan')),
                ),
                'config' =>
                array(
                    array(
                        'field' => 'nipd',
                        'label' => 'nipd',
                        'rules' => 'required|trim|is_unique[siswa.nipd]',
                        'errors' =>
                        [
                            'required' => 'nipd wajib diisi!',
                            'is_unique' => 'ID sudah tersedia!'
                        ]
                    ),
                    array(
                        'field' => 'kelas',
                        'label' => 'Kelas',
                        'rules' => 'required|trim',
                        'errors' =>
                        [
                            'required' => 'Kelas wajib diisi!'
                        ]
                    ),
                    array(
                        'field' => 'nama',
                        'label' => 'Nama',
                        'rules' => 'required|trim',
                        'errors' =>
                        [
                            'required' => 'Nama wajib diisi!'
                        ]
                    ),
                    array(
                        'field' => 'password',
                        'label' => 'Password',
                        'rules' => 'required|trim',
                        'errors' =>
                        [
                            'required' => 'Password wajib diisi!'
                        ]
                    ),
                ),
            )
        );
        $response = $this->response;
        $data = $this->getData();
        if(is_null($data['value']['potongan'])){
            $data['value']['potongan'] = 0;
        }
        $this->form_validation->set_rules($data['config']);
        if($this->form_validation->run() == true) {
            $process = $this->model->insertDataModel($data['table'], $data['value']);
            if($process['status'] == true){
                $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                        {$process['message']}
                                        </div>");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                        {$process['message']}
                                        </div>");                                
            }
            $response['success'] = true;
            $response['redirect'] = base_url('pages/datasiswa');
        } else {
            $response['errors'] = array('nipd' => form_error('nipd'), 'nama' => form_error('nama'), 'kelas' => form_error('kelas'), 'password' => form_error('password'),
            );

        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function ubahDataSiswa(){
        $this->setData(
           array(
               'table' => 'siswa',
               'where' =>  array('nipd' => $this->input->post('nipd')),
               'value' => 
               array(
                   'nama_siswa' => htmlspecialchars($this->input->post('nama')),
                   'kelas' => htmlspecialchars($this->input->post('kelas')),
                   'potongan' => htmlspecialchars($this->input->post('potongan'))
               ),
               'config' =>
               array(
                    array(
                           'field' => 'nama',
                           'label' => 'Nama',
                           'rules' => 'required|trim',
                           'errors' =>
                           [
                               'required' => 'Nama wajib diisi!'
                           ]
                    ),
                    array(
                            'field' => 'kelas',
                            'label' => 'Kelas',
                            'rules' => 'required|trim',
                            'errors' =>
                            [
                                'required' => 'kelas wajib diisi!'
                            ]
                    ),
               )
           )
        );
        $response = $this->response;
        $data = $this->getData();
        if(is_null($data['value']['potongan'])){
            $data['value']['potongan'] = 0;
        }
        $this->form_validation->set_rules($data['config']);
        if($this->form_validation->run() == true) {
            $existingData = $this->model->getDataModel($data['table'], ['nama_siswa', 'kelas', 'potongan'], $data['value']);
            if($existingData == $data['value']){
                $response['errors'] = array('potongan' => "Data harus berbeda saat ingin diubah!");       
            } else {
                $process = $this->model->updateDataModel($data['table'],$data['value'], $data['where']);
                if($process['status'] == true){
                    $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                            {$process['message']}
                                            </div>");
                } else {
                    $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                            {$process['message']}
                                            </div>");
                }
                $response['success'] = true;
                $response['redirect'] = site_url('datasiswa');
            }
        } else {
            $response['errors'] = array('nama' => form_error('nama'), 'kelas' => form_error('kelas'), 'instansi' => form_error('instansi'));
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function ubahDataAdmin(){
        $this->setData(
            array(
                'table' => 'admin',
                'where' =>  array('kode_petugas' => $this->input->post('kode_petugas')),
                'value' => 
                array(
                    'nama_petugas' => htmlspecialchars($this->input->post('nama')),
                    ),
                'config' =>
                array(
                        array(
                            'field' => 'nama',
                            'label' => 'Nama',
                            'rules' => 'required|trim',
                            'errors' =>
                            [
                                'required' => 'Nama wajib diisi!'
                            ]
                        ),
                    )
                )
            );
            $response = $this->response;
            $data = $this->getData();
            $existingData = $this->model->getDataModel($data['table'], ['nama_petugas'], $data['value']);

            if(!empty($this->input->post('password'))){
                $data['value']['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
                $this->form_validation->set_rules('password','Password','required|trim|min_length[8]', array('required' => 'Password wajib diisi!',
                'min_length' => 'Password minimal terdiri dari 8 karakter!'));
                $this->form_validation->set_rules('confPassword','ConfPassword','required|trim|matches[password]', array( 'required' => 'Konfirmasi Password wajib diisi!',
                'matches' => 'Password tidak sama!'));
                $this->model->getDataModel($data['table'], ['nama_admin', 'password'], $data['value']);
            }
            
            $this->form_validation->set_rules($data['config']);
            if($this->form_validation->run() == true) {
                if($existingData == $data['value']) {
                    $response['errors'] = array('update' => "Data harus berbeda saat ingin diubah!");                    
                } else {
                    $process = $this->model->updateDataModel($data['table'],$data['value'], $data['where']);
                    if($process['status'] == true){
                        $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                                {$process['message']}
                                                </div>");
                    } else {
                        $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                                {$process['message']}
                                                </div>");
                    }
                    $response['success'] = true;
                    $response['redirect'] = site_url('dataadmin');
                }
            } else {
                $response['errors'] = array('nama' => form_error('nama'), 'password' => form_error('password'), 'confPassword' => form_error('confPassword'));
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function cetakDataTransaksi(){
        $this->setData(
            array(
                'table' => 'transactions',
                'param' => array(
                    'nipd' => $this->input->post('nipd'),
                    'since' => $this->input->post('sincewhen'),
                    'to' => $this->input->post('tillwhen')
                ),
            )
        );
        $data = $this->getData();
        $response = $this->response;
        if((empty($data['param']['since']) && !empty($data['param']['to'])) || (!empty($data['param']['since']) 
        && empty($data['param']['to']))){
            $response['errors'] = array('errormessage' => 'Tanggal harus diisi kedua - duanya!');
        } else {
            $process = $this->model->printDataModel($data['table'],['siswa.nama_siswa', 'kelas.kelas', 
            'kelas.instansi' ,'nominal', 'status', 'keterangan', 'created_at'], $data['param']);
            if(count($process) == 0){
                $response['errors'] = array('errormessage' => 'Data transaksi tidak ada!');
            } else {
                if($this->input->post('function') == 'cetak'){
                    if($this->input->post('excel') == 'excel'){
                        $this->cetakExcel($process);
                    } elseif($this->input->post('pdf') == 'pdf') {
                        $this->cetakPDF($process);
                    }
                }
                $response['success'] = true;
            }
        }
        // header('Content-Type: application/json');
        // echo json_encode($response);
        // exit();
    }

    public function cetakExcel($data){
        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();

        $activeWorksheet->setCellValue('A1', 'No');
        $activeWorksheet->setCellValue('B1', 'Nama');
        $activeWorksheet->setCellValue('C1', 'Kelas');
        $activeWorksheet->setCellValue('D1', 'Instansi');
        $activeWorksheet->setCellValue('E1', 'Nominal');
        $activeWorksheet->setCellValue('F1', 'Keterangan');
        $activeWorksheet->setCellValue('G1', 'Tanggal Bayar');
        $activeWorksheet->setCellValue('H1', 'Status');
        $activeWorksheet->getColumnDimension('A')->setWidth(5);
        $activeWorksheet->getColumnDimension('B')->setWidth(14);
        $activeWorksheet->getColumnDimension('C')->setWidth(8);
        $activeWorksheet->getColumnDimension('D')->setWidth(15);
        $activeWorksheet->getColumnDimension('E')->setWidth(10);
        $activeWorksheet->getColumnDimension('F')->setWidth(25);
        $activeWorksheet->getColumnDimension('G')->setWidth(20);
        $activeWorksheet->getColumnDimension('H')->setWidth(5);
        $no = 1;
        $sn = 2;
        foreach ($data as $value) {
            # code...
            $activeWorksheet->setCellValue('A'.$sn, $no++);
            $activeWorksheet->setCellValue('B'.$sn, $value['nama_siswa']);
            $activeWorksheet->setCellValue('C'.$sn, $value['kelas']);
            $activeWorksheet->setCellValue('D'.$sn, $value['instansi']);
            $activeWorksheet->setCellValue('E'.$sn, $value['nominal']);
            $activeWorksheet->setCellValue('F'.$sn, $value['keterangan']);
            $activeWorksheet->setCellValue('G'.$sn, $value['created_at']);
            $activeWorksheet->setCellValue('H'.$sn, $value['status']);
            $activeWorksheet->getStyle('C'.$sn)->getAlignment()->
            setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $activeWorksheet->getStyle('E'.$sn)->getAlignment()->
            setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            $sn++;
        }
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save(FCPATH . "excel/laporan-transaksi-spp.xlsx");
        // Set the headers
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename=laporan-transaksi-spp.xlsx');
        header("Content-Transfer-Encoding:binary");
        header('Content-Length: ' . filesize("excel/laporan-transaksi-spp.xlsx")); // Set the file size

        ob_clean();
        flush();
        // Output the file content
        readfile("excel/laporan-transaksi-spp.xlsx");
    }

    public function cetakPDF($data) {
        $pdf = new FPDF('L','mm','A4');
        $pdf->AddPage();
        $pdf->Image('assets/img/Yayasan Ar-Rahmah.jpeg', 12, 6, 30);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(120);
        $pdf->Cell(190, 7, 'Data Transaksi SPP', 0, 1);
        $pdf->Ln(15); // Berpindah baris
        
        $pdf->SetFont('Arial', '', '12');
        $pdf->Cell(10, 10, "No", 1);
        $pdf->Cell(40, 10, "Nama Siswa", 1);
        $pdf->Cell(25, 10, "Kelas", 1);
        $pdf->Cell(40, 10, "Instansi", 1);
        $pdf->Cell(27, 10, "Nominal", 1);
        $pdf->Cell(60, 10, "Keterangan", 1);
        $pdf->Cell(42, 10, "Tanggal Bayar", 1);
        $pdf->Cell(20, 10, "Status", 1);

        $no = 1;
        foreach ($data as $row) {
            $pdf->Ln();
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(10, 10, $no++, 1);
            $pdf->Cell(40, 10, $row['nama_siswa'], 1);
            $pdf->Cell(25, 10, $row['kelas'], 1);
            $pdf->Cell(40, 10, $row['instansi'], 1);
            $pdf->Cell(27, 10, $row['nominal'], 1);
            $pdf->Cell(60, 10, $row['keterangan'], 1);
            $pdf->Cell(42, 10, $row['created_at'], 1);
            $pdf->Cell(20, 10, $row['status'], 1);
        }
        $pdf->Output();
    }
}
?>
