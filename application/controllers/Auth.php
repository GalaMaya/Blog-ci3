<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        $token = $this->session->userdata('token');
        if ($token) {
            redirect('dashboard');
        }
        $this->load->view('login');
    }

    public function login()
    {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
  
      // Endpoint API login (ubah sesuai endpoint-mu)
      $apiUrl = 'http://localhost/Blogs-CI3/api-v1/login';
  
      // Setup CURL
      $ch = curl_init($apiUrl);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
        'email' => $email,
        'password' => $password,
      ]));
      curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded',
      ]);
  
      $response = curl_exec($ch);
      $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      curl_close($ch);
  
      $result = json_decode($response, true);

      if ($httpcode == 200 && isset($result['token'])) {


        $users = array(
            'id' => $result['id'],
            'name' => $result['name'],
            'email' => $result['email'],
            'role' => $result['role'],
        );

      
        $this->session->set_userdata([
          'token' => $result['token'],
          'user'  => $users, 
          'logged_in' => true
        ]);
  
        redirect('dashboard');
      } else {
        $error = isset($result['message']) ? $result['message'] : 'Login gagal.';
        $this->session->set_flashdata('error', $error);
        redirect('auth');
      }
    }
  
    public function logout()
    {
      $this->session->sess_destroy();
      redirect('auth');
    }
}
