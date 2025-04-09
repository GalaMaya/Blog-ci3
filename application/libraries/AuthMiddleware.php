<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware
{
    private $CI;
    private $key = 'rahasia';

    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function verify($required_roles = [])
    {
        $headers = $this->CI->input->request_headers();
        $token = isset($headers['Authorization']) ? $headers['Authorization'] : null;

        if (!$token) {
            return $this->unauthorized('Unauthorized. No token provided.');
        }

        try {
            $jwt = str_replace('Bearer ', '', $token);
            $decoded = JWT::decode($jwt, new Key($this->key, 'HS256'));

           
            $this->CI->auth_user = $decoded;

            
            if (!empty($required_roles) && !in_array((int) $decoded->role, $required_roles)) {
                return $this->forbidden('Access denied. Insufficient permissions.');
            }

        } catch (Exception $e) {
            return $this->unauthorized('Unauthorized. Token invalid: ' . $e->getMessage());
        }
    }

    private function unauthorized($message)
    {
        header('Content-Type: application/json');
        http_response_code(401);
        echo json_encode([
            'status' => false,
            'message' => $message
        ]);
        exit;
    }

    private function forbidden($message)
    {
        header('Content-Type: application/json');
        http_response_code(403);
        echo json_encode([
            'status' => false,
            'message' => $message
        ]);
        exit;
    }
}
