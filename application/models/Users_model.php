<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    private $table = 'users';

    public function get_users() {
        return $this->db->select('id, name, email, role_id, status, created_at')->from($this->table)->where('status', 1)->get()->result();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete_user($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

}
