<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekapitulasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Penjaga akses (wajib login)
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('toast', [
                'type' => 'error',
                'message' => 'Silakan login terlebih dahulu!'
            ]);
            redirect('auth');
        }
    }

    public function data()
    {
        $data['title'] = 'Rekap Data Pendaftar & Persyaratan - SPMB SMK Grisa';

        // Ambil semua daftar persyaratan
        $data['persyaratan'] = $this->db->get('master_persyaratan')->result();

        // Ambil data pendaftar dengan JOIN ke tabel jurusan (sesuaikan nama tabel jurusannya jika berbeda, misal 'jurusan' atau 'master_jurusan')
        $this->db->select('pendaftar.*, jurusan.nama_jurusan');
        $this->db->from('pendaftar');
        $this->db->join('jurusan', 'jurusan.id_jurusan = pendaftar.id_jurusan', 'left');
        $data['pendaftar'] = $this->db->get()->result();

        // Load view
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('rekapitulasi/data_view', $data);
        $this->load->view('layout/footer');
    }

    public function pembayaran()
    {
        $data['title'] = 'Rekap Pembayaran - SPMB SMK Grisa';

        // Ambil data pendaftar, JOIN ke jurusan, dan JOIN ke pembayaran_pendaftar
        $this->db->select('pendaftar.*, jurusan.nama_jurusan, pembayaran_pendaftar.nominal_reg, pembayaran_pendaftar.tgl_reg, pembayaran_pendaftar.nominal_du, pembayaran_pendaftar.tgl_du, gelombang.nama_gelombang');
        $this->db->from('pendaftar');
        $this->db->join('jurusan', 'jurusan.id_jurusan = pendaftar.id_jurusan', 'left');
        $this->db->join('pembayaran_pendaftar', 'pembayaran_pendaftar.id_pendaftar = pendaftar.id_pendaftar', 'left');
        $this->db->join('gelombang', 'gelombang.id_gelombang = pembayaran_pendaftar.id_gelombang', 'left'); // Opsional jika ingin ambil nama gelombang
        $data['pendaftar'] = $this->db->get()->result();

        // Load view rekap pembayaran
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('rekapitulasi/pembayaran_view', $data);
        $this->load->view('layout/footer');
    }

    public function excel_pembayaran()
    {
        // Ambil data pendaftar, JOIN ke jurusan, JOIN ke pembayaran_pendaftar, dan gelombang
        $this->db->select('pendaftar.*, jurusan.nama_jurusan, pembayaran_pendaftar.nominal_reg, pembayaran_pendaftar.tgl_reg, pembayaran_pendaftar.nominal_du, pembayaran_pendaftar.tgl_du, gelombang.nama_gelombang');
        $this->db->from('pendaftar');
        $this->db->join('jurusan', 'jurusan.id_jurusan = pendaftar.id_jurusan', 'left');
        $this->db->join('pembayaran_pendaftar', 'pembayaran_pendaftar.id_pendaftar = pendaftar.id_pendaftar', 'left');
        $this->db->join('gelombang', 'gelombang.id_gelombang = pembayaran_pendaftar.id_gelombang', 'left');
        $data['pendaftar'] = $this->db->get()->result();

        // Load view khusus excel
        $this->load->view('rekapitulasi/excel_pembayaran_view', $data);
    }

    public function excel_data()
    {
        // Ambil data persyaratan
        $data['persyaratan'] = $this->db->get('master_persyaratan')->result();

        // Ambil data pendaftar dengan JOIN ke jurusan
        $this->db->select('pendaftar.*, jurusan.nama_jurusan');
        $this->db->from('pendaftar');
        $this->db->join('jurusan', 'jurusan.id_jurusan = pendaftar.id_jurusan', 'left');
        $data['pendaftar'] = $this->db->get()->result();

        // Load view khusus export excel rekap data
        $this->load->view('rekapitulasi/excel_data_view', $data);
    }
}
