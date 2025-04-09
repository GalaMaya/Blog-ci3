<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->helper('security');
    }

    public function login()
    {
        header('Content-Type: application/json');

        $email = $this->input->post('email', TRUE);
        $password = $this->input->post('password', TRUE);

        if (!$email || !$password) {
            http_response_code(400);
            echo json_encode(['status' => false, 'message' => 'Email dan password wajib diisi']);
            return;
        }

        $user = $this->users_model->getByEmail($email);

        if ($user && password_verify($password, $user->password)) {
            $payload = [
                'iss' => 'localhost',          // Issuer
                'iat' => time(),               // Issued at
                'exp' => time() + (60 * 60),   // Expiration (1 hour)
                'uid' => $user->id,
                'role' => $user->role_id,
                'email' => $user->email
            ];

         
            $jwt = JWT::encode($payload, 'rahasia', 'HS256');
    
            json_response([
                'status' => true,
                'token' => $jwt
            ], 200);
        } else {
            json_response([
                'status' => false,
                'message' => 'Email or password is incorrect'
            ], 401);
        }
    }
}
