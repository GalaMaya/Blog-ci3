<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Articles_model extends CI_Model
{
    private $table = 'articles';

    public function get_all()
    {
        return $this->db->get($this->table)->result();
    }

    public function getById($id)
    {
        return $this->db->where('id', $id)->get($this->table)->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        return $this->db->where('id', $id)->update($this->table, $data);
    }

    public function delete($id)
    {
        return $this->db->where('id', $id)->delete($this->table);
    }

    public function get_by_slug($slug)
    {
        return $this->db->where('slug', $slug)->get($this->table)->row();
    }
}
