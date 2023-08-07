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
                'selectedData' => array('kode_petugas', 'nama_petugas', 'password', 'status'),
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
                if(password_verify($this->input->post('password'), $process['password'])){
                    $this->session->set_userdata('kode_petugas', $process['kode_petugas']);
                    redirect('/');
                } else if($process['status'] == 0){
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Akun ini sudah tidak aktif!
                    </div>');
                    $this->load->view('login');
                }
                else {
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
                                        'rules' => 'required|trim|min_length[8]',
                                        'errors' =>
                                        [
                                            'required' => 'Password wajib diisi!',
                                            'min_length' => 'Password minimal terdiri dari delapan karakter'
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
        $data = array();
        header('Content-Type: application/json');
        $response = $this->response;
        if(isset($_FILES['fileExcel']['name'])){
            $file_extension = pathinfo($_FILES['fileExcel']['name'], PATHINFO_EXTENSION);
            if($file_extension == 'csv' || $file_extension == 'xls' || $file_extension == 'xlsx') {
                $path = $_FILES['fileExcel']['tmp_name'];
                
                $spreadsheet = IOFactory::load($path);
                $errors = [];
                // $sheetCount = $spreadsheet->getSheetCount();
                foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
                    $uniqueValues = [];
                    $highestRow = $worksheet->getHighestRow();
                    if($highestRow > 250){
                        $response['errors'] = array('fileExcel' => "Data yang dikirim haruslah maksimal sebanyak 250 baris!");
                    } else {
                        for ($row = 2; $row <= $highestRow; $row++) {
                            
                            $nipd = $worksheet->getCell('A' . $row)->getValue();
                            $nama_siswa = $worksheet->getCell('B' . $row)->getValue();
                            $kelas = $worksheet->getCell('C' . $row)->getValue();
                            $thn_akademik = $worksheet->getCell('D' . $row)->getValue();
                            $password = $worksheet->getCell('E' . $row)->getValue();
                            $potongan = $worksheet->getCell('F' . $row)->getValue();

                            
                            if($nipd === null && $nama_siswa === null && $kelas === null && $thn_akademik === null && $password === null) {
                                if ($row === $highestRow) {
                                    // Last row, stop processing
                                    break;
                                } else {
                                    // Not the last row, bypass to the next row
                                    continue;
                                }
                            }
                            if(in_array($nipd, $uniqueValues)){
                                $errors = array('fileExcel' => "Terdapat duplikasi pada NIPD $nipd di Excel!");
                                break;
                            } else {
                                $uniqueValues[] = $nipd;
                            }
                            if($nipd === null || $nama_siswa === null || $kelas === null || $thn_akademik === null || $password === null) {
                                $errors = array('fileExcel' => "Data NIPD, nama siswa, kelas, tahun akademik, dan password tidak boleh kosong!");
                            } 
                            else {
                                $existingData = array(
                                    'siswa' => $this->model->getDataModel('siswa', ['nipd'], ['nipd' => $nipd]),
                                    'kelas' => $this->model->getDataModel('kelas', ['kelas'], ['kelas' => $kelas]),
                                    'tahun_akademik' => $this->model->getDataModel('tahun_akademik', ['thn_akademik'], ['thn_akademik' => $thn_akademik]),
                                );
                                if(empty($existingData['kelas'])){
                                    $errors = array('fileExcel' => "Kelas ". $kelas . " tidak tersedia di tabel Kelas! Tambahkan terlebih dahulu di Data Kelas!");
                                } else if(empty($existingData['tahun_akademik'])){
                                    $errors = array('fileExcel' => "Tahun Akademik " . $thn_akademik . " tidak tersedia di tabel Tahun Akademik! Tambahkan terlebih dahulu di Data Tahun Akademik!");
                                } else if(!empty($existingData['siswa'])){
                                    $errors = array('fileExcel' => "NIPD " . $nipd . " sudah tersedia di Database!");
                                }                 
                            }
                        }
                    }
                }
                if(!empty($errors)){
                    $response['errors'] = $errors;
                } else {
                    foreach ($spreadsheet->getWorksheetIterator() as $worksheet) {
                        for ($row = 2; $row <= $highestRow; $row++) {
                            
                            $nipd = $worksheet->getCell('A' . $row)->getValue();
                            $nama_siswa = $worksheet->getCell('B' . $row)->getValue();
                            $kelas = $worksheet->getCell('C' . $row)->getValue();
                            $thn_akademik = $worksheet->getCell('D' . $row)->getValue();
                            $password = $worksheet->getCell('E' . $row)->getValue();
                            $potongan = $worksheet->getCell('F' . $row)->getValue();
                            
                            if($nipd === null && $nama_siswa === null && $kelas === null && $thn_akademik === null && $password === null) {
                                if ($row === $highestRow) {
                                    // Last row, stop processing
                                    break;
                                } else {
                                    // Not the last row, bypass to the next row
                                    continue;
                                }
                            }

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
                        }
                    }
                    $response['success'] = true;
                    $response['redirect'] = base_url('pages/datasiswa');
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
                    'status' => htmlspecialchars($this->input->post('status')),
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
                ),
            )
        );
        $data = $this->getData();
        if(!empty($this->input->post('status'))){
            $data['value']['status'] = (int)htmlspecialchars($this->input->post('status'));
            $this->form_validation->set_rules('status','Status','required|trim', array('required' => 'Status wajib diisi!'));
        } else {
            $data['value']['status'] = 0;
        }
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
                'where' =>  array('kode_petugas' => $this->input->post('kode_petugas_old')),
                'value' => 
                array(
                    'kode_petugas' => htmlspecialchars($this->input->post('kode_petugas')),
                    'nama_petugas' => htmlspecialchars($this->input->post('nama')),
                    ),
                'config' =>
                array(
                        array(
                            'field' => 'kode_petugas',
                            'label' => 'Kode Petugas',
                            'rules' => 'required|trim',
                            'errors' =>
                            [
                                'required' => 'Kode petugas wajib diisi!'
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
                    )
                )
            );
            $response = $this->response;
            $data = $this->getData();
            $existingData = $this->model->getDataModel($data['table'], ['kode_petugas', 'nama_petugas'], $data['value'], array: 0);

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
                        $this->session->set_userdata('kode_petugas', $data['value']['kode_petugas']);
                    } else {
                        $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                                {$process['message']}
                                                </div>");
                    }
                    $response['success'] = true;
                    $response['redirect'] = site_url('halamanadmin');
                }
            } else {
                $response['errors'] = array('nama' => form_error('nama'), 'kode_petugas' => form_error('kode_petugas'), 'password' => form_error('password'), 'confPassword' => form_error('confPassword'));
            }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function tambahDataTransaksi() {
        $response = $this->response;
        $bulanRentangAwal = $this->input->post('bulanAwalPembayaran');
        $bulanRentangAkhir = $this->input->post('bulanAkhirPembayaran');
        $nipd = $this->input->post('nipdInsert');
        $keterangan = $this->input->post('keteranganInsert');
        $nominalMasuk = (int)$this->input->post('nominalInsert');
        $thn_akademik = $this->input->post('thn_akademikInsert');

        $errors = [];
        if(empty($bulanRentangAwal) || empty($bulanRentangAkhir) || $nominalMasuk < 1 || empty($keterangan)){
            $response['errors'] = array(
                'bulanAwalPembayaran' => 'Rentang awal tanggal wajib diisi!', 
                'bulanAkhirPembayaran' => 'Rentang akhir tanggal wajib diisi!', 
                'nominalInsert' => 'Nominal tidak boleh kosong atau kurang dari 1!',
                'keteranganInsert' => 'Keterangan tidak boleh kosong!');
        } else {
            list($tahunAwal, $tahunAkhir) = explode("/", $thn_akademik);
            $dateStart = new DateTime($tahunAwal . '-' .$bulanRentangAwal . '-01');
            $dateEnd = new DateTime($tahunAkhir . '-' . $bulanRentangAkhir . '-01');
            $monthDiff = date_diff($dateStart, $dateEnd)->format('%m')+1;
            
            $dataInstansi = $this->model->getDataJoinModel(table: ['siswa', 'kelas'], data: ['kelas.instansi', 'siswa.potongan'], 
            column: ["kelas"], keyword: ["nipd" => $nipd]);
            $dataBiaya = $this->model->getDataModel('jenis_pembayaran', ['sum(biaya)'], ['instansi' => $dataInstansi['instansi']]);
            
            $dataBiaya = $dataBiaya[0]['sum(biaya)'] - $dataInstansi['potongan'];

            if($dateEnd < $dateStart) {
                $response['errors'] = array('bulanAkhirPembayaran' => 'Rentang akhir tanggal tidak bisa lebih dulu dari rentang awal!');
            } elseif($nominalMasuk > ($dataBiaya * 12)){
                $response['errors'] = array('nominalInsert' => 'Nominal ini terlalu besar dari total biaya yang ada!');
            } elseif($nominalMasuk > ($dataBiaya * $monthDiff)){
                $response['errors'] = array('nominalInsert' => "Nominal $nominalMasuk terlalu besar jika hanya untuk $monthDiff bulan saja!");
            } else {
                $this->setData(
                    array(
                        'table' => 'transactions',
                        'value' => array(
                            'nipd' => $nipd,
                            'thn_akademik' => $thn_akademik,
                            'nominal' => null,
                            'bulan'=> '',
                            'status' => 2,
                            'image' => '',
                            'keterangan' => $keterangan,
                            'created_at' => date('Y-m-d H:i:s')
                        )
                    )
                );
                $data = $this->getData();
                if ($dateStart->format('m') >= '01' && $dateStart->format('m') <= '06') {
                    $tahunAwal++;
                    $dateStart->setDate($tahunAwal, $dateStart->format('m'), $dateStart->format('d'));
                }
                while($dateStart <= $dateEnd) {

                    $bulanRentangAwalStr = $dateStart->format('Y-m-d');
                    $data['value']['nominal'] = min($nominalMasuk, $dataBiaya);
                    $data['value']['image'] = 'Bayar Langsung';
                    $data['value']['bulan'] = $bulanRentangAwalStr;
                    if ($nominalMasuk <= 0) {
                        break;
                    }
                    $transaksiBulanIni = $this->model->getDataModel('transactions', ['nipd', 'thn_akademik', 'nominal', 'bulan', 'status', 'keterangan', 'created_at'], 
                    ['bulan' => $bulanRentangAwalStr, 'nipd' => $nipd, 'status' => 2, 'thn_akademik' => $data['value']['thn_akademik']]);
                    $nominalTransaksiBulanIni = $this->model->getDataModel('transactions', ['sum(nominal)'], 
                    ['bulan' => $bulanRentangAwalStr, 'nipd' => $nipd, 'status' => 2, 'thn_akademik' => $data['value']['thn_akademik']]);
                    
                    if(empty($transaksiBulanIni)) {
                        $process = $this->model->insertDataModel($data['table'], $data['value']);
                        if($process['status'] == true){
                            $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                            Pembayaran Berhasil!
                            </div>");
                        } else {
                            $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                            Pembayaran Gagal!
                            </div>");
                        }
                        $nominalMasuk -= $dataBiaya;
                    } else {
                        if ($nominalMasuk <= 0) {
                            break;
                        }
                        $totalNominalTransaksi = $this->model->getDataModel('transactions', ['sum(nominal)'], 
                        ['nipd' => $nipd, 'status' => 2, 'thn_akademik' => $data['value']['thn_akademik']]);
                        $nominalTransaksiBulanTerakhir = $this->model->getDataModel('transactions', ['sum(nominal)'], 
                        ['bulan' => (new DateTime())->setDate((new DateTime())->format('Y'), 6, 1)->format('Y-m-d'), 'nipd' => $nipd, 'status' => 2, 'thn_akademik' => $data['value']['thn_akademik']]);
                        $totalNominal = $totalNominalTransaksi[0]['sum(nominal)'];
                        $nominalBulanIni = $nominalTransaksiBulanIni[0]['sum(nominal)'];
                        if(!empty($totalNominalTransaksi) && ($totalNominal + $nominalMasuk) > ($dataBiaya * 12)){
                            $errors = array('nominalInsert' => "Total nominal sekarang ($totalNominal) dan nominal masuk
                            ($nominalMasuk) melebihi total biaya!");
                            break;
                        } else if(($nominalTransaksiBulanIni[0]['sum(nominal)'] < $dataBiaya) && (($nominalTransaksiBulanIni[0]['sum(nominal)'] + $nominalMasuk) > $dataBiaya)) {
                            $errors = array('nominalInsert' => "Nominal masuk bulan ini ($nominalBulanIni) dan nominal masuk
                            ($nominalMasuk) melebihi total biaya $dataBiaya!");
                            break;
                        }
                        if($nominalTransaksiBulanIni[0]['sum(nominal)'] >= $dataBiaya){
                            $errors = array('nominalInsert' => 'Nominal pada bulan yang dituju ada yang sudah lunas!');
                            break;
                        } 
                        else {
                            if(!empty($nominalTransaksiBulanTerakhir)) {
                                $sisaPembayaranBulanTerakhir = $dataBiaya - $nominalTransaksiBulanTerakhir[0]['sum(nominal)'];
                                if($nominalMasuk > $sisaPembayaranBulanTerakhir) {
                                    $errors = array('nominalInsert' => 'Nominal melebihi sisa pembayaran di bulan terakhir!');
                                    break;
                                }
                            } 
                            $data['value'] = $transaksiBulanIni[0];
                            $sisaBiayaBulanIni = $dataBiaya - $data['value']['nominal'];
                            $nominalTambah = min($nominalMasuk, $sisaBiayaBulanIni);
                            $data['value']['nominal'] = $nominalTambah;
                            $data['value']['image'] = 'Bayar Langsung';
                            $data['value']['created_at'] = date('Y-m-d H:i:s');
                            $process = $this->model->insertDataModel($data['table'], $data['value']);
                            if($process['status'] == true){
                                $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                Pembayaran Berhasil!
                                </div>");
                            } else {
                                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                Pembayaran Gagal!
                                </div>");                                
                            }
                            $nominalMasuk -= $sisaBiayaBulanIni;
                        }
                    }
                   
                    $dateStart->modify('+1 month');
                    if ($dateStart->format('m') === '01') {
                        $tahunAwal++;
                        $dateStart->setDate($tahunAwal, $dateStart->format('m'), $dateStart->format('d'));
                    }
                }
                if(!empty($errors)){
                    $response['errors'] = $errors;
                } else {
                    $response['success'] = true;
                    $response['redirect'] = base_url("pages/datatransaksi?nipd=$nipd");
            
                }
            }
        }
        echo json_encode($response);
        header('Content-Type: application/json');
        exit();
    
    }

    public function cetakDataTransaksi(){
        $this->setData(
            array(
                'table' => 'transactions',
                'param' => array(
                    'nipd' => $this->input->post('nipd'),
                    'since' => $this->input->post('since'),
                    'to' => $this->input->post('till'),
                    'status' => 2
                ),
            )
        );
        $data = $this->getData();
        $process = $this->model->printDataModel($data['table'],['siswa.nama_siswa', 'kelas.kelas', 
        'kelas.instansi' ,'nominal', 'keterangan', 'created_at'], $data['param']);
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
        $pdf->Cell(12, 10, "No", 1);
        $pdf->Cell(53, 10, "Nama Siswa", 1);
        $pdf->Cell(18, 10, "Kelas", 1);
        $pdf->Cell(45, 10, "Instansi", 1);
        $pdf->Cell(40, 10, "Nominal", 1);
        $pdf->Cell(53, 10, "Keterangan", 1);
        $pdf->Cell(42, 10, "Tanggal Bayar", 1);

        $no = 1;
        
        foreach ($data as $row) {

            $cellWidth = 53;
            $cellHeight = 10;
            if($pdf->GetStringWidth($row['nama_siswa']) < $cellWidth ){
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

            if($pdf->GetStringWidth($row['keterangan']) > $cellWidth) {
                $textArray = array();
                $textLength = strlen($row['keterangan']);
                $errMargin = 10;
                $startChar = 0;
                $maxChar = 0;
                
                $tmpString = "";
                while($startChar < $textLength) {
                    while(($pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin)
                    && ($startChar + $maxChar) < $textLength) ){
                        $maxChar++;
                        $tmpString = substr($row['keterangan'], $startChar, $maxChar);
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
            $pdf->Cell(12, $line * $cellHeight, $no++, 1);
            
            if($pdf->GetStringWidth($row['nama_siswa']) < $cellWidth){
                $pdf->Cell(53,  $line * $cellHeight, $row['nama_siswa'], 1);
            } else {
                $xPos = $pdf->GetX();
                $yPos = $pdf->GetY();
                
                $pdf->MultiCell($cellWidth, $cellHeight, $row['nama_siswa'], 1);
                $pdf->SetXY($xPos + $cellWidth, $yPos);
            }

            $pdf->Cell(18,  $line * $cellHeight, $row['kelas'], 1);
            $pdf->Cell(45,  $line * $cellHeight, $row['instansi'], 1);
            $pdf->Cell(40,  $line * $cellHeight, "Rp " . number_format($row['nominal'],2,',','.'), 1);

            if($pdf->GetStringWidth($row['keterangan']) < $cellWidth){
                $pdf->Cell(53,  $line * $cellHeight, $row['keterangan'], 1);
            } else {
                $xPos = $pdf->GetX();
                $yPos = $pdf->GetY();
                
                $pdf->MultiCell($cellWidth, $cellHeight, $row['keterangan'], 1);
                $pdf->SetXY($xPos + $cellWidth, $yPos);
            }

            $pdf->Cell(42, $line * $cellHeight, $row['created_at'], 1);
        }
        $pdf->Output();
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
