<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'controllers/User.php';

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
        if((empty($data['param']['since']) && !empty($data['param']['to'])) || (!empty($data['param']['since']) && empty($data['param']['to']))){
            $response['errors'] = array('errormessage' => 'Tanggal harus diisi kedua - duanya!');
        } else {
            $process = $this->model->printDataModel($data['table'],['nipd', 'nominal', 'status', 'keterangan', 'created_at'], $data['param']);
            // echo var_dump($process);
            // die();
            if(count($process) == 0){
                $response['errors'] = array('errormessage' => 'Data transaksi kosong!');
            } else {
                $response['success'] = true;
                $response['redirect'] = site_url('cetak?'. http_build_query($process));
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function cetak(){
        $this->load->view('cetak');
    }
}
?>
