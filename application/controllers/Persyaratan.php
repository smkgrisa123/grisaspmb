<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persyaratan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        // === TAMBAHKAN KODE INI AGAR WAJIB LOGIN ===
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('toast', [
                'type' => 'error',
                'message' => 'Silakan masuk terlebih dahulu untuk mengakses halaman ini!'
            ]);
            redirect('auth');
        }
        // ===========================================
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['title']       = "Master Persyaratan - SPMB SMK GRISA";
        $data['persyaratan'] = $this->db->get('master_persyaratan')->result();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('persyaratan/index', $data);
        $this->load->view('layout/footer');
    }

    public function simpan()
    {
        $nama_persyaratan = $this->input->post('nama_persyaratan', true);

        $data = [
            'nama_persyaratan' => $nama_persyaratan,
            'is_active'        => '1'
        ];

        if ($this->db->insert('master_persyaratan', $data)) {
            $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Persyaratan baru berhasil ditambahkan']);
        } else {
            $this->session->set_flashdata('toast', ['type' => 'error', 'message' => 'Gagal menambah data']);
        }
        redirect('persyaratan');
    }

    public function update()
    {
        $id               = $this->input->post('id_persyaratan', true);
        $nama_persyaratan = $this->input->post('nama_persyaratan', true);
        $is_active        = $this->input->post('is_active', true);

        $data = [
            'nama_persyaratan' => $nama_persyaratan,
            'is_active'        => $is_active
        ];

        $this->db->where('id_persyaratan', $id);
        if ($this->db->update('master_persyaratan', $data)) {
            $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Persyaratan berhasil diperbarui']);
        } else {
            $this->session->set_flashdata('toast', ['type' => 'error', 'message' => 'Gagal memperbarui data']);
        }
        redirect('persyaratan');
    }

    public function hapus($id)
    {
        $this->db->where('id_persyaratan', $id);
        if ($this->db->delete('master_persyaratan')) {
            $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Persyaratan berhasil dihapus']);
        } else {
            $this->session->set_flashdata('toast', ['type' => 'error', 'message' => 'Gagal menghapus data']);
        }
        redirect('persyaratan');
    }
}
