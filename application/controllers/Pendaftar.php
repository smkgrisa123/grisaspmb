<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftar extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Set timezone ke WIB
        date_default_timezone_set('Asia/Jakarta');

        // === TAMBAHKAN KODE INI AGAR WAJIB LOGIN ===
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('toast', [
                'type' => 'error',
                'message' => 'Silakan masuk terlebih dahulu untuk mengakses data pendaftar!'
            ]);
            redirect('auth');
        }
        // ===========================================

        $this->load->model('Pendaftar_model');
        $this->load->model('Jurusan_model');
        $this->load->model('Asal_sekolah_model');
    }

    public function index()
    {
        $data['title']        = "Data Pendaftar - SPMB SMK GRISA";
        $data['pendaftar']    = $this->Pendaftar_model->get_all();
        $data['jurusan']      = $this->Jurusan_model->get_all();
        $data['asal_sekolah'] = $this->Asal_sekolah_model->get_all();
        $data['gelombang']    = $this->db->get('gelombang')->result();

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('pendaftar/index', $data);
        $this->load->view('layout/footer');
    }

    public function simpan()
    {
        $nik = $this->input->post('nik', true);

        // Cek NIK Ganda (Tidak boleh sama)
        $cek_nik = $this->db->get_where('pendaftar', ['nik' => $nik])->row();
        if ($cek_nik) {
            $this->session->set_flashdata('toast', [
                'type' => 'error',
                'message' => 'NIK sudah dipakai orang lain!'
            ]);
            redirect('pendaftar');
            return;
        }

        $tgl_lahir = $this->input->post('tgl_lahir', true);
        $no_pendaftaran = $this->Pendaftar_model->generate_no_pendaftaran($tgl_lahir);

        $data = [
            'no_pendaftaran' => $no_pendaftaran,
            'nama_lengkap'   => strtoupper($this->input->post('nama_lengkap', true)),
            'nik'            => $nik,
            'jenis_kelamin'  => $this->input->post('jenis_kelamin', true),
            'tempat_lahir'   => $this->input->post('tempat_lahir', true),
            'tgl_lahir'      => $tgl_lahir,
            'no_hp'          => $this->input->post('no_hp', true),
            'id_sekolah'     => $this->input->post('id_sekolah', true),
            'id_jurusan'     => $this->input->post('id_jurusan', true),
            'marketing'      => $this->input->post('marketing', true), // <-- TAMBAHKAN INI
            'verval'         => 'Belum Verval',
            'tgl_daftar'     => date('Y-m-d H:i:s')
        ];

        if ($this->Pendaftar_model->insert($data)) {
            $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Pendaftar baru berhasil ditambahkan']);
        } else {
            $this->session->set_flashdata('toast', ['type' => 'error', 'message' => 'Gagal menyimpan data']);
        }
        redirect('pendaftar');
    }

    // Halaman Edit Baru
    public function edit($id)
    {
        // -------------------------------------------------------------
        // 1. PROSES SIMPAN PERUBAHAN (JIKA FORM DISUBMIT)
        // -------------------------------------------------------------
        if ($this->input->post()) {


            // === PENGAMAN: JIKA ROLE-NYA SEKRETARIS, TOLAK PERUBAHAN ===
            if ($this->session->userdata('role') == 'Sekretaris') {
                $this->session->set_flashdata('toast', [
                    'type' => 'error',
                    'message' => 'Akses ditolak! Sekretaris hanya memiliki hak akses untuk melihat data.'
                ]);
                redirect('pendaftar/edit/' . $id);
                return;
            }
            // ==========================================================


            // --- A. OLAH DATA BIODATA / PENDAFTAR ---
            $data_pendaftar = [
                'nama_lengkap' => $this->input->post('nama_lengkap'),
                'nisn'         => $this->input->post('nisn'),
                'id_jurusan'   => $this->input->post('id_jurusan'),
                'verval'       => $this->input->post('verval'), // Status akhir verval
                // Tambahkan field pendaftar lainnya di sini jika ada...
            ];
            $this->db->where('id', $id);
            $this->db->update('pendaftar', $data_pendaftar);

            // --- B. OLAH DATA PEMBAYARAN & PEMBATALAN ---
            $nominal_reg = str_replace('.', '', $this->input->post('nominal_reg'));
            $nominal_du  = str_replace('.', '', $this->input->post('nominal_du'));

            // Logika Biaya Registrasi (Jika 0/kosong = Dibatalkan)
            if (empty($nominal_reg) || $nominal_reg == 0) {
                $nom_reg_fix = 0;
                $tgl_reg_fix = NULL;
                $jam_reg_fix = '00:00:00';
            } else {
                $nom_reg_fix = $nominal_reg;
                $tgl_reg_fix = $this->input->post('tgl_reg') ? $this->input->post('tgl_reg') : date('Y-m-d');
                $jam_input   = $this->input->post('jam_reg');
                $jam_reg_fix = (!empty($jam_input) && $jam_input != '00:00') ? date('H:i:s', strtotime($jam_input)) : date('H:i:s');
            }

            // Logika Biaya Daftar Ulang (Jika 0/kosong = Dibatalkan)
            if (empty($nominal_du) || $nominal_du == 0) {
                $nom_du_fix = 0;
                $tgl_du_fix = NULL;
                $jam_du_fix = '00:00:00';
            } else {
                $nom_du_fix = $nominal_du;
                $tgl_du_fix = $this->input->post('tgl_du') ? $this->input->post('tgl_du') : date('Y-m-d');
                $jam_input   = $this->input->post('jam_du');
                $jam_du_fix = (!empty($jam_input) && $jam_input != '00:00') ? date('H:i:s', strtotime($jam_input)) : date('H:i:s');
            }

            $data_pembayaran = [
                'id_gelombang' => $this->input->post('id_gelombang'),
                'nominal_reg'  => $nom_reg_fix,
                'tgl_reg'      => $tgl_reg_fix,
                'jam_reg'      => $jam_reg_fix,
                'nominal_du'   => $nom_du_fix,
                'tgl_du'       => $tgl_du_fix,
                'jam_du'       => $jam_du_fix,
            ];

            // Cek apakah data pembayaran pendaftar ini sudah ada di DB
            $cek_pembayaran = $this->db->get_where('pembayaran_pendaftar', ['id_pendaftar' => $id])->row();
            if ($cek_pembayaran) {
                $this->db->where('id_pendaftar', $id);
                $this->db->update('pembayaran_pendaftar', $data_pembayaran);
            } else {
                $data_pembayaran['id_pendaftar'] = $id;
                $this->db->insert('pembayaran_pendaftar', $data_pembayaran);
            }
            // --- C. OLAH DATA CHECKLIST VERVAL / PERSYARATAN ---
            $input_syarat = $this->input->post('syarat');

            // Jika pembayaran registrasi dibatalkan ($nom_reg_fix == 0), 
            // pastikan syarat pembayaran registrasi (misal id_persyaratan = 1 atau yang bernama registrasi) dipaksa 'Belum'
            if ($nom_reg_fix == 0) {
                // Cari id_persyaratan yang berhubungan dengan registrasi di master_persyaratan
                $cek_master_reg = $this->db->like('nama_persyaratan', 'Registrasi')->get('master_persyaratan')->row();
                if ($cek_master_reg) {
                    // Timpa input syarat untuk item tersebut menjadi 'Belum'
                    $input_syarat[$cek_master_reg->id_persyaratan] = 'Belum';
                }
            }

            // Lanjutkan proses simpan syarat ke database seperti biasa
            if (!empty($input_syarat)) {
                foreach ($input_syarat as $id_persyaratan => $status) {
                    $cek_syarat = $this->db->get_where('pendaftar_persyaratan', [
                        'id_pendaftar'   => $id,
                        'id_persyaratan' => $id_persyaratan
                    ])->row();

                    if ($cek_syarat) {
                        $this->db->where('id_pendaftar', $id);
                        $this->db->where('id_persyaratan', $id_persyaratan);
                        $this->db->update('pendaftar_persyaratan', ['status' => $status]);
                    } else {
                        $this->db->insert('pendaftar_persyaratan', [
                            'id_pendaftar'   => $id,
                            'id_persyaratan' => $id_persyaratan,
                            'status'         => $status
                        ]);
                    }
                }
            }
            // Set pesan flashdata dan redirect
            $this->session->set_flashdata('success', 'Data pendaftar berhasil diperbarui!');
            redirect('pendaftar/edit/' . $id);
        }

        // -------------------------------------------------------------
        // 2. LOAD DATA UNTUK TAMPILAN VIEW (GET)
        // -------------------------------------------------------------
        $data['title']        = "Edit Data Pendaftar - SPMB SMK GRISA";
        $data['pendaftar']    = $this->Pendaftar_model->get_by_id($id);
        $data['jurusan']      = $this->Jurusan_model->get_all();
        $data['asal_sekolah'] = $this->Asal_sekolah_model->get_all();


        // Ambil Data Gelombang & Pembayaran
        $data['gelombang']  = $this->db->get('gelombang')->result();
        $data['pembayaran'] = $this->db->get_where('pembayaran_pendaftar', ['id_pendaftar' => $id])->row();

        // Data Master Persyaratan & Status
        $master_syarat    = $this->db->get_where('master_persyaratan', ['is_active' => '1'])->result();
        $syarat_pendaftar = $this->db->get_where('pendaftar_persyaratan', ['id_pendaftar' => $id])->result_array();

        $status_syarat = [];
        foreach ($syarat_pendaftar as $sp) {
            $status_syarat[$sp['id_persyaratan']] = $sp['status'];
        }

        $data['master_syarat'] = $master_syarat;
        $data['status_syarat'] = $status_syarat;

        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar');
        $this->load->view('pendaftar/edit', $data);
        $this->load->view('layout/footer');
    }
    // Hanya ada SATU fungsi update di sini
    public function update()
    {
        // === PENGAMAN: JIKA ROLE-NYA SEKRETARIS, TOLAK PERUBAHAN PEMBAYARAN / DATA ===
        if ($this->session->userdata('role') == 'Sekretaris') {
            $this->session->set_flashdata('toast', [
                'type' => 'error',
                'message' => 'Akses ditolak! Sekretaris hanya memiliki hak akses untuk melihat data.'
            ]);
            // Ambil id_pendaftar dari post untuk redirect kembali ke halaman edit
            $id_pendaftar = $this->input->post('id_pendaftar', true);
            redirect('pendaftar/edit/' . $id_pendaftar);
            return;
        }
        // =========================================================================

        $id  = $this->input->post('id_pendaftar', true);
        $nik = $this->input->post('nik', true);
        $id  = $this->input->post('id_pendaftar', true);
        $nik = $this->input->post('nik', true);

        // 1. Cek NIK Ganda
        $this->db->where('nik', $nik);
        $this->db->where('id_pendaftar !=', $id);
        $cek_nik = $this->db->get('pendaftar')->row();

        if ($cek_nik) {
            $this->session->set_flashdata('toast', [
                'type' => 'error',
                'message' => 'NIK sudah dipakai orang lain!'
            ]);
            redirect('pendaftar/edit/' . $id);
            return;
        }

        // 2. Olah & Bersihkan Nominal Pembayaran Registrasi
        $nominal_reg = str_replace(['Rp', '.', ' '], '', $this->input->post('nominal_reg'));

        // Jika nominal registrasi dikosongkan atau bernilai 0 (Dibatalkan)
        if (empty($nominal_reg) || $nominal_reg == 0) {
            $nom_reg_fix = 0;
            $tgl_reg_fix = NULL;
            $jam_reg_fix = '00:00:00';
        } else {
            // Ambil dari input atau gunakan data yang ada jika valid
            $nom_reg_fix = $nominal_reg;
            $tgl_reg_fix = $this->input->post('tgl_reg') ?: NULL;
            $jam_input   = $this->input->post('jam_reg');
            $jam_reg_fix = (!empty($jam_input) && $jam_input != '00:00') ? date('H:i:s', strtotime($jam_input)) : date('H:i:s');
        }

        // Olah Nominal Daftar Ulang
        $nominal_du = str_replace(['Rp', '.', ' '], '', $this->input->post('nominal_du'));
        if (empty($nominal_du) || $nominal_du == 0) {
            $nom_du_fix = 0;
            $tgl_du_fix = NULL;
            $jam_du_fix = '00:00:00';
        } else {
            $nom_du_fix = $nominal_du;
            $tgl_du_fix = $this->input->post('tgl_du') ?: NULL;
            $jam_input   = $this->input->post('jam_du');
            $jam_du_fix = (!empty($jam_input) && $jam_input != '00:00') ? date('H:i:s', strtotime($jam_input)) : date('H:i:s');
        }

        // 3. Data untuk tabel utama 'pendaftar'
        $data = [
            'nama_lengkap'         => strtoupper($this->input->post('nama_lengkap', true)),
            'tempat_lahir'         => $this->input->post('tempat_lahir', true),
            'tgl_lahir'            => $this->input->post('tgl_lahir', true),
            'jenis_kelamin'        => $this->input->post('jenis_kelamin', true),
            'jalan'                => $this->input->post('jalan', true),
            'dusun'                => $this->input->post('dusun', true),
            'rt_rw'                => $this->input->post('rt_rw', true),
            'desa'                 => $this->input->post('desa', true),
            'kecamatan'            => $this->input->post('kecamatan', true),
            'kabupaten'            => $this->input->post('kabupaten', true),
            'agama'                => $this->input->post('agama', true),
            'no_kk'                => $this->input->post('no_kk', true),
            'nik'                  => $nik,
            'no_hp'                => $this->input->post('no_hp', true),
            'id_jurusan'           => $this->input->post('id_jurusan', true),
            'id_sekolah'           => $this->input->post('id_sekolah', true),
            'nama_ayah'            => $this->input->post('nama_ayah', true),
            'status_ayah'          => $this->input->post('status_ayah', true),
            'pekerjaan_ayah'       => $this->input->post('pekerjaan_ayah', true),
            'alamat_ayah'          => $this->input->post('alamat_ayah', true),
            'no_hp_ayah'           => $this->input->post('no_hp_ayah', true),
            'nama_ibu'             => $this->input->post('nama_ibu', true),
            'status_ibu'           => $this->input->post('status_ibu', true),
            'pekerjaan_ibu'        => $this->input->post('pekerjaan_ibu', true),
            'alamat_ibu'           => $this->input->post('alamat_ibu', true),
            'no_hp_ibu'            => $this->input->post('no_hp_ibu', true),
            'nama_wali'            => $this->input->post('nama_wali', true),
            'pekerjaan_wali'       => $this->input->post('pekerjaan_wali', true),
            'alamat_wali'          => $this->input->post('alamat_wali', true),
            'no_hp_wali'           => $this->input->post('no_hp_wali', true),
            'status_hubungan_wali' => $this->input->post('status_hubungan_wali', true),
            'marketing'            => $this->input->post('marketing', true), // <-- TAMBAHKAN INI
            'verval'               => $this->input->post('verval', true),
            'catatan_verval'       => $this->input->post('catatan_verval', true)
        ];

        // Update tabel utama 'pendaftar'
        $this->Pendaftar_model->update($id, $data);

        // 4. Simpan / Update Data Pembayaran
        $pembayaran_data = [
            'nominal_reg'  => $nom_reg_fix,
            'tgl_reg'      => $tgl_reg_fix,
            'jam_reg'      => $jam_reg_fix,
            'id_gelombang' => $this->input->post('id_gelombang') ?: NULL,
            'nominal_du'   => $nom_du_fix,
            'tgl_du'       => $tgl_du_fix,
            'jam_du'       => $jam_du_fix,
        ];

        $cek_bayar = $this->db->get_where('pembayaran_pendaftar', ['id_pendaftar' => $id])->row();
        if ($cek_bayar) {
            $this->db->where('id_pendaftar', $id);
            $this->db->update('pembayaran_pendaftar', $pembayaran_data);
        } else {
            $pembayaran_data['id_pendaftar'] = $id;
            $this->db->insert('pembayaran_pendaftar', $pembayaran_data);
        }

        // 5. Simpan / Update Checklist Persyaratan Verval
        $syarat_input = $this->input->post('syarat'); // Array [id_persyaratan => status]

        // JIKA PEMBAYARAN REGISTRASI DI-RESET KE 0, PAKSA STATUS SYARAT REGISTRASI MENJADI 'Belum'
        if ($nom_reg_fix == 0) {
            $cek_master_reg = $this->db->like('nama_persyaratan', 'Registrasi')->get('master_persyaratan')->row();
            if ($cek_master_reg) {
                $syarat_input[$cek_master_reg->id_persyaratan] = 'Belum';
            }
        }

        if (!empty($syarat_input)) {
            foreach ($syarat_input as $id_syarat => $status_val) {
                $cek = $this->db->get_where('pendaftar_persyaratan', [
                    'id_pendaftar'   => $id,
                    'id_persyaratan' => $id_syarat
                ])->row();

                if ($cek) {
                    $this->db->where('id', $cek->id);
                    $this->db->update('pendaftar_persyaratan', ['status' => $status_val]);
                } else {
                    $this->db->insert('pendaftar_persyaratan', [
                        'id_pendaftar'   => $id,
                        'id_persyaratan' => $id_syarat,
                        'status'         => $status_val
                    ]);
                }
            }
        }

        // 6. Set Flashdata Toast & Redirect
        $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Data pendaftar & kelengkapan berkas berhasil diperbarui']);
        redirect('pendaftar/edit/' . $id);
    }

    public function hapus($id)
    {
        if ($this->Pendaftar_model->delete($id)) {
            $this->session->set_flashdata('toast', ['type' => 'success', 'message' => 'Data pendaftar berhasil dihapus']);
        } else {
            $this->session->set_flashdata('toast', ['type' => 'error', 'message' => 'Gagal menghapus data']);
        }
        redirect('pendaftar');
    }

    public function export_excel()
    {
        // Ambil data pendaftar beserta relasinya jika perlu
        $data['pendaftar'] = $this->Pendaftar_model->get_all();

        // Load view khusus untuk export excel (biasanya berupa tabel HTML dengan header excel)
        $this->load->view('pendaftar/export_excel', $data);
    }

    public function cetak($id)
    {
        // Ambil data pendaftar beserta data sekolah (pastikan kolom alamat sekolah ikut dipanggil)
        $this->db->select('pendaftar.*, asal_sekolah.nama_sekolah, asal_sekolah.alamat_sekolah, jurusan.nama_jurusan');
        $this->db->from('pendaftar');
        $this->db->join('asal_sekolah', 'asal_sekolah.id_sekolah = pendaftar.id_sekolah', 'left');
        $this->db->join('jurusan', 'jurusan.id_jurusan = pendaftar.id_jurusan', 'left');
        $this->db->where('pendaftar.id_pendaftar', $id);
        $data['pendaftar'] = $this->db->get()->row();

        if (!$data['pendaftar']) {
            show_404();
        }

        $this->load->view('pendaftar/cetak_formulir', $data);
    }

    public function cetak_kwitansi_reg($id_pendaftar)
    {
        // Ambil data pendaftar
        $data['pendaftar'] = $this->db->get_where('pendaftar', ['id_pendaftar' => $id_pendaftar])->row();

        if (!$data['pendaftar']) {
            show_404();
        }

        // Ambil data dari tabel pembayaran_pendaftar
        $data['pembayaran'] = $this->db->get_where('pembayaran_pendaftar', ['id_pendaftar' => $id_pendaftar])->row();

        // Tampilkan view cetak kwitansi registrasi
        $this->load->view('pembayaran/print_kwitansi', $data);
    }

    public function cetak_kwitansi_du($id_pendaftar)
    {
        // Ambil data pendaftar
        $data['pendaftar'] = $this->db->get_where('pendaftar', ['id_pendaftar' => $id_pendaftar])->row();

        if (!$data['pendaftar']) {
            show_404();
        }

        // Ambil data dari tabel pembayaran_pendaftar
        $data['pembayaran'] = $this->db->get_where('pembayaran_pendaftar', ['id_pendaftar' => $id_pendaftar])->row();

        // Tampilkan view cetak kwitansi daftar ulang sesuai dengan file di VS Code Anda
        $this->load->view('pembayaran/cetak_kwitansi_du', $data);
    }
}
