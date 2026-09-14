<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gelombang_model extends CI_Model
{

    public function get_all()
    {
        return $this->db->get('gelombang')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('gelombang', ['id_gelombang' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('gelombang', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_gelombang', $id);
        return $this->db->update('gelombang', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_gelombang', $id);
        return $this->db->delete('gelombang');
    }
}
