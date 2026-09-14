<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asal_sekolah_model extends CI_Model
{

    public function get_all()
    {
        return $this->db->get('asal_sekolah')->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('asal_sekolah', ['id_sekolah' => $id])->row();
    }

    public function insert($data)
    {
        return $this->db->insert('asal_sekolah', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_sekolah', $id);
        return $this->db->update('asal_sekolah', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_sekolah', $id);
        return $this->db->delete('asal_sekolah');
    }
}
