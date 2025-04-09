<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Articles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('AuthMiddleware');
        $this->load->model('Articles_model');
        header('Content-Type: application/json');
    }

    public function get()
    {
        $this->authmiddleware->verify([1, 2, 3]);

        if ($this->input->method(true) !== 'GET') {
            show_error('Method Not Allowed', 405);
        }

        try {
            $articles = $this->Articles_model->get_all();

            json_response([
                'status' => true,
                'data' => $articles
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

    public function add()
    {

        $this->authmiddleware->verify([1, 2]);

        if ($this->input->method(true) !== 'POST') {
            show_error('Method Not Allowed', 405);
        }

        try {
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('content', 'Content', 'required');
            $this->form_validation->set_rules('user_id', 'User ID', 'required|integer');

            if ($this->form_validation->run() === FALSE) {
                throw new Exception(json_encode($this->form_validation->error_array()), 422);
            }

            // File Upload Config
            $config_banner = [
                'upload_path' => './uploads/banner/',
                'allowed_types' => 'jpg|jpeg|png|gif',
                'max_size' => 500, // KB
                'encrypt_name' => true
            ];

            $config_attachment = [
                'upload_path' => './uploads/attachment/',
                'allowed_types' => 'pdf',
                'max_size' => 1024, // KB
                'encrypt_name' => true
            ];

            $this->load->library('upload');

            $banner_name = null;
            if (!empty($_FILES['banner']['name'])) {
                $this->upload->initialize($config_banner);
                if (!$this->upload->do_upload('banner')) {
                    throw new Exception(json_encode(['banner' => $this->upload->display_errors('', '')]), 422);
                }
                $banner_name = $this->upload->data('file_name');
            }

            $attachment_name = null;
            if (!empty($_FILES['attachment']['name'])) {
                $this->upload->initialize($config_attachment);
                if (!$this->upload->do_upload('attachment')) {
                    throw new Exception(json_encode(['attachment' => $this->upload->display_errors('', '')]), 422);
                }
                $attachment_name = $this->upload->data('file_name');
            }

            $data = [
                'title' => $this->input->post('title'),
                'slug' => generate_slug($this->input->post('title')),
                'content' => $this->input->post('content'),
                'banner' => $banner_name,
                'attachment' => $attachment_name,
                'status' => 1,
                'user_id' => $this->input->post('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->Articles_model->insert($data);

            json_response([
                'status' => true,
                'message' => 'Article berhasil ditambahkan'
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

        $this->authmiddleware->verify([1, 2]);

        if ($this->input->method(true) !== 'POST') {
            show_error('Method Not Allowed', 405);
        }

        try {
            $article = $this->Articles_model->getById($id);
            if (!$article) {
                throw new Exception('Article not found', 404);
            }

            // Ambil data dari $_POST karena Postman mengirim via form-data
            $data = [
                'title'     => $this->input->post('title'),
                'content'   => $this->input->post('content'),
                'user_id'   => $this->input->post('user_id'),
                'status'    => $this->input->post('status'),
            ];

            // Validasi data
            $this->form_validation->set_data($data);
            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('content', 'Content', 'required');
            $this->form_validation->set_rules('status', 'Status', 'required');
            $this->form_validation->set_rules('user_id', 'User ID', 'required');

            if ($this->form_validation->run() === FALSE) {
                throw new Exception(json_encode($this->form_validation->error_array()), 422);
            }

            // Config upload
            $config_banner = [
                'upload_path'   => './uploads/banner/',
                'allowed_types' => 'jpg|jpeg|png|gif',
                'max_size'      => 500, // dalam KB
                'encrypt_name'  => true
            ];

            $config_attachment = [
                'upload_path'   => './uploads/attachment/',
                'allowed_types' => 'pdf',
                'max_size'      => 1024, // dalam KB
                'encrypt_name'  => true
            ];

            $this->load->library('upload');

            // Banner Upload
            $banner_name = $article->banner;
            if (!empty($_FILES['banner']['name'])) {
                $this->upload->initialize($config_banner);
                if (!$this->upload->do_upload('banner')) {
                    throw new Exception(json_encode(['banner' => $this->upload->display_errors('', '')]), 422);
                }

                $new_banner = $this->upload->data('file_name');
                if ($banner_name && file_exists('./uploads/banner/' . $banner_name)) {
                    unlink('./uploads/banner/' . $banner_name);
                }
                $banner_name = $new_banner;
            }

            // Attachment Upload
            $attachment_name = $article->attachment;
            if (!empty($_FILES['attachment']['name'])) {
                $this->upload->initialize($config_attachment);
                if (!$this->upload->do_upload('attachment')) {
                    throw new Exception(json_encode(['attachment' => $this->upload->display_errors('', '')]), 422);
                }

                $new_attachment = $this->upload->data('file_name');
                if ($attachment_name && file_exists('./uploads/attachment/' . $attachment_name)) {
                    unlink('./uploads/attachment/' . $attachment_name);
                }
                $attachment_name = $new_attachment;
            }

            // Update data
            $update_data = [
                'title'      => $data['title'],
                'slug'       => generate_slug($data['title']),
                'content'    => $data['content'],
                'banner'     => $banner_name,
                'attachment' => $attachment_name,
                'status'     => $data['status'],
                'user_id'    => $data['user_id'],
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->Articles_model->update($id, $update_data);

            return $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => true,
                    'message' => 'Article berhasil diperbarui'
                ]));
        } catch (Exception $e) {
            $errorMessage = json_decode($e->getMessage(), true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                $errorMessage = ['general' => strip_tags($e->getMessage())];
            }

            return $this->output
                ->set_status_header($e->getCode() ?: 500)
                ->set_content_type('application/json')
                ->set_output(json_encode([
                    'status' => false,
                    'errors' => $errorMessage
                ]));
        }
    }

    public function delete($id)
    {

        $this->authmiddleware->verify([1]);

        if ($this->input->method(true) !== 'DELETE') {
            show_error('Method Not Allowed', 405);
        }

        try {
            $article = $this->Articles_model->getById($id);

            if (!$article) {
                throw new Exception('Article tidak ditemukan', 404);
            }

            // Hapus file banner jika ada
            if (!empty($article->banner) && file_exists(FCPATH . 'uploads/banner/' . $article->banner)) {
                unlink(FCPATH . 'uploads/banner/' . $article->banner);
            }

            // Hapus file attachment jika ada
            if (!empty($article->attachment) && file_exists(FCPATH . 'uploads/attachment/' . $article->attachment)) {
                unlink(FCPATH . 'uploads/attachment/' . $article->attachment);
            }

            $this->Articles_model->delete($id);

            json_response([
                'status' => true,
                'message' => 'Article berhasil dihapus'
            ]);
        } catch (Exception $e) {
            http_response_code($e->getCode() ?: 500);

            json_response([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}
