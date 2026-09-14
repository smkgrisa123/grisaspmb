<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan_model extends CI_Model
{

    public function get_all()
    {
        return $this->db->get('jurusan')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('jurusan', ['id_jurusan' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('jurusan', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_jurusan', $id);
        return $this->db->update('jurusan', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_jurusan', $id);
        return $this->db->delete('jurusan');
    }
}
