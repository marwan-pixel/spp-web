<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// session_start();

class Auth extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('session');
    }

    public function login(){

        $config = array(
                    array(
                        'field' => 'id',
                        'label' => 'ID',
                        'rules' => 'required|trim|min_length[5]',
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
                );
        $this->form_validation->set_rules($config);
		if($this->form_validation->run() == true) {
            $data = array(
                        'kode_petugas' => htmlspecialchars($this->input->post('id')),
                        'password' => $this->input->post('password')
                    );
            $this->_login($data);
        } else {
            $this->load->view('login');
        }
	}

    public function registrasi(){
        $config = array(
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
                );
        $this->form_validation->set_rules($config);
        if($this->form_validation->run() == true) {
            $data = array(
                        'kode_petugas' => htmlspecialchars($this->input->post('id')),
                        'nama_petugas' => htmlspecialchars($this->input->post('nama')),
                        'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
                    );
            $this->db->insert('admin', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                                    Registrasi telah berhasil! Silakan Login
                                    </div>');
            redirect('login');
        } else {
            $this->load->view('registrasi');
        }
    }

    private function _login($data) {
        $user = $this->db->get_where('admin', ['kode_petugas' => $data['kode_petugas']])->row_array();
        if(is_null($user)){
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                    Akun belum terdaftar
                                    </div>');
            redirect('login');
        } else {
            if(password_verify($data['password'], $user['password'])){
                $this->session->set_userdata('name', $user['nama_petugas']);
                redirect('/');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                                    Password tidak sesuai
                                    </div>');
                redirect('login');
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('name');
        redirect('login');
    }
}