<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(){

        $token = $this->session->userdata('token');
        if (!$token) {
            redirect('auth/login');
        }
        
        $this->load->view('dashboard/home');
    }
}