<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftar_model extends CI_Model
{

    public function get_all()
    {
        $this->db->select('pendaftar.*, jurusan.nama_jurusan, jurusan.kode_jurusan, asal_sekolah.nama_sekolah');
        $this->db->from('pendaftar');
        $this->db->join('jurusan', 'jurusan.id_jurusan = pendaftar.id_jurusan', 'left');
        $this->db->join('asal_sekolah', 'asal_sekolah.id_sekolah = pendaftar.id_sekolah', 'left');
        $this->db->order_by('pendaftar.id_pendaftar', 'DESC');
        return $this->db->get()->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where('pendaftar', ['id_pendaftar' => $id])->row();
    }

    // Generate No Pendaftaran Otomatis
    public function generate_no_pendaftaran($tgl_lahir)
    {
        // Ambil 4 digit tahun lahir
        $tahun_lahir = date('Y', strtotime($tgl_lahir));

        // Hitung total pendaftar saat ini + 1 untuk nomor urut
        $this->db->select_max('id_pendaftar');
        $query = $this->db->get('pendaftar')->row();
        $next_id = $query->id_pendaftar ? $query->id_pendaftar + 1 : 1;

        // Format nomor urut jadi 3 digit (001, 002, dst)
        $no_urut = sprintf("%03d", $next_id);

        // Format akhir: SPMBGRISA2728 + NO_URUT + TAHUN_LAHIR
        return 'SPMBGRISA2728' . $no_urut . $tahun_lahir;
    }

    public function insert($data)
    {
        return $this->db->insert('pendaftar', $data);
    }

    public function update($id, $data)
    {
        $this->db->where('id_pendaftar', $id);
        return $this->db->update('pendaftar', $data);
    }

    public function delete($id)
    {
        $this->db->where('id_pendaftar', $id);
        return $this->db->delete('pendaftar');
    }
}
