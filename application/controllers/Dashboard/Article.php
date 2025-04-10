<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Article extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $role = $this->session->userdata('user')['role'];

        if (!in_array($role, ['1', '2', '3'])) {
            redirect('dashboard');
            exit;
        }

        $url = "http://localhost/Blogs-CI3/api-v1/article";

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

        $article = json_decode($response, true);

        $data['articles'] = $article['data'];


        $this->load->view('dashboard/articles/index', $data);
    }

    public function add()
    {
        $role = $this->session->userdata('user')['role'];

        if (!in_array($role, ['1', '2'])) {
            redirect('dashboard');
            exit;
        }
        $this->load->view('dashboard/articles/add');
    }

    public function save()
    {
        $url = "http://localhost/Blogs-CI3/api-v1/article";
        $token = $this->session->userdata('token');

        if (!$token) {
            redirect('auth/login');
        }

        // Validasi ukuran file (jika ada)
        if (!empty($_FILES['banner']['tmp_name']) && $_FILES['banner']['size'] > 500 * 1024) {
            $this->session->set_flashdata('error', 'Ukuran banner maksimal 500KB.');
            redirect('dashboard/article/add');
        }

        if (!empty($_FILES['attachment']['tmp_name']) && $_FILES['attachment']['size'] > 1024 * 1024) {
            $this->session->set_flashdata('error', 'Ukuran lampiran maksimal 1MB.');
            redirect('dashboard/article/add');
        }

        // Data utama
        $postData = [
            'title'     => $this->input->post('title', true),
            'content'   => $this->input->post('content', true),
            'user_id'   => $this->session->userdata('user')['id'],
        ];

        // Tambahkan file hanya jika diupload
        if (!empty($_FILES['banner']['tmp_name']) && is_uploaded_file($_FILES['banner']['tmp_name'])) {
            $postData['banner'] = new CURLFile(
                $_FILES['banner']['tmp_name'],
                $_FILES['banner']['type'],
                $_FILES['banner']['name']
            );
        }

        if (!empty($_FILES['attachment']['tmp_name']) && is_uploaded_file($_FILES['attachment']['tmp_name'])) {
            $postData['attachment'] = new CURLFile(
                $_FILES['attachment']['tmp_name'],
                $_FILES['attachment']['type'],
                $_FILES['attachment']['name']
            );
        }

        // Kirim request
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData); // BUKAN json_encode()
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: ' . $token,
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $result = json_decode($response, true);

        if ($result['status'] == true) {
            $this->session->set_flashdata('success', 'Artikel berhasil ditambahkan.');
            redirect('dashboard/article');
        } else {
            $errorMessage = '';
            if (isset($result['errors']) && is_array($result['errors'])) {
                $errorMessage = implode('<br>', $result['errors']);
            } else {
                $errorMessage = isset($result['message']) ? $result['message'] : 'Terjadi kesalahan';
            }

            $this->session->set_flashdata('error', $errorMessage);
            redirect('dashboard/article/add');
        }
    }


    public function edit($id)
    {

        $role = $this->session->userdata('user')['role'];

        if (!in_array($role, ['1', '2'])) {
            redirect('dashboard');
            exit;
        }

        $url = "http://localhost/Blogs-CI3/api-v1/article/" . $id;

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

        $article = json_decode($response, true);

        $data['article'] = $article['data'];


        $this->load->view('dashboard/articles/edit', $data);
    }
    public function update($id)
    {
        $url = "http://localhost/Blogs-CI3/api-v1/article/" . $id;

        $token = $this->session->userdata('token');

        if (!$token) {
            redirect('auth/login');
        }

        // Validasi ukuran file (jika ada)
        if (!empty($_FILES['banner']['tmp_name']) && $_FILES['banner']['size'] > 500 * 1024) {
            $this->session->set_flashdata('error', 'Ukuran banner maksimal 500KB.');
            redirect('dashboard/article/add');
        }

        if (!empty($_FILES['attachment']['tmp_name']) && $_FILES['attachment']['size'] > 1024 * 1024) {
            $this->session->set_flashdata('error', 'Ukuran lampiran maksimal 1MB.');
            redirect('dashboard/article/add');
        }

        // Data utama
        $postData = [
            'title'     => $this->input->post('title', true),
            'content'   => $this->input->post('content', true),
            'user_id'   => $this->session->userdata('user')['id'],
        ];

        // Tambahkan file hanya jika diupload
        if (!empty($_FILES['banner']['tmp_name']) && is_uploaded_file($_FILES['banner']['tmp_name'])) {
            $postData['banner'] = new CURLFile(
                $_FILES['banner']['tmp_name'],
                $_FILES['banner']['type'],
                $_FILES['banner']['name']
            );
        }

        if (!empty($_FILES['attachment']['tmp_name']) && is_uploaded_file($_FILES['attachment']['tmp_name'])) {
            $postData['attachment'] = new CURLFile(
                $_FILES['attachment']['tmp_name'],
                $_FILES['attachment']['type'],
                $_FILES['attachment']['name']
            );
        }

        // Kirim request
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData); // BUKAN json_encode()
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: ' . $token,
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        $result = json_decode($response, true);

        if ($result['status'] == true) {
            $this->session->set_flashdata('success', 'Artikel berhasil ditambahkan.');
            redirect('dashboard/article');
        } else {
            $errorMessage = '';
            if (isset($result['errors']) && is_array($result['errors'])) {
                $errorMessage = implode('<br>', $result['errors']);
            } else {
                $errorMessage = isset($result['message']) ? $result['message'] : 'Terjadi kesalahan';
            }

            $this->session->set_flashdata('error', $errorMessage);
            redirect('dashboard/article/edit/' . $id);
        }
    }

    public function delete($id)
    {

        $role = $this->session->userdata('user')['role'];

        if (!in_array($role, ['1'])) {
            redirect('dashboard');
            exit;
        }

        $url = "http://localhost/Blogs-CI3/api-v1/article/" . $id;

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
            $this->session->set_flashdata('success', 'Artikel berhasil dihapus.');
            redirect('dashboard/article');
        } else {
            $errorMessage = isset($result['message']) ? $result['message'] : 'Terjadi kesalahan saat menghapus data.';
            $this->session->set_flashdata('error', $errorMessage);
            redirect('dashboard/article');
        }
    }
}
