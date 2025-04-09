<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {

    public function get_users() {
        return $this->db->select('id, name, email, role_id, status, created_at')->from('users')->where('status', 1)->get()->result();
    }

    public function insert($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function get_user_by_id($id)
    {
        return $this->db->get_where('users', ['id' => $id])->row();
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function delete_user($id)
    {
        return $this->db->delete('users', ['id' => $id]);
    }

}
