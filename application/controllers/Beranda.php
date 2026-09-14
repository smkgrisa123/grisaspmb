<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Beranda extends MY_Controller
{

    public function index()
    {
        $data['title'] = "Beranda - SPMB SMK GRISA";

        // Mengambil nama operator dari session login
        $username_login = $this->session->userdata('username');
        $operator = $this->db->get_where('users', ['username' => $username_login])->row();
        $data['nama_operator'] = ($operator) ? $operator->nama : 'Administrator';

        // 1. Jumlah Pendaftar Keseluruhan
        $data['total_pendaftar'] = $this->db->count_all('pendaftar');

        // 2. Sudah di Verval
        $this->db->like('verval', 'sudah', 'both');
        $data['sudah_verval'] = $this->db->count_all_results('pendaftar');

        // 3. Jumlah Laki-laki (Sudah Verval)
        $this->db->where('jenis_kelamin', 'L');
        $this->db->like('verval', 'sudah', 'both');
        $data['jumlah_l'] = $this->db->count_all_results('pendaftar');

        // 4. Jumlah Perempuan (Sudah Verval)
        $this->db->where('jenis_kelamin', 'P');
        $this->db->like('verval', 'sudah', 'both');
        $data['jumlah_p'] = $this->db->count_all_results('pendaftar');

        // 5. Jumlah Siswa Sudah Bayar Registrasi
        $this->db->from('pembayaran_pendaftar');
        $this->db->where('nominal_reg >', 0);
        $data['bayar_reg'] = $this->db->count_all_results();

        // 6. Jumlah Siswa Sudah Bayar Daftar Ulang
        $this->db->from('pembayaran_pendaftar');
        $this->db->where('nominal_du >', 0);
        $data['bayar_du'] = $this->db->count_all_results();

        // 7. Data Rekapitulasi Pendaftar per Jurusan (Untuk Tabel & Grafik)
        $jurusan = $this->db->get('jurusan')->result();
        $rekap_jurusan = [];
        $chart_labels = [];
        $chart_data = [];

        foreach ($jurusan as $j) {
            $this->db->where('id_jurusan', $j->id_jurusan);
            $this->db->where('jenis_kelamin', 'L');
            $l = $this->db->count_all_results('pendaftar');

            $this->db->where('id_jurusan', $j->id_jurusan);
            $this->db->where('jenis_kelamin', 'P');
            $p = $this->db->count_all_results('pendaftar');

            $jml = $l + $p;

            $rekap_jurusan[] = [
                'nama_jurusan' => $j->nama_jurusan,
                'l' => $l,
                'p' => $p,
                'jml' => $jml
            ];

            // Data untuk Chart.js
            $chart_labels[] = $j->nama_jurusan;
            $chart_data[] = $jml;
        }

        $data['rekap_jurusan'] = $rekap_jurusan;
        $data['chart_labels'] = json_encode($chart_labels);
        $data['chart_data'] = json_encode($chart_data);
        $data['total_keseluruhan_pendaftar'] = array_sum($chart_data);

        // Load view
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('beranda', $data);
        $this->load->view('layout/footer');
    }
}
