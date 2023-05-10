<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'controllers/User.php';

class Admin extends User {

    public function login($data = null) {
        $this->setData(
            array(
                'table' => 'admin',
                'selectedData' => array('kode_petugas', 'nama_petugas', 'password'),
                'value' =>  array(
                            'id' => htmlspecialchars($this->input->post('id')),
                            'password' => $this->input->post('password')
                            ),
                'config' => array(
                                array(
                                    'field' => 'id',
                                    'label' => 'ID',
                                    'rules' => 'required|trim|min_length[5]',
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
            $process = parent::login($data);
            if(is_null($process)){
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                        Akun ini tidak terdaftar
                                        </div>');
                redirect('login');
            } else {
                if(password_verify($data['value']['password'], $process['password'])){
                    $this->session->set_userdata('name', $process['nama_petugas']);
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
                                    'rules' => 'required|trim|min_length[5]',
                                    [
                                        'required' => 'ID wajib diisi!'
                                    ]
                                ),
                                array(
                                    'field' => 'nama',
                                    'label' => 'Nama',
                                    'rules' => 'required|trim',
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

        $this->form_validation->set_rules($this->getData()['config']);
        if($this->form_validation->run() == true) {
            $this->db->insert('admin', $this->getData()['value']);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                                    Registrasi telah berhasil! Silakan Login
                                    </div>');
            redirect('login');
        } else {
            $this->load->view('registrasi');
        }
    }
}
?>