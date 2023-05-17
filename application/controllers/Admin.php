<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'controllers/User.php';

class Admin extends User {

    //Overriding parent method
    public function login($data = null) {
        $this->setData(
            array(
                'table' => 'admin',
                'selectedData' => array('kode_petugas', 'nama_petugas', 'password'),
                'value' =>  array(
                            'kode_petugas' => htmlspecialchars($this->input->post('id')),
                            'password' => $this->input->post('password')
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
                if(password_verify($data['value']['password'], $process['password'])){
                    $this->session->set_userdata('name', array('nama_petugas' => $process['nama_petugas']));
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
            $process = $this->model->insertDataModel('admin', $data['value']);
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
        $response = [];
        $this->setData(
            array(
                'table' => 'biaya',
                'value' => 
                array(
                    'instansi' => htmlspecialchars($this->input->post('instansi')),
                    'biaya' => htmlspecialchars($this->input->post('biaya'))
                ),
                'config' =>
                array(
                     array(
                            'field' => 'instansi',
                            'label' => 'Instansi',
                            'rules' => 'required|trim|is_unique[biaya.instansi]',
                            'errors' =>
                            [
                                'required' => 'Instansi wajib diisi!',
                                'is_unique' => 'Instansi sudah tersedia!'
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
        $data = $this->getData();
        $this->form_validation->set_rules($data['config']);
        if($this->form_validation->run() == true) {
            $process = $this->model->insertDataModel('biaya', $data['value']);
            if($process['status'] == true){
                $response = array(
                    'success' => true,
                    'redirect' => site_url('databiaya'),
                );
                $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                        {$process['message']}
                                        </div>");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                        {$process['message']}
                                        </div>");
            }
        } else {
            $response = array(
                'success' => false,
                'errors' => array('instansi' => form_error('instansi'), 'biaya' => form_error('biaya')),
            );
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit();
    }

    public function ubahDataBiaya(){
         $this->setData(
            array(
                'table' => 'biaya',
                'where' =>  array('instansi', $this->input->post('instansi')),
                'value' => 
                array(
                    'biaya' => htmlspecialchars($this->input->post('biaya'))
                ),
                'config' =>
                array(
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
        $data = $this->getData();
        $response = [];
        $this->form_validation->set_rules($data['config']);
        if($this->form_validation->run() == true) {
            $process = $this->model->updateDataModel($data['table'],$data['value'], $data['where']);
           if($process['status'] == true){
                $response = array(
                    'success' => true,
                    'redirect' => site_url('databiaya'),
                );
                $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                        {$process['message']}
                                        </div>");
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                        {$process['message']}
                                        </div>");
            }
        } else {
            $response = array(
                'success' => false,
                'errors' => array('biaya' => form_error('biaya')),
            );
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
        } else {
        }
        redirect('datakelas');
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
                        'label' => 'NIPD',
                        'rules' => 'required|trim|is_unique[siswa.nipd]',
                        'errors' =>
                        [
                            'required' => 'NIPD wajib diisi!',
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
        $data = $this->getData();
        $this->form_validation->set_rules($data['config']);
        if($this->form_validation->run() == true) {
            if($data['value']['potongan'] == 0){
                $data['value']['potongan'] = 0;
            }
            $process = $this->model->insertDataModel($data['table'], $data['value']);

            if($process['status'] == true){
                $this->session->set_flashdata("message", "<div class='alert alert-success' role='alert'>
                                        {$process['message']}
                                        </div>");
                redirect('datasiswa');
            } else {
                $this->session->set_flashdata("message", "<div class='alert alert-danger' role='alert'>
                                        {$process['message']}
                                        </div>");
                redirect('datasiswa');
            }
        } else {
             $errors = validation_errors();
             echo json_encode(['error' => $errors]);
        }
    }
}
?>