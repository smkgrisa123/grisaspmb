<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Pengecekan login terpusat untuk SEMUA controller yang nanti mewarisinya
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('toast', [
                'type' => 'error',
                'message' => 'Silakan masuk terlebih dahulu untuk mengakses halaman ini!'
            ]);
            redirect('auth');
        }
    }
}
