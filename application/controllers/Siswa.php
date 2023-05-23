<?php 
// header("Content-Type: application/json; charset=utf-8");

// require APPPATH . 'controller/User.php';

// class Siswa extends Admin {

//     public function __construct()
//     {
//         parent::__construct();
//         error_reporting(0);
//         $this->load->helper('url');
//     }

//     public function login($data = null)
//     {
//         $this->setData(
//             array(
//                 'table' => 'siswa',
//                 'selectedData' => array('nipd', 'password'),
//                 'value' => array(
//                         'nipd' => $this->input->post('nipd'),
//                         'password' => $this->input->post('password')
//                 ),
//             )
//         );
//         $data = $this->getData();
//         $process = parent::login($data);
//         if (is_null($process)) {
//             $response = array(
//                 'error' => 'NIPD tidak tersedia'
//             );
//             $this->output->set_status_header(401)->set_content_type('application/json')->set_output(json_encode($response));
//         } else {
//             if(password_verify($data['value']['password'], $process['password'])){
//                 $this->output->set_content_type('application/json')->set_output(json_encode($process));
//             } else {
//                 $response = array(
//                     'error' => 'Password tidak sesuai'
//                 );
//                 $this->output->set_status_header(401)->set_content_type('application/json')->set_output(json_encode($response));
//             }
//         }
//     }

//     public function getFee(){
        
//     }

// }

?>