<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $role = $this->session->userdata('user')['role'];

        if (!in_array($role, ['1'])) {
            redirect('dashboard');
            exit;
        }

        $url = "http://localhost/Blogs-CI3/api-v1/user";

        $token = $this->session->userdata('token');
        if (!$token) {
            redirect('auth/login');
        }

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: ' . $token,
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        $users = json_decode($response, true);

        $data['users'] = $users['data'];


        $this->load->view('dashboard/users/index', $data);
    }

    public function add()
    {

        $role = $this->session->userdata('user')['role'];

        if (!in_array($role, ['1'])) {
            redirect('dashboard');
            exit;
        }
        $this->load->view('dashboard/users/add');
    }

    public function save()
    {

        $url = "http://localhost/Blogs-CI3/api-v1/user";

        $token = $this->session->userdata('token');
        if (!$token) {
            redirect('auth/login');
        }

        $postData = [
            'name'     => $this->input->post('name', true),
            'email'    => $this->input->post('email', true),
            'password' => $this->input->post('password', true),
            'role_id'     => $this->input->post('role', true)
        ];

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: ' . $token,
            'Content-Type: application/json'
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);


        $result = json_decode($response, true);


        if ($result['status'] == true) {
            $this->session->set_flashdata('success', 'User berhasil ditambahkan.');

            redirect('dashboard/user');
        } else {
            $errorMessage = '';
            if (isset($result['errors']) && is_array($result['errors'])) {
                $errorMessage = implode('<br>', $result['errors']);
            } else {
                $errorMessage = isset($result['message']) ? $result['message'] : 'Terjadi kesalahan';
            }

            $this->session->set_flashdata('error', $errorMessage);
            redirect('dashboard/user/add');
        }
    }

    public function edit($id)
    {
        $role = $this->session->userdata('user')['role'];

        if (!in_array($role, ['1'])) {
            redirect('dashboard');
            exit;
        }
        $url = "http://localhost/Blogs-CI3/api-v1/user/" . $id;

        $token = $this->session->userdata('token');
        if (!$token) {
            redirect('auth/login');
        }

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: ' . $token,
        ]);
        $response = curl_exec($curl);
        curl_close($curl);

        $user = json_decode($response, true);

        $data['user'] = $user['data'];


        $this->load->view('dashboard/users/edit', $data);
    }
    public function update($id)
    {
        $url = "http://localhost/Blogs-CI3/api-v1/user/" . $id;

        $token = $this->session->userdata('token');
        if (!$token) {
            redirect('auth/login');
        }

        $postData = [
            'name'     => $this->input->post('name', true),
            'role_id'  => $this->input->post('role', true),
        ];

        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'PUT',
            CURLOPT_POSTFIELDS     => json_encode($postData),
            CURLOPT_HTTPHEADER     => [
                'Authorization: ' . $token,
                'Content-Type: application/json',
            ],
            CURLOPT_TIMEOUT => 10,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);


        $result = json_decode($response, true);

        if ($result['status'] === true) {
            $this->session->set_flashdata('success', 'User berhasil diupdate.');
            redirect('dashboard/user');
        } else {
            $errorMessage = '';
            if (isset($result['errors']) && is_array($result['errors'])) {
                $errorMessage = implode('<br>', $result['errors']);
            } else {
                $errorMessage = $result['message'] ?? 'Terjadi kesalahan saat update data.';
            }

            $this->session->set_flashdata('error', $errorMessage);
            redirect('dashboard/user/edit/' . $id);
        }
    }

    public function delete($id)
    {
        $role = $this->session->userdata('user')['role'];

        if (!in_array($role, ['1'])) {
            redirect('dashboard');
            exit;
        }
        $url = "http://localhost/Blogs-CI3/api-v1/user/" . $id;

        $token = $this->session->userdata('token');
        if (!$token) {
            redirect('auth/login');
        }

        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'DELETE',
            CURLOPT_HTTPHEADER     => [
                'Authorization: ' . $token,
                'Content-Type: application/json',
            ],
            CURLOPT_TIMEOUT => 10,
        ]);

        $response = curl_exec($curl);
        curl_close($curl);


        $result = json_decode($response, true);

        if ($result['status'] === true) {
            $this->session->set_flashdata('success', 'User berhasil dihapus.');
            redirect('dashboard/user');
        } else {
            $errorMessage = isset($result['message']) ? $result['message'] : 'Terjadi kesalahan saat menghapus data.';
            $this->session->set_flashdata('error', $errorMessage);
            redirect('dashboard/user');
        }
    }
}
