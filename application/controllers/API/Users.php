<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('AuthMiddleware');
        $this->authmiddleware->verify();
        $this->load->model('users_model');
        header('Content-Type: application/json');
    }

    public function add()
    {

        $this->authmiddleware->verify([1]);

        if ($this->input->method(true) !== 'POST') {
            show_error('Method Not Allowed', 405);
        }

        try {
            $input = json_decode(file_get_contents("php://input"), true);

            if (!is_array($input)) {
                $input = [];
            }

            $this->form_validation->set_data($input);

            $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('password', 'password', 'required|min_length[8]');
            $this->form_validation->set_rules('name', 'name', 'required');
            $this->form_validation->set_rules('role_id', 'role', 'required|integer');

            if ($this->form_validation->run() === FALSE) {
                throw new Exception(json_encode(validation_errors_array()), 422);
            }

            // Simpan data
            $data = [
                'email' => $input['email'],
                'password' => password_hash($input['password'], PASSWORD_BCRYPT),
                'name' => $input['name'],
                'role_id' => $input['role_id'],
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ];

            $user_id = $this->users_model->insert($data);

            json_response([
                'status' => true,
                'message' => 'User berhasil dibuat',
            ]);
        } catch (Exception $e) {
            http_response_code($e->getCode() ?: 500);

            $errorMessage = json_decode($e->getMessage(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $errorMessage = ['general' => strip_tags($e->getMessage())];
            }

            json_response([
                'status' => false,
                'errors' => $errorMessage
            ]);
        }
    }

    public function get()
    {

        $this->authmiddleware->verify([1, 2]);

        if ($this->input->method(true) !== 'GET') {
            show_error('Method Not Allowed', 405);
        }

        try {
            $user = $this->users_model->get_users();

            json_response([
                'status' => true,
                'data' => $user
            ]);
        } catch (Exception $e) {
            http_response_code($e->getCode() ?: 500);

            $errorMessage = json_decode($e->getMessage(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $errorMessage = ['general' => strip_tags($e->getMessage())];
            }

            json_response([
                'status' => false,
                'errors' => $errorMessage
            ]);
        }
    }

    public function update($id)
    {

        $this->authmiddleware->verify([1]);

        if ($this->input->method(true) !== 'PUT') {
            show_error('Method Not Allowed', 405);
        }

        try {
            $_PUT = json_decode(file_get_contents("php://input"), true);
            $_POST = $_PUT; // untuk form_validation

            $this->form_validation->set_data($_POST);
            $this->form_validation->set_rules('name', 'Nama', 'required');
            $this->form_validation->set_rules('role_id', 'Role ID', 'required|integer');
            $this->form_validation->set_rules('status', 'Status', 'required');

            if ($this->form_validation->run() === FALSE) {
                throw new Exception(json_encode($this->form_validation->error_array()), 422);
            }

            $user = $this->users_model->get_user_by_id($id);
            if (!$user) {
                throw new Exception(json_encode(['general' => 'User tidak ditemukan']), 404);
            }

            $data = [
                'name' => $_POST['name'],
                'role_id' => $_POST['role_id'],
                'status' => $_POST['status']
            ];

            $updated = $this->users_model->update_user($id, $data);
            if (!$updated) {
                throw new Exception(json_encode(['general' => 'Gagal update user']), 500);
            }

            json_response([
                'status' => true,
                'message' => 'User berhasil diupdate'
            ]);
        } catch (Exception $e) {
            http_response_code($e->getCode() ?: 500);

            $errorMessage = json_decode($e->getMessage(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $errorMessage = ['general' => strip_tags($e->getMessage())];
            }

            json_response([
                'status' => false,
                'errors' => $errorMessage
            ]);
        }
    }

    public function delete($id)
    {

        $this->authmiddleware->verify([1]);

        if ($this->input->method(true) !== 'DELETE') {
            show_error('Method Not Allowed', 405);
        }

        try {
            // Pastikan ID valid
            if (!is_numeric($id) || $id <= 0) {
                throw new Exception(json_encode(['general' => 'ID tidak valid']), 422);
            }

            // Cek apakah user ada
            $user = $this->users_model->get_user_by_id($id);
            if (!$user) {
                throw new Exception(json_encode(['general' => 'User tidak ditemukan']), 404);
            }

            // Hapus user
            $deleted = $this->users_model->delete_user($id);
            if (!$deleted) {
                throw new Exception(json_encode(['general' => 'Gagal menghapus user']), 500);
            }

            json_response([
                'status' => true,
                'message' => 'User berhasil dihapus'
            ]);
        } catch (Exception $e) {
            http_response_code($e->getCode() ?: 500);

            $errorMessage = json_decode($e->getMessage(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $errorMessage = ['general' => strip_tags($e->getMessage())];
            }

            json_response([
                'status' => false,
                'errors' => $errorMessage
            ]);
        }
    }
}
