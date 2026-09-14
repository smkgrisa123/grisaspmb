<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 fw-bold"><i class="fa fa-users me-2 text-primary"></i> Data Pendaftar</h6>
        <div>

            <!-- Tombol Tambah Pendaftar Baru -->
            <!-- [DIUBAH UNTUK KETUA SPMB] Tombol disembunyikan jika peran adalah ketua_spmb -->
            <!-- [DIUBAH UNTUK KETUA SPMB & SEKRETARIS] Tombol disembunyikan jika yang login ketua_spmb atau sekretaris -->
            <?php if (!in_array(strtolower(trim($this->session->userdata('peran'))), ['ketua_spmb', 'bendahara'])): ?>
                <button type="button" class="btn btn-primary btn-sm" onclick="tambahPendaftar()">
                    <i class="fa fa-plus me-1"></i> Tambah Pendaftar Baru
                </button>
            <?php endif; ?>

            <!-- Tombol Download Excel -->
            <a href="<?= base_url('pendaftar/export_excel'); ?>" class="btn btn-success btn-sm me-1">
                <i class="fa fa-file-excel me-1"></i> Download Excel
            </a>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tablePendaftar" class="table table-bordered table-hover align-middle" style="font-size: 13px; width:100%;">
                <!-- Bagian THEAD (Header Tabel) -->
                <thead class="table-light">
                    <tr>
                        <th width="40" class="text-center">NO</th>
                        <th>NO. PENDAFTARAN</th>
                        <th>NAMA LENGKAP</th>
                        <th>JK</th>
                        <th>NO. HP</th>
                        <th>JURUSAN</th>
                        <th>SEKOLAH ASAL</th>
                        <th>GELOMBANG</th> <!-- Kolom Gelombang -->
                        <th class="text-center">VERVAL</th>
                        <th>TGL DAFTAR</th>
                        <th width="120" class="text-center">AKSI</th>
                    </tr>
                </thead>

                <!-- Bagian TBODY (Isi Tabel) -->
                <!-- Bagian TBODY (Isi Tabel) -->
                <tbody>
                    <?php if (!empty($pendaftar)):
                        // 1. Buat array bantu untuk memetakan ID ke Nama Gelombang agar mudah dicari
                        $list_gelombang = [];
                        foreach ($gelombang as $g) {
                            $list_gelombang[$g->id_gelombang] = $g->nama_gelombang;
                        }

                        $no = 1;
                        foreach ($pendaftar as $p): ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><span class="fw-bold text-dark"><?= $p->no_pendaftaran; ?></span></td>
                                <td class="fw-bold"><?= strtoupper($p->nama_lengkap); ?></td>

                                <!-- Kolom Jenis Kelamin -->
                                <td class="text-center"><?= $p->jenis_kelamin == 'L' ? 'L' : 'P'; ?></td>

                                <!-- Kolom No HP -->
                                <td>
                                    <?php if (!empty($p->no_hp)): ?>
                                        <a href="https://wa.me/<?= preg_replace('/^0/', '62', $p->no_hp); ?>" target="_blank" class="text-success text-decoration-none">
                                            <i class="fab fa-whatsapp"></i> <?= $p->no_hp; ?>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>

                                <td><?= $p->nama_jurusan ? $p->nama_jurusan : '-'; ?></td>
                                <td><?= $p->nama_sekolah ? $p->nama_sekolah : '-'; ?></td>

                                <!-- 2. Menampilkan Nama Gelombang berdasarkan ID yang tersimpan di data pendaftar ($p->id_gelombang) -->
                                <td>
                                    <?php
                                    // Cari data pembayaran untuk pendaftar ini
                                    $pembayaran_pendaftar = $this->db->get_where('pembayaran_pendaftar', ['id_pendaftar' => $p->id_pendaftar])->row();

                                    // Cari nama gelombang berdasarkan id_gelombang dari tabel pembayaran
                                    $nama_gel = '-';
                                    if ($pembayaran_pendaftar && !empty($pembayaran_pendaftar->id_gelombang)) {
                                        foreach ($gelombang as $g) {
                                            if ($g->id_gelombang == $pembayaran_pendaftar->id_gelombang) {
                                                $nama_gel = $g->nama_gelombang;
                                                break;
                                            }
                                        }
                                    }
                                    echo '<span class="badge bg-secondary">' . $nama_gel . '</span>';
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($p->verval == 'Sudah Verval'): ?>
                                        <span class="badge bg-success">Sudah Verval</span>
                                    <?php else: ?>
                                        <span class="badge" style="background-color: #fff2cc; color: #8c6b00; border: 1px solid #ffe599;">Belum Verval</span>
                                    <?php endif; ?>
                                </td>
                                <td><?= date('d-m-Y H:i:s', strtotime($p->tgl_daftar)); ?> WIB</td>
                                <td class="text-center">


                                    <!-- Tombol Edit -->
                                    <a href="<?= base_url('pendaftar/edit/' . $p->id_pendaftar); ?>" class="btn btn-warning btn-sm text-white px-2 py-1" title="Edit Data">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Tombol Print -->
                                    <a href="<?= base_url('pendaftar/cetak/' . $p->id_pendaftar); ?>" target="_blank" class="btn btn-info btn-sm text-white px-2 py-1" title="Cetak Bukti">
                                        <i class="fas fa-print"></i>
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <button class="btn btn-danger btn-sm px-2 py-1" onclick="hapusPendaftar(<?= $p->id_pendaftar; ?>)" title="Hapus Data">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                    <?php endforeach;
                    endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH PENDAFTAR -->
<div class="modal fade" id="modalPendaftar" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <form action="<?= base_url('pendaftar/simpan'); ?>" method="post" id="formPendaftar">
                <div class="modal-header border-bottom-0 pb-0">
                    <div>
                        <h5 class="modal-title fw-bold">TAMBAH PENDAFTAR BARU</h5>
                        <small class="text-muted">Isi data awal untuk membuat pendaftaran baru.</small>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-3">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lengkap" class="form-control" placeholder="Masukkan nama lengkap" required>
                    </div>

                    <div class="row">
                        <div class="col-md-7 mb-3">
                            <label class="form-label fw-semibold">NIK (Nomor Induk Kependudukan) <span class="text-danger">*</span></label>
                            <input type="text" name="nik" maxlength="16" class="form-control" placeholder="16 digit NIK" required>
                        </div>
                        <div class="col-md-5 mb-3">
                            <label class="form-label fw-semibold">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tempat Lahir <span class="text-danger">*</span></label>
                            <input type="text" name="tempat_lahir" class="form-control" placeholder="Kota lahir" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tanggal Lahir <span class="text-danger">*</span></label>
                            <input type="date" name="tgl_lahir" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">No. HP Siswa <span class="text-danger">*</span></label>
                        <input type="text" name="no_hp" class="form-control" placeholder="08xxxxxxxxxx" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Sekolah Asal <span class="text-danger">*</span></label>
                        <select name="id_sekolah" class="form-select" required>
                            <option value="">-- Pilih Sekolah Asal --</option>
                            <?php foreach ($asal_sekolah as $s): ?>
                                <option value="<?= $s->id_sekolah; ?>"><?= $s->nama_sekolah; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Pilihan Jurusan <span class="text-danger">*</span></label>
                        <select name="id_jurusan" class="form-select" required>
                            <option value="">-- Pilih Jurusan --</option>
                            <?php foreach ($jurusan as $j): ?>
                                <option value="<?= $j->id_jurusan; ?>"><?= $j->nama_jurusan; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success px-4" style="background-color: #009669; border: none;">Simpan Pendaftar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#tablePendaftar').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                "zeroRecords": "Data pendaftar tidak ditemukan",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });

        <?php if ($this->session->flashdata('toast')): ?>
            <?php
            $toast_data = $this->session->flashdata('toast');
            // Jika tipenya adalah 'success', pastikan iconnya benar agar berwarna hijau
            $icon = ($toast_data['type'] == 'success') ? 'success' : $toast_data['type'];
            ?>
            Toast.fire({
                icon: '<?= $icon; ?>', // Ini akan memaksa ikon menjadi 'success' (hijau)
                title: '<?= $toast_data['message']; ?>'
            });
        <?php endif; ?>
    });

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    function tambahPendaftar() {
        $('#formPendaftar')[0].reset();
        $('#modalPendaftar').modal('show');
    }

    function hapusPendaftar(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data pendaftar ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url("pendaftar/hapus/"); ?>' + id;
            }
        });
    }
</script>