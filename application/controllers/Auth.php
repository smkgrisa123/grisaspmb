<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    // === [PERUBAHAN] Load library session di constructor agar selalu aktif ===
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }

    public function index()
    {
        if ($this->session->userdata('logged_in')) {
            redirect('beranda');
        }
        $this->load->view('auth/login');
    }

    public function proses_login()
    {
        $username = $this->input->post('username', true);
        $password = $this->input->post('password', true);

        // Cari berdasarkan username
        $user = $this->db->get_where('users', ['username' => $username])->row();

        // === [PERUBAHAN] Cadangan jika pengguna login menggunakan Email ===
        if (!$user) {
            $user = $this->db->get_where('users', ['email' => $username])->row();
        }

        if ($user) {
            $is_password_valid = false;

            // Cek jika password di DB sudah berupa hash
            if (password_verify($password, $user->password)) {
                $is_password_valid = true;
            }
            // Cek cadangan: jika password di DB masih berupa teks biasa
            else if ($password === $user->password) {
                $is_password_valid = true;

                // Otomatis update password di database menjadi hash yang valid
                $new_hash = password_hash($password, PASSWORD_DEFAULT);
                $this->db->where('id_user', $user->id_user);
                $this->db->update('users', ['password' => $new_hash]);
            }

            if ($is_password_valid) {
                $session_data = [
                    'id_user'   => $user->id_user,
                    'nama'      => $user->nama ?? 'Administrator',
                    'username'  => $user->username,
                    'peran'     => $user->peran ?? 'administrator', // <-- Menggunakan 'peran'
                    'logged_in' => TRUE
                ];
                $this->session->set_userdata($session_data);
                $this->session->set_userdata($session_data);

                // === [PERUBAHAN] Menambahkan toast notifikasi berhasil login ===
                $this->session->set_flashdata('toast', [
                    'type' => 'success',
                    'message' => 'Selamat datang kembali, ' . ($user->nama ?? 'Admin') . '! Anda berhasil login.'
                ]);

                redirect('beranda');
            } else {
                // === [PERUBAHAN] Pesan error khusus jika password salah ===
                $this->session->set_flashdata('toast', [
                    'type' => 'error',
                    'message' => 'Kata sandi yang Anda masukkan salah!'
                ]);
                redirect('auth');
            }
        } else {
            // === [PERUBAHAN] Pesan error khusus jika akun tidak ditemukan ===
            $this->session->set_flashdata('toast', [
                'type' => 'error',
                'message' => 'Username atau Email tidak terdaftar dalam sistem!'
            ]);
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();

        // === [PERUBAHAN] Menambahkan notifikasi toast saat pengguna berhasil keluar/logout ===
        $this->session->set_flashdata('toast', [
            'type' => 'success',
            'message' => 'Anda telah berhasil keluar dari sistem.'
        ]);

        redirect('auth');
    }
}
