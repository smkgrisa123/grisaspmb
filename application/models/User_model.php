<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function get_all()
    {
        return $this->db->get('users')->result();
    }

    public function insert($data)
    {
        return $this->db->insert('users', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_user', $id);
        return $this->db->update('users', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_user', $id);
        return $this->db->delete('users');
    }
}
