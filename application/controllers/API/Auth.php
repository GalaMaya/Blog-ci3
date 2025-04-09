<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Load model, helper, dll kalau perlu
    }

    public function login() {
        echo json_encode(['status' => 'success', 'message' => 'Login OK']);
    }
}
