<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Asal_sekolah extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();



        $this->load->model('Asal_sekolah_model');
    }
    public function index()
    {
        $data['title'] = "Data Asal Sekolah - SPMB SMK GRISA";
        $data['sekolah'] = $this->Asal_sekolah_model->get_all();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('asal_sekolah/index', $data);
        $this->load->view('layout/footer');
    }

    public function simpan()
    {
        $data = [
            'nama_sekolah'   => $this->input->post('nama_sekolah', true),
            'alamat_sekolah' => $this->input->post('alamat_sekolah', true)
        ];

        if ($this->Asal_sekolah_model->insert($data)) {
            $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Data asal sekolah berhasil ditambahkan']);
        } else {
            $this->session->set_flashdata('toast', ['type' => 'error', 'message' => 'Gagal menyimpan data']);
        }
        redirect('asal_sekolah');
    }

    public function edit_data($id)
    {
        $data = $this->Asal_sekolah_model->get_by_id($id);
        echo json_encode($data);
    }

    public function update()
    {
        $id = $this->input->post('id_sekolah', true);
        $data = [
            'nama_sekolah'   => $this->input->post('nama_sekolah', true),
            'alamat_sekolah' => $this->input->post('alamat_sekolah', true)
        ];

        if ($this->Asal_sekolah_model->update($id, $data)) {
            $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Data asal sekolah berhasil diperbarui']);
        } else {
            $this->session->set_flashdata('toast', ['type' => 'error', 'message' => 'Gagal memperbarui data']);
        }
        redirect('asal_sekolah');
    }

    public function hapus($id)
    {
        if ($this->Asal_sekolah_model->delete($id)) {
            $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Data asal sekolah berhasil dihapus']);
        } else {
            $this->session->set_flashdata('toast', ['type' => 'error', 'message' => 'Gagal menghapus data']);
        }
        redirect('asal_sekolah');
    }
}
