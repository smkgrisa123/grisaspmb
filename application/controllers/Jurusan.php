<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends MY_Controller
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
        $this->load->model('Jurusan_model');
    }

    public function index()
    {
        $data['title'] = "Data Jurusan - SPMB SMK GRISA";
        $data['jurusan'] = $this->Jurusan_model->get_all();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('jurusan/index', $data);
        $this->load->view('layout/footer');
    }

    public function simpan()
    {
        $data = [
            'kode_jurusan' => $this->input->post('kode_jurusan', true),
            'nama_jurusan' => $this->input->post('nama_jurusan', true)
        ];

        if ($this->Jurusan_model->insert($data)) {
            $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Data jurusan berhasil ditambahkan']);
        } else {
            $this->session->set_flashdata('toast', ['type' => 'error', 'message' => 'Gagal menyimpan data']);
        }
        redirect('jurusan');
    }

    public function edit_data($id)
    {
        $data = $this->Jurusan_model->get_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
        $id = $this->input->post('id_jurusan', true);
        $data = [
            'kode_jurusan' => $this->input->post('kode_jurusan', true),
            'nama_jurusan' => $this->input->post('nama_jurusan', true)
        ];

        if ($this->Jurusan_model->update($id, $data)) {
            $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Data jurusan berhasil diperbarui']);
        } else {
            $this->session->set_flashdata('toast', ['type' => 'error', 'message' => 'Gagal memperbarui data']);
        }
        redirect('jurusan');
    }

    public function hapus($id)
    {
        if ($this->Jurusan_model->delete($id)) {
            $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Data jurusan berhasil dihapus']);
        } else {
            $this->session->set_flashdata('toast', ['type' => 'error', 'message' => 'Gagal menghapus data']);
        }
        redirect('jurusan');
    }
}
