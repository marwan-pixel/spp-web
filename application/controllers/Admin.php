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
                $this->load->view('login');
            } else {
                if(password_verify($this->input->post('password'), $process[0]['password'])){
                    $this->session->set_userdata('kode_petugas', $process[0]['kode_petugas']);
                    redirect('/');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                        Password tidak sesuai
                                        </div>');
                    $this->load->view('login');
                }
            }
        } else {
            $this->load->view('login');
        }
    }

    public function tambahDataAdmin(){
        if($this->session->userdata('kode_petugas')) {
            $this->setData(
                array(
                    'table' => 'admin',
                    'config' => array(
                                    array(
                                        'field' => 'kode_petugas',
                                        'label' => 'Kode Petugas',
                                        'rules' => 'required|trim|min_length[5]|is_unique[admin.kode_petugas]',
                                        'errors' => 
                                        [
                                            'required' => 'Kode petugas wajib diisi!',
                                            'is_unique' => 'Kode petugas sudah tersedia!'
                                        ]
                                    ),
                                    array(
                                        'field' => 'nama_petugas',
                                        'label' => 'Nama Petugas',
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
                                            'required' => 'Password wajib diisi!',
                                            'min_length' => 'Password minimal terdiri dari lima karakter'
                                        ]
                                    ),
                                    array(
                                        'field' => 'confPassword',
                                        'label' => 'Confirm Password',
                                        'rules' => 'required|trim|matches[password]',
                                        'errors' =>
                                        [
                                            'required' => 'Konfirmasi password wajib diisi',
                                            'matches' => 'Password tidak sama!'
                                        ]
                                    )
                                ),
                    'value' => array(
                                'kode_petugas' => htmlspecialchars($this->input->post('kode_petugas')),
                                'nama_petugas' => htmlspecialchars($this->input->post('nama_petugas')),
                                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                                'status' => 1
                                )
                    )
            );
            $data = $this->getData();
            $response = $this->response;
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
                $response['redirect'] = site_url('dataadmin');
                $response['success'] = true;
            } else {
                $response['errors'] =  array('kode_petugas' => form_error('kode_petugas'), 'nama_petugas' => form_error('nama_petugas'), 
                'password' => form_error('password'), 'confPassword' => form_error('confPassword'));
            }
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
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
                    'instansi' => htmlspecialchars($this->input->post('instansi')),
                    'status' => 1                  
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

    public function hapusDataBiaya(){
        $this->setData(
            array(
                'table' => 'jenis_pembayaran',
                'where' =>  array('id_jenis_pembayaran' => $this->input->post('id_jenis_pembayaran')),
                'value' => 
                array(
                    'status' => 0
                 ),
            )
        );
 
        $data = $this->getData();
        $response = $this->response;
        $process = $this->model->updateDataModel($data['table'],$data['value'], $data['where']);
        if($process['status'] == true){
            $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                    Data berhasil dihapus
                                    </div>");
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                    Data gagal dihapus
                                    </div>");
        }
        
        $response['success'] = true;
        $response['redirect'] = base_url('pages/databiaya');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function restoreDataBiaya(){
        $this->setData(
            array(
                'table' => 'jenis_pembayaran',
                'where' =>  array('id_jenis_pembayaran' => $this->input->post('id_jenis_pembayaran')),
                'value' => 
                array(
                    'status' => 1,
                ),
            )
         );
        $response = $this->response;
        $data = $this->getData();
        $checkingKelasStatus = $this->model->getDataModel('instansi', ['status'], ['jenis_instansi' => $this->input->post('instansi')]);
        if($checkingKelasStatus[0]['status'] == 0) {
            $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
            Data gagal dipulihkan karena instansi yang bersangkutan belum dipulihkan. Pulihkan instansi tersebut
            di Data Nonaktif Instansi.
            </div>");
        } else {
            $process = $this->model->updateDataModel($data['table'],$data['value'], $data['where']);
            if($process['status'] == true){
                $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                Data berhasil dipulihkan
                </div>");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                Data Gagal dipulihkan
                </div>");
            }
        }
        $response['success'] = true;
        $response['redirect'] = site_url('pages/datanonaktifbiaya');
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
                    'instansi' => htmlspecialchars($this->input->post('instansi')),
                    'status' => 1
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
            $existingData = $this->model->getDataModel($data['table'], ['kelas','instansi'], $data['where']);
            $CheckingSameData = $this->model->getDataModel($data['table'], ['kelas, instansi'], $data['value']);
            if($existingData == $data['value']) {
                $response['errors'] = array( 'instansi' => "Data harus berbeda saat ingin diubah!");                
            } elseif(!empty($CheckingSameData)){
                $response['errors'] = array( 'instansi' => "Ada Data yang sama di Database!");
            } 
            else {
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

    public function hapusDataKelas(){
        $this->setData(
           array(
               'table' => 'kelas',
               'where' =>  array('kelas' => $this->input->post('kelas')),
               'value' => 
               array(
                   'status' => 0
                ),
           )
       );

       $data = $this->getData();
       $response = $this->response;
       $process = $this->model->updateDataModel($data['table'],$data['value'], $data['where']);
       if($process['status'] == true){
           $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                   Data berhasil dihapus
                                   </div>");
       } else {
           $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                   Data gagal dihapus
                                   </div>");
       }
       
       $response['success'] = true;
       $response['redirect'] = base_url('pages/datakelas');
       header('Content-Type: application/json');
       echo json_encode($response);
       exit();
    }

    public function restoreDataKelas(){
        $this->setData(
            array(
                'table' => 'kelas',
                'where' =>  array('kelas' => $this->input->post('kelas')),
                'value' => 
                array(
                    'status' => 1,
                ),
            )
         );
        $response = $this->response;
        $data = $this->getData();
        $checkingKelasStatus = $this->model->getDataModel('instansi', ['status'], ['jenis_instansi' => $this->input->post('jenis_instansi')]);
        if($checkingKelasStatus[0]['status'] == 0) {
            $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
            Data gagal dipulihkan karena instansi yang bersangkutan belum dipulihkan. Pulihkan instansi tersebut
            di Data Nonaktif Instansi.
            </div>");
        } else {
            $process = $this->model->updateDataModel($data['table'],$data['value'], $data['where']);
            if($process['status'] == true){
                $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                Data berhasil dipulihkan
                </div>");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                Data Gagal dipulihkan
                </div>");
            }
        }
        $response['success'] = true;
        $response['redirect'] = site_url('pages/datanonaktifkelas');
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
                    'jenis_instansi' => htmlspecialchars($this->input->post('instansi')),
                    'status' => 1
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
                'where' =>  array('jenis_instansi' => $this->input->post('instansi')),
                'value' => 
                array(
                    'jenis_instansi' => htmlspecialchars($this->input->post('instansinew'))
                ),
                'config' =>
                array(
                     array(
                            'field' => 'instansinew',
                            'label' => 'Instansi',
                            'rules' => 'required|trim|is_unique[instansi.jenis_instansi]',
                            'errors' =>
                            [
                                'required' => 'Instansi wajib diisi!',
                                'is_unique' => 'Data sudah ada tersimpan database!'
                            ]
                        ),
                    ),
            )
        );
        $data = $this->getData();
        $response = $this->response;
        $this->form_validation->set_rules($data['config']);
        if($this->form_validation->run() == true) {
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
        } else {
            $response['errors'] = array( 'instansinew' => form_error('instansinew'));
        }

        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function hapusDataInstansi(){
        $this->setData(
            array(
                'table' => 'instansi',
                'where' => array('jenis_instansi' => $this->input->post('instansi')),
                'value' => array('status' => 0)
            )
        );
        $data = $this->getData();
        $response = $this->response;
        $process = $this->model->updateDataModel($data['table'], $data['value'], $data['where']);
        
        if($process['status'] == true){
            $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                    Data berhasil dihapus
                                    </div>");
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                    Data gagal dihapus
                                    </div>");
        }
        $response['success'] = true;
        $response['redirect'] = base_url('pages/datainstansi');

        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function restoreDataInstansi(){
        $this->setData(
            array(
                'table' => 'instansi',
                'where' => array('jenis_instansi' => $this->input->post('jenis_instansi')),
                'value' => array('status' => 1)
            )
        );
        $data = $this->getData();
        $response = $this->response;
        $process = $this->model->updateDataModel($data['table'], $data['value'], $data['where']);
        
        if($process['status'] == true){
            $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                    Data berhasil dipulihkan
                                    </div>");
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                    Data gagal dipulihkan
                                    </div>");
        }
        $response['success'] = true;
        $response['redirect'] = base_url('pages/datanonaktifinstansi');

        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function tambahDataSiswa(){
        $response = $this->response;
        $this->setData(
            array(
                'table' => 'siswa',
                'value' => 
                array(
                    'nipd' => htmlspecialchars($this->input->post('nipd')),
                    'nama_siswa' => htmlspecialchars($this->input->post('nama')),
                    'kelas' => htmlspecialchars($this->input->post('kelas')),
                    'thn_akademik' => htmlspecialchars($this->input->post('thn_akademik')),
                    'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    'potongan' => htmlspecialchars($this->input->post('potongan')),
                    'status' => 1
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
                        'field' => 'thn_akademik',
                        'label' => 'Tahun Akademik',
                        'rules' => 'required|trim',
                        'errors' =>
                        [
                            'required' => 'Tahun Akademik wajib diisi!'
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
            $response['errors'] = array('nipd' => form_error('nipd'), 'nama' => form_error('nama'), 'thn_akademik' => form_error('thn_akademik'), 
            'kelas' => form_error('kelas'), 'password' => form_error('password'), 'status' => form_error('status')
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function tambahDataSiswaExcel(){
        $data = $process = array();
        header('Content-Type: application/json');
        $response = $this->response;
        if(isset($_FILES['fileExcel']['name'])){
            $file_extension = pathinfo($_FILES['fileExcel']['name'], PATHINFO_EXTENSION);
            if($file_extension == 'csv' || $file_extension == 'xls' || $file_extension == 'xlsx') {
                $path = $_FILES['fileExcel']['tmp_name'];
                
                $spreadsheet = IOFactory::load($path);
                // $sheetCount = $spreadsheet->getSheetCount();
                foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
                    
                    $highestRow = $worksheet->getHighestRow();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $nipd = $worksheet->getCell('A' . $row)->getValue();
                        $nama_siswa = $worksheet->getCell('B' . $row)->getValue();
                        $kelas = $worksheet->getCell('C' . $row)->getValue();
                        $thn_akademik = $worksheet->getCell('D' . $row)->getValue();
                        $password = $worksheet->getCell('E' . $row)->getValue();
                        $potongan = $worksheet->getCell('F' . $row)->getValue();
                        if($nipd == null || $nama_siswa == null || $kelas == null || $thn_akademik == null || $password == null) {
                            $response['errors'] = array('fileExcel' => "Terdapat nilai yang kosong pada kolom di Excel!");
                        }
                         else {
                            $potongan == null ? 0 : $potongan;
                            $data['value'] = array(
                                'nipd' => strval($nipd),
                                'nama_siswa' => $nama_siswa,
                                'kelas' => $kelas,
                                'thn_akademik' => $thn_akademik,
                                'password' => password_hash($password, PASSWORD_BCRYPT),
                                'potongan' => strval($potongan),
                                'status' => 1
                            );
                            if(count(array_unique($data['value'])) < count($data['value'])) {
                                $response['errors'] = array('fileExcel' => "Terdapat Duplikasi Pada NIPD di Excel!");
                            } else {
                                $existingData = $this->model->getDataModel('siswa', ['nipd'], ['nipd' => $data['value']['nipd']]);
                                if(!empty($existingData)){
                                    $response['errors'] = array('fileExcel' => "Terdapat Duplikasi Pada NIPD di Database!");
                                } else {
                                    $process = $this->model->insertDataModel('siswa', $data['value']);
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
                                    // $response['errors'] = null;
                                    $response['redirect'] = base_url('pages/datasiswa');
                                }
                            }
                        }
                        
                    }
                }
            } else {
                $response['errors'] = array('fileExcel' => "Hanya menerima file dengan format .csv, .xls, dan .xlsx!");
            }
        } 
        echo json_encode($response);
        // exit();
    }

    public function ubahDataSiswa(){
        $this->setData(
           array(
               'table' => 'siswa',
               'where' =>  array('nipd' => $this->input->post('nipd')),
               'value' => 
               array(
                    'nipd' => htmlspecialchars($this->input->post('nipdnew')),
                    'nama_siswa' => htmlspecialchars($this->input->post('nama')),
                    'kelas' => htmlspecialchars($this->input->post('kelas')),
                    'potongan' => htmlspecialchars($this->input->post('potongan')),
                    'thn_akademik' => htmlspecialchars($this->input->post('thn_akademik')),
               ),
               'config' =>
               array(
                    array(
                        'field' => 'nipdnew',
                        'label' => 'NIPD',
                        'rules' => 'required|trim',
                        'errors' =>
                        [
                            'required' => 'NIPD wajib diisi!'
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
                            'field' => 'kelas',
                            'label' => 'Kelas',
                            'rules' => 'required|trim',
                            'errors' =>
                            [
                                'required' => 'kelas wajib diisi!'
                            ]
                    ),
                    array(
                            'field' => 'thn_akademik',
                            'label' => 'Tahun Akademik',
                            'rules' => 'required|trim',
                            'errors' =>
                            [
                                'required' => 'Tahun akademik wajib diisi!'
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
            $existingData = $this->model->getDataModel($data['table'], ['nipd', 'nama_siswa', 'kelas', 'thn_akademik' ,'potongan'], $data['where']);
            $CheckingSameData = $this->model->getDataModel($data['table'], ['nipd', 'nama_siswa', 'kelas', 'thn_akademik' ,'potongan'], $data['value']);
            if($existingData == $data['value']){
                $response['errors'] = array('potongan' => "Data harus berbeda saat ingin diubah!");       
            } else if(!empty($CheckingSameData)){
                $response['errors'] = array('nipd' => "NIPD sudah tersimpan di database!");       
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

    public function hapusDataSiswa(){
        $this->setData(
            array(
                'table' => 'siswa',
                'where' =>  array('nipd' => $this->input->post('nipd')),
                'value' => 
                array(
                    'status' => 0,
                ),
            )
         );
        $response = $this->response;
        $data = $this->getData();
        $process = $this->model->updateDataModel($data['table'],$data['value'], $data['where']);
        if($process['status'] == true){
            $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
            Data berhasil dihapus!
            </div>");
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
            Data Gagal dihapus!
            </div>");
        }
        $response['success'] = true;
        $response['redirect'] = site_url('pages/datasiswa');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function restoreDataSiswa(){
        $this->setData(
            array(
                'table' => 'siswa',
                'where' =>  array('nipd' => $this->input->post('nipd')),
                'value' => 
                array(
                    'status' => 1,
                ),
            )
         );
        $response = $this->response;
        $data = $this->getData();
        $checkingKelasStatus = $this->model->getDataModel('kelas', [ 'status'], ['kelas' => $this->input->post('kelas')]);
        if($checkingKelasStatus[0]['status'] == 0) {
            $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
            Data gagal dipulihkan karena kelas yang bersangkutan belum dipulihkan. Pulihkan kelas tersebut
            di Data Kelas.
            </div>");
        } else {
            $process = $this->model->updateDataModel($data['table'],$data['value'], $data['where']);
            if($process['status'] == true){
                $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                Data berhasil dipulihkan
                </div>");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                Data Gagal dipulihkan
                </div>");
            }
        }
        $response['success'] = true;
        $response['redirect'] = site_url('pages/datanonaktifsiswa');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function tambahDataTahunAkademik(){
        $response = $this->response;
        $this->setData(
            array(
                'table' => 'tahun_akademik',
                'value' => 
                array(
                    'thn_akademik' => htmlspecialchars($this->input->post('thn_akademik')),
                    'status' => (int)htmlspecialchars($this->input->post('status')),
                ),
                'config' =>
                array(
                    array(
                        'field' => 'thn_akademik',
                        'label' => 'Tahun Akademik',
                        'rules' => 'is_unique[tahun_akademik.thn_akademik]',
                        'errors' =>
                        [
                            'is_unique' => 'Tahun Akademik sudah tersedia!'
                        ]
                    ),
                    array(
                        'field' => 'status',
                        'label' => 'Status',
                        'rules' => 'required|trim',
                        'errors' =>
                        [
                            'required' => 'Status wajib diisi!'
                        ]
                    ),
                ),
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
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                        {$process['message']}
                                        </div>");                                
            }
            $response['success'] = true;
            $response['redirect'] = base_url('pages/datatahunakademik');

        } else {
            $response['errors'] = array('thn_akademik' => form_error('thn_akademik'), 'status' => form_error('status')
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function ubahDataTahunAkademik(){
        $response = $this->response;
        $this->setData(
            array(
                'table' => 'tahun_akademik',
                'where' => array('thn_akademik' => htmlspecialchars($this->input->post('thn_akademikold')),),
                'value' => 
                array(
                    'thn_akademik' => htmlspecialchars($this->input->post('thn_akademik')),
                    'status' => (int)htmlspecialchars($this->input->post('status')),
                ),
                'config' =>
                array(
                    array(
                        'field' => 'thn_akademik',
                        'label' => 'Tahun Akademik',
                        'rules' => 'required',
                        'errors' =>
                        [
                            'required' => 'Tahun Akademik wajib diisi!'
                        ]
                    ),
                    array(
                        'field' => 'status',
                        'label' => 'Status',
                        'rules' => 'required|trim',
                        'errors' =>
                        [
                            'required' => 'Status wajib diisi!'
                        ]
                    ),
                ),
            )
        );
        $data = $this->getData();

        $this->form_validation->set_rules($data['config']);
        if($this->form_validation->run() == true) {
            $existingData = $this->model->getDataModel($data['table'], ['thn_akademik' ,'status'], $data['where']);
            $CheckingSameData = $this->model->getDataModel($data['table'], ['thn_akademik'], $data['value']);
            if($existingData == $data['value']){
                $response['errors'] = array('status' => "Data harus berbeda saat ingin diubah!");       
            } else if(!(empty($CheckingSameData))){
                $response['errors'] = array('thn_akademik' => "Tahun akademik ini sudah tersedia di database!");       
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
                $response['redirect'] = base_url('pages/datatahunakademik');
            }

        } else {
            $response['errors'] = array('thn_akademik' => form_error('thn_akademik'), 'status' => form_error('status')
            );
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
                $this->model->getDataModel($data['table'], ['nama_petugas', 'password'], $data['value']);
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
                    $response['redirect'] = site_url('halamanadmin');
                }
            } else {
                $response['errors'] = array('nama' => form_error('nama'), 'password' => form_error('password'), 'confPassword' => form_error('confPassword'));
            }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function tambahDataTransaksi() {
        $this->setData(
            array(
                'table' => 'transactions',
                'value' => array(
                    'nipd' => $this->input->post('nipd'),
                    'nominal' => $this->input->post('nominal'),
                    'status' => $this->input->post('status'),
                    'keterangan' => $this->input->post('keterangan'),
                    'created_at' => $this->input->post('')
                )
            )
        );
    }

    public function cetakDataTransaksi(){
        $this->setData(
            array(
                'table' => 'transactions',
                'param' => array(
                    'nipd' => $this->input->post('nipd'),
                    'since' => $this->input->post('since'),
                    'to' => $this->input->post('till')
                ),
            )
        );
        $data = $this->getData();
        $process = $this->model->printDataModel($data['table'],['siswa.nama_siswa', 'kelas.kelas', 
        'kelas.instansi' ,'nominal', 'transactions.status', 'keterangan', 'created_at', 'transactions.thn_akademik'], $data['param']);
        if(count($process) == 0){
            $this->session->set_flashdata('message', 
            '<div class="alert alert-danger" role="alert">
                Data Transaksi Kosong!
            </div>');
            redirect('datatransaksi');
        } else {
            if($this->input->post('function') == 'cetak'){
                if($this->input->post('excel') == 'excel'){
                    $this->cetakExcel($process);
                } elseif($this->input->post('pdf') == 'pdf') {
                    $this->cetakPDF($process);
                }
            }
        }
    }

    public function hapusDataAdmin(){
        $this->setData(
            array(
                'table' => 'admin',
                'where' =>  array('kode_petugas' => $this->input->post('kode_petugas')),
                'value' => 
                array(
                    'status' => 0
                 ),
            )
        );
 
        $data = $this->getData();
        $response = $this->response;
        $process = $this->model->updateDataModel($data['table'],$data['value'], $data['where']);
        if($process['status'] == true){
            $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                    Data berhasil dihapus
                                    </div>");
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                    Data gagal dihapus
                                    </div>");
        }
        
        $response['success'] = true;
        $response['redirect'] = base_url('pages/dataadmin');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function restoreDataAdmin(){
        $this->setData(
            array(
                'table' => 'admin',
                'where' =>  array('kode_petugas' => $this->input->post('kode_petugas')),
                'value' => 
                array(
                    'status' => 1
                 ),
            )
        );
 
        $data = $this->getData();
        $response = $this->response;
        $process = $this->model->updateDataModel($data['table'],$data['value'], $data['where']);
        if($process['status'] == true){
            $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                    Data berhasil dipulihkan
                                    </div>");
        } else {
            $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                    Data gagal dipulihkan
                                    </div>");
        }
        
        $response['success'] = true;
        $response['redirect'] = base_url('pages/datanonaktifadmin');
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
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
            if($value['status'] == 1) {
                $value['status'] = "Ditunggu";
            } else if($value['status'] == 0) {
                $value['status'] = "Ditolak";
            } else {
                $value['status'] = "Diterima";
            }
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
        
        $pdf->SetFont('Arial', '', '11');
        $pdf->Cell(10, 10, "No", 1);
        $pdf->Cell(50, 10, "Nama Siswa", 1);
        $pdf->Cell(15, 10, "Kelas", 1);
        $pdf->Cell(37, 10, "Instansi", 1);
        $pdf->Cell(30, 10, "Tahun Akademik", 1);
        $pdf->Cell(25, 10, "Nominal", 1);
        $pdf->Cell(50, 10, "Keterangan", 1);
        $pdf->Cell(42, 10, "Tanggal Bayar", 1);
        $pdf->Cell(20, 10, "Status", 1);

        $no = 1;
        
        foreach ($data as $row) {
            if($row['status'] == 1) {
                $row['status'] = "Ditunggu";
            } else if($row['status'] == 0) {
                $row['status'] = "Ditolak";
            } else {
                $row['status'] = "Diterima";
            }
            $cellWidth = 50;
            $cellHeight = 10;
            if($pdf->GetStringWidth($row['nama_siswa']) < $cellWidth){
                $line = 1;
            } else {
                $textArray = array();
                $textLength = strlen($row['nama_siswa']);
                $errMargin = 10;
                $startChar = 0;
                $maxChar = 0;
                
                $tmpString = "";
                while($startChar < $textLength) {
                    while(($pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin)
                    && ($startChar + $maxChar) < $textLength) ){
                        $maxChar++;
                        $tmpString = substr($row['nama_siswa'], $startChar, $maxChar);
                    }
                    $startChar = $startChar + $maxChar;
                    array_push($textArray, $tmpString);
                    $maxChar = 0;
                    $tmpString = '';
                }
                $line = count($textArray);
            }

            $pdf->Ln();
            $pdf->SetFont('Arial', '', 11);
            $pdf->Cell(10, $line * $cellHeight, $no++, 1);
            
            $xPos = $pdf->GetX();
            $yPos = $pdf->GetY();
            
            $pdf->MultiCell($cellWidth, $cellHeight, $row['nama_siswa'], 1);
            $pdf->SetXY($xPos + $cellWidth, $yPos);

            $pdf->Cell(15,  $line * $cellHeight, $row['kelas'], 1);
            $pdf->Cell(37,  $line * $cellHeight, $row['instansi'], 1);
            $pdf->Cell(30,  $line * $cellHeight, $row['thn_akademik'], 1);
            $pdf->Cell(25,  $line * $cellHeight, $row['nominal'], 1);
            if($pdf->GetStringWidth($row['keterangan']) < $cellWidth){
                $pdf->Cell(50,  $line * $cellHeight, $row['keterangan'], 1);
            } else {
                $xPos = $pdf->GetX();
                $yPos = $pdf->GetY();
                
                $pdf->MultiCell($cellWidth, $cellHeight, $row['keterangan'], 1);
                $pdf->SetXY($xPos + $cellWidth, $yPos);
            }

            $pdf->Cell(42, $line * $cellHeight, $row['created_at'], 1);
            $pdf->Cell(20, $line * $cellHeight, $row['status'], 1);
        }
        $pdf->Output();
    }

    function cariDataTransaksi() {
        if($this->session->userdata('kode_petugas')) {
            
            $response = [];
            $keyword = $this->input->get('query');
            $tahunAkademik = $this->input->get('thn_akademik');
            //Ambil Data Siswa
            $dataSiswa = $this->model->getDataJoinModel('siswa', 'kelas' ,['nama_siswa', 'siswa.kelas', 'potongan', 'instansi', 'nipd', 'thn_akademik', 'siswa.status'], 
            ["kelas", "nipd"], ['siswa.nama_siswa' => $keyword, 'nipd' => $keyword]);
            
            if(is_null($dataSiswa)) {
                $response['errors'] = "Data tidak ditemukan!";
            } else {

                //Ambil Riwayat Data Transaksi Berdasarkan NIPD

                $dataTransaksi = $this->model->getDataModel('transactions', 
                ['nipd', 'nominal', 'status', 'image', 'keterangan', 'created_at'], ['nipd' => $dataSiswa['nipd'], 'thn_akademik' => $tahunAkademik]);

                //Ambil Jumlah Nominal dari tabel jenis_pembayaran Berdasarkan instansi
                $dataNominal = $this->model->getDataModel('jenis_pembayaran', ['biaya', 'jenis_pembayaran'], ['instansi' => $dataSiswa['instansi'], 'status' => 1]);

                //Ambil Jumlah Uang Masuk Berdasarkan NIPD
                $dataNominalMasuk = $this->db->select(['sum(nominal)'])
                    ->from('transactions')->join('siswa', "transactions.nipd = siswa.nipd")->join('tahun_akademik', "tahun_akademik.thn_akademik = siswa.thn_akademik")
                    ->where(['transactions.status' => 2, 'siswa.nipd' => $dataSiswa['nipd'], 'siswa.status' => 1, 'transactions.thn_akademik' => $tahunAkademik,])
                    ->get()
                    ->result_array();
                $totalBiaya = 0;
                if(empty($dataNominal)){
                    $response['biaya'] = 0;
                } else {
                    foreach ($dataNominal as $biaya) {
                        # code...
                        $totalBiaya += $biaya['biaya'];
                    }
                    $response['biaya'] = $totalBiaya;
    
                }
                $response['dataNominal'] = $dataNominal;
                if(is_null($dataNominalMasuk[0]['sum(nominal)'])){
                    $response['dataNominalMasuk'] = 0;
                } else {
                    $response['dataNominalMasuk'] = $dataNominalMasuk[0]['sum(nominal)'];
                }

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
            }
            header('Content-Type: application/json');
            echo json_encode($response);
            
        } else {
            exit();
        }
		
    }
    function validasiPembayaran() {
        $response = [];
        $this->setData(
            array(
                'table' => 'transactions',
                'where' => array('created_at' => $this->input->post('created_at')),
                'value' => array('status' => $this->input->post('status'),
                                'updated_at' => date('Y-m-d H:i:s'))
            )
        );
        $data = $this->getData();
        $process = $this->model->updateDataModel($data['table'], $data['value'] ,$data['where']);
        if($process['status'] == true) {
            $jumlahNominal = $this->model->getDataModel($data['table'], ['sum(nominal)'], ['status' => 2,
            'nipd' => $this->input->post('nipd'), 'thn_akademik' => $this->input->post('thn_akademik')]);
            $response['success'] = true;
            $response['value'] = array($data['value']['status'], $data['where']['created_at'], $jumlahNominal[0]['sum(nominal)']);
        }
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
?>
