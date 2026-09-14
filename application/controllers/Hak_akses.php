<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hak_akses extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in') || $this->session->userdata('peran') != 'administrator') {
            redirect('auth');
        }
        $this->load->model('User_model');
    }

    public function index()
    {
        $data['title'] = "Manajemen Hak Akses - SPMB SMK GRISA";
        $data['users'] = $this->User_model->get_all();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('hak_akses/index', $data);
        $this->load->view('layout/footer');
    }

    public function simpan()
    {
        $data = [
            'nama'     => $this->input->post('nama', true),
            'username' => $this->input->post('username', true),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'peran'    => $this->input->post('peran', true)
        ];
        $this->User_model->insert($data);
        $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'User berhasil ditambahkan']);
        redirect('hak_akses');
    }

    public function update($id)
    {
        $data = [
            'nama'     => $this->input->post('nama', true),
            'username' => $this->input->post('username', true),
            'peran'    => $this->input->post('peran', true)
        ];

        // Jika password diisi, update passwordnya juga
        if (!empty($this->input->post('password'))) {
            $data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        }

        $this->User_model->update($id, $data);
        $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'User berhasil diperbarui']);
        redirect('hak_akses');
    }

    public function hapus($id)
    {
        $this->User_model->delete($id);
        $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'User berhasil dihapus']);
        redirect('hak_akses');
    }
}
