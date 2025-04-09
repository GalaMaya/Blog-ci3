<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Jwt
{
    private $key;

    public function __construct()
    {
        $this->key = 'rahasia';
    }

    public function encode($data)
    {
        return JWT::encode($data, $this->key, 'HS256');
    }

    public function decode($token)
    {
        return JWT::decode($token, $this->key, ['HS256']);
    }
}
