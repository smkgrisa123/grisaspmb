<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gelombang extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        // ===========================================
        $this->load->model('Gelombang_model');
    }

    public function index()
    {
        $data['title'] = "Data Gelombang - SPMB SMK GRISA";
        $data['gelombang'] = $this->Gelombang_model->get_all();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('gelombang/index', $data);
        $this->load->view('layout/footer');
    }

    public function simpan()
    {
        // Hapus karakter non-digit dari biaya daftar ulang
        $biaya_clean = preg_replace('/[^0-9]/', '', $this->input->post('biaya_daftar_ulang', true));

        $data = [
            'nama_gelombang'     => $this->input->post('nama_gelombang', true),
            'tgl_mulai'          => $this->input->post('tgl_mulai', true),
            'tgl_akhir'          => $this->input->post('tgl_akhir', true),
            'benefit'            => $this->input->post('benefit', true),
            'biaya_daftar_ulang' => $biaya_clean,
            'status'             => $this->input->post('status', true)
        ];

        if ($this->Gelombang_model->insert($data)) {
            $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Data gelombang berhasil disimpan']);
        } else {
            $this->session->set_flashdata('toast', ['type' => 'error', 'message' => 'Gagal menyimpan data']);
        }
        redirect('gelombang');
    }

    public function edit_data($id)
    {
        $data = $this->Gelombang_model->get_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
        $id = $this->input->post('id_gelombang', true);
        $biaya_clean = preg_replace('/[^0-9]/', '', $this->input->post('biaya_daftar_ulang', true));

        $data = [
            'nama_gelombang'     => $this->input->post('nama_gelombang', true),
            'tgl_mulai'          => $this->input->post('tgl_mulai', true),
            'tgl_akhir'          => $this->input->post('tgl_akhir', true),
            'benefit'            => $this->input->post('benefit', true),
            'biaya_daftar_ulang' => $biaya_clean,
            'status'             => $this->input->post('status', true)
        ];

        if ($this->Gelombang_model->update($id, $data)) {
            $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Data gelombang berhasil diperbarui']);
        } else {
            $this->session->set_flashdata('toast', ['type' => 'error', 'message' => 'Gagal memperbarui data']);
        }
        redirect('gelombang');
    }

    public function hapus($id)
    {
        if ($this->Gelombang_model->delete($id)) {
            $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Data gelombang berhasil dihapus']);
        } else {
            $this->session->set_flashdata('toast', ['type' => 'error', 'message' => 'Gagal menghapus data']);
        }
        redirect('gelombang');
    }
}
