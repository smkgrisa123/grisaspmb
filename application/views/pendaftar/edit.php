<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="m-0 fw-bold text-primary"><i class="fa fa-user-edit me-2"></i> Edit Data Pendaftar</h6>

                    <small class="text-muted d-block">
                        No. Pendaftaran: <strong><?= $pendaftar->no_pendaftaran; ?></strong>
                        | Nama: <strong><?= $pendaftar->nama_lengkap; ?></strong>
                    </small>
                </div>
                <a href="<?= base_url('pendaftar'); ?>" class="btn btn-secondary btn-sm"><i class="fa fa-arrow-left me-1"></i> Kembali</a>
            </div>
            <div class="card-body">
                <form action="<?= base_url('pendaftar/update'); ?>" method="post">
                    <input type="hidden" name="id_pendaftar" value="<?= $pendaftar->id_pendaftar; ?>">

                    <!-- NAV TABS (5 TAB) -->
                    <ul class="nav nav-tabs mb-4" id="editTab" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active fw-bold" id="biodata-tab" data-bs-toggle="tab" data-bs-target="#biodata" type="button" role="tab">
                                <i class="fa fa-id-card me-1"></i> 1. Biodata Diri
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link fw-bold" id="sekolah-tab" data-bs-toggle="tab" data-bs-target="#sekolah" type="button" role="tab">
                                <i class="fa fa-school me-1"></i> 2. Asal Sekolah
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link fw-bold" id="ortu-tab" data-bs-toggle="tab" data-bs-target="#ortu" type="button" role="tab">
                                <i class="fa fa-users me-1"></i> 3. Data Orang Tua / Wali
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link fw-bold" id="pembayaran-tab" data-bs-toggle="tab" data-bs-target="#pembayaran" type="button" role="tab">
                                <i class="fa fa-wallet me-1"></i> 4. Pembayaran
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link fw-bold" id="verval-tab" data-bs-toggle="tab" data-bs-target="#verval" type="button" role="tab">
                                <i class="fa fa-check-circle me-1"></i> 5. Verval
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link fw-bold" id="lain-lain-tab" data-bs-toggle="tab" data-bs-target="#lain-lain" type="button" role="tab">
                                <i class="fa fa-ellipsis-h me-1"></i> 6. Lain-lain
                            </button>
                        </li>
                    </ul>

                    <!-- TAB CONTENTS -->
                    <div class="tab-content" id="editTabContent">

                        <!-- TAB 1: BIODATA DIRI -->
                        <div class="tab-pane fade show active" id="biodata" role="tabpanel">
                            <!-- [DIUBAH UNTUK BENDAHARA] Menambahkan tag fieldset dengan pengecekan peran bendahara. 
         Jika yang login adalah bendahara, form otomatis terkunci (disabled) dan read-only. -->
                            <fieldset <?= (in_array(strtolower(trim($this->session->userdata('peran'))), ['ketua_spmb', 'bendahara'])) ? 'disabled style="pointer-events: none; opacity: 0.8;"' : ''; ?>>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">1. Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" value="<?= $pendaftar->nama_lengkap; ?>" required>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">2. Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control" value="<?= $pendaftar->tempat_lahir; ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">Tanggal Lahir</label>
                                        <input type="date" name="tgl_lahir" class="form-control" value="<?= $pendaftar->tgl_lahir; ?>" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">3. Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-select" required>
                                        <option value="L" <?= $pendaftar->jenis_kelamin == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                                        <option value="P" <?= $pendaftar->jenis_kelamin == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                                    </select>
                                </div>

                                <!-- ALAMAT LENGKAP -->
                                <div class="card bg-light border-0 p-3 mb-3">
                                    <label class="form-label fw-bold text-dark mb-2"><i class="fa fa-map-marker-alt me-1"></i> 4. Alamat Lengkap</label>
                                    <div class="row">
                                        <div class="col-md-6 mb-2">
                                            <input type="text" name="jalan" class="form-control" placeholder="Jalan / Gang" value="<?= $pendaftar->jalan; ?>">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <input type="text" name="dusun" class="form-control" placeholder="Dusun / Lingkungan" value="<?= $pendaftar->dusun; ?>">
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <input type="text" name="rt_rw" class="form-control" placeholder="RT / RW" value="<?= $pendaftar->rt_rw; ?>">
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <input type="text" name="desa" class="form-control" placeholder="Desa / Kelurahan" value="<?= $pendaftar->desa; ?>">
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <input type="text" name="kecamatan" class="form-control" placeholder="Kecamatan" value="<?= $pendaftar->kecamatan; ?>">
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <input type="text" name="kabupaten" class="form-control" placeholder="Kabupaten / Kota" value="<?= $pendaftar->kabupaten; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">5. Agama</label>
                                        <select name="agama" class="form-select" required>
                                            <option value="">-- Pilih Agama --</option>
                                            <?php $agama_list = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Khonghucu']; ?>
                                            <?php foreach ($agama_list as $ag): ?>
                                                <option value="<?= $ag; ?>" <?= $pendaftar->agama == $ag ? 'selected' : ''; ?>><?= $ag; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">6. No. KK (Kartu Keluarga)</label>
                                        <input type="text" name="no_kk" maxlength="16" class="form-control" placeholder="16 Digit No. KK" value="<?= $pendaftar->no_kk; ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">7. NIK</label>
                                        <input type="text" name="nik" maxlength="16" class="form-control" value="<?= $pendaftar->nik; ?>" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-semibold">8. No. HP / WhatsApp</label>
                                        <input type="text" name="no_hp" class="form-control" value="<?= $pendaftar->no_hp; ?>" required>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">9. Jurusan Pilihan</label>
                                    <select name="id_jurusan" class="form-select" required>
                                        <?php foreach ($jurusan as $j): ?>
                                            <option value="<?= $j->id_jurusan; ?>" <?= $j->id_jurusan == $pendaftar->id_jurusan ? 'selected' : ''; ?>><?= $j->nama_jurusan; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </fieldset> <!-- [DIUBAH UNTUK BENDAHARA] Penutup tag fieldset -->
                        </div>

                        <!-- TAB 2: ASAL SEKOLAH -->
                        <div class="tab-pane fade" id="sekolah" role="tabpanel">
                            <fieldset <?= (in_array(strtolower(trim($this->session->userdata('peran'))), ['ketua_spmb', 'bendahara'])) ? 'disabled style="pointer-events: none; opacity: 0.8;"' : ''; ?>>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">1. Nama Sekolah Asal</label>
                                    <select name="id_sekolah" id="id_sekolah" class="form-select" required>
                                        <option value="" data-alamat="">-- Pilih Sekolah Asal --</option>
                                        <?php foreach ($asal_sekolah as $s): ?>
                                            <option value="<?= $s->id_sekolah; ?>"
                                                data-alamat="<?= isset($s->alamat_sekolah) ? $s->alamat_sekolah : (isset($s->alamat) ? $s->alamat : '-'); ?>"
                                                <?= $s->id_sekolah == $pendaftar->id_sekolah ? 'selected' : ''; ?>>
                                                <?= $s->nama_sekolah; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">2. Alamat Sekolah</label>
                                    <textarea id="alamat_sekolah" class="form-control bg-light" rows="3" readonly placeholder="Alamat sekolah akan terisi otomatis"></textarea>
                                </div>
                            </fieldset> <!-- [DIUBAH UNTUK BENDAHARA] Penutup tag fieldset -->
                        </div>

                        <!-- TAB 3: DATA ORANG TUA / WALI -->
                        <div class="tab-pane fade" id="ortu" role="tabpanel">
                            <fieldset <?= (in_array(strtolower(trim($this->session->userdata('peran'))), ['ketua_spmb', 'bendahara'])) ? 'disabled style="pointer-events: none; opacity: 0.8;"' : ''; ?>>
                                <!-- DATA ORANG TUA KANDUNG -->
                                <div class="bg-success text-white px-3 py-1 fw-bold rounded-1 mb-3 style-header d-inline-block" style="background-color: #15803d !important;">
                                    DATA ORANG TUA KANDUNG
                                </div>

                                <div class="row">
                                    <!-- DATA AYAH -->
                                    <div class="col-md-6 border-end">
                                        <h6 class="fw-bold text-dark border-bottom pb-2">DATA AYAH</h6>

                                        <div class="mb-3">
                                            <label class="form-label">Nama</label>
                                            <input type="text" name="nama_ayah" class="form-control" value="<?= $pendaftar->nama_ayah; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label d-block">Status</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status_ayah" id="ayah_hidup" value="Hidup" <?= $pendaftar->status_ayah != 'Meninggal' ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="ayah_hidup">Hidup</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status_ayah" id="ayah_meninggal" value="Meninggal" <?= $pendaftar->status_ayah == 'Meninggal' ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="ayah_meninggal">Meninggal</label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Pekerjaan</label>
                                            <input type="text" name="pekerjaan_ayah" class="form-control" value="<?= $pendaftar->pekerjaan_ayah; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <textarea name="alamat_ayah" class="form-control" rows="3"><?= $pendaftar->alamat_ayah; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">No. Hp</label>
                                            <input type="text" name="no_hp_ayah" class="form-control" value="<?= $pendaftar->no_hp_ayah; ?>">
                                        </div>
                                    </div>

                                    <!-- DATA IBU -->
                                    <div class="col-md-6">
                                        <h6 class="fw-bold text-dark border-bottom pb-2">DATA IBU</h6>

                                        <div class="mb-3">
                                            <label class="form-label">Nama</label>
                                            <input type="text" name="nama_ibu" class="form-control" value="<?= $pendaftar->nama_ibu; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label d-block">Status</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status_ibu" id="ibu_hidup" value="Hidup" <?= $pendaftar->status_ibu != 'Meninggal' ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="ibu_hidup">Hidup</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status_ibu" id="ibu_meninggal" value="Meninggal" <?= $pendaftar->status_ibu == 'Meninggal' ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="ibu_meninggal">Meninggal</label>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Pekerjaan</label>
                                            <input type="text" name="pekerjaan_ibu" class="form-control" value="<?= $pendaftar->pekerjaan_ibu; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <textarea name="alamat_ibu" class="form-control" rows="3"><?= $pendaftar->alamat_ibu; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">No. Hp</label>
                                            <input type="text" name="no_hp_ibu" class="form-control" value="<?= $pendaftar->no_hp_ibu; ?>">
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                <!-- DATA WALI -->
                                <div class="bg-success text-white px-3 py-1 fw-bold rounded-1 mb-3 style-header d-inline-block" style="background-color: #15803d !important;">
                                    DATA WALI
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Nama</label>
                                            <input type="text" name="nama_wali" class="form-control" value="<?= $pendaftar->nama_wali; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Pekerjaan</label>
                                            <input type="text" name="pekerjaan_wali" class="form-control" value="<?= $pendaftar->pekerjaan_wali; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Alamat</label>
                                            <textarea name="alamat_wali" class="form-control" rows="3"><?= $pendaftar->alamat_wali; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">No Hp</label>
                                            <input type="text" name="no_hp_wali" class="form-control" value="<?= $pendaftar->no_hp_wali; ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Status Hubungan</label>
                                            <input type="text" name="status_hubungan_wali" class="form-control" placeholder="Contoh: Paman, Kakek, Kakak, dll" value="<?= $pendaftar->status_hubungan_wali; ?>">
                                        </div>
                                    </div>
                                </div>
                            </fieldset> <!-- [DIUBAH UNTUK BENDAHARA] Penutup tag fieldset -->

                        </div>
                        <!-- TAB 4: PEMBAYARAN -->
                        <div class="tab-pane fade" id="pembayaran" role="tabpanel">

                            <!-- [DIUBAH 1] Menggunakan 'peran' sesuai database, dan mengunci fieldset jika rolenya adalah sekretaris -->
                            <!-- Jika Anda ingin selain administrator & bendahara tidak bisa mengedit, bisa disesuaikan kondisinya -->
                            <fieldset <?= (strtolower(trim($this->session->userdata('peran'))) != 'administrator' && strtolower(trim($this->session->userdata('peran'))) != 'bendahara') ? 'disabled style="pointer-events: none; opacity: 0.8;"' : ''; ?>>
                                <div class="row">

                                    <!-- 1. BIAYA REGISTRASI PENDAFTARAN -->
                                    <div class="col-md-6 mb-4">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-header bg-primary text-white font-weight-bold">
                                                <i class="fa fa-receipt me-1"></i> 1. Biaya Registrasi Pendaftaran
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Nominal Pembayaran</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light fw-bold">Rp</span>
                                                        <input type="text" name="nominal_reg" id="nominal_reg" class="form-control rupiah" placeholder="0" value="<?= isset($pembayaran->nominal_reg) ? number_format($pembayaran->nominal_reg, 0, ',', '.') : ''; ?>">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Tanggal Pembayaran</label>
                                                    <input type="date" name="tgl_reg" id="tgl_reg" class="form-control" value="<?= isset($pembayaran->tgl_reg) ? $pembayaran->tgl_reg : date('Y-m-d'); ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Jam Pembayaran (Otomatis)</label>
                                                    <?php
                                                    $jam_reg_db = isset($pembayaran->jam_reg) ? $pembayaran->jam_reg : '';
                                                    if (empty($jam_reg_db) || $jam_reg_db == '00:00:00' || $jam_reg_db == '00:00') {
                                                        $jam_reg_val = date('H:i');
                                                    } else {
                                                        $jam_reg_val = date('H:i', strtotime($jam_reg_db));
                                                    }
                                                    $jam_reg_tampil = date('H.i', strtotime($jam_reg_val));
                                                    ?>
                                                    <input type="text" name="jam_reg" id="jam_reg" class="form-control bg-light" value="<?= $jam_reg_val; ?>" readonly>
                                                </div>

                                                <!-- ALERT BUKTI BAYAR REGISTRASI -->
                                                <?php if (!empty($pembayaran->nominal_reg) && $pembayaran->nominal_reg > 0): ?>
                                                    <div class="alert alert-success mt-3 mb-0 border-0 shadow-sm" role="alert">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-check-circle fa-2x me-3 text-success"></i>
                                                            <div>
                                                                <small class="fw-bold d-block text-uppercase text-success">Status: Pembayaran Diterima</small>
                                                                <span>Pendaftar atas nama <strong><?= isset($pendaftar->nama_lengkap) ? $pendaftar->nama_lengkap : 'Siswa'; ?></strong> telah membayar biaya registrasi pada tanggal <strong><?= date('d-m-Y', strtotime($pembayaran->tgl_reg)); ?></strong> jam <strong><?= $jam_reg_tampil; ?> WIB</strong>.</span>
                                                            </div>
                                                        </div>
                                                        <hr class="my-2">
                                                        <div class="text-end">
                                                            <div class="text-end">
                                                                <a href="<?= base_url('pendaftar/cetak_kwitansi_reg/' . (isset($pendaftar->id_pendaftar) ? $pendaftar->id_pendaftar : '')); ?>" target="_blank" class="btn btn-sm btn-outline-success">
                                                                    <i class="fa fa-print me-1"></i> Cetak Bukti Kwitansi
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <!-- Tombol Batalkan Registrasi -->
                                                <!-- [DIUBAH 2] Tombol aksi ubah/hapus disembunyikan jika yang login bukan Administrator/Bendahara -->
                                                <?php if (strtolower(trim($this->session->userdata('peran'))) == 'administrator' || strtolower(trim($this->session->userdata('peran'))) == 'bendahara'): ?>
                                                    <div class="mt-2 text-end">
                                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="batalkanReg()">
                                                            <i class="fa fa-times me-1"></i> Batalkan Pembayaran
                                                        </button>
                                                    </div>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- 2. BIAYA DAFTAR ULANG -->
                                    <div class="col-md-6 mb-4">
                                        <div class="card border-0 shadow-sm h-100">
                                            <div class="card-header bg-success text-white font-weight-bold">
                                                <i class="fa fa-money-check-alt me-1"></i> 2. Biaya Daftar Ulang
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Periode / Gelombang Daftar Ulang</label>
                                                    <select name="id_gelombang" id="id_gelombang" class="form-select">
                                                        <option value="" <?= (empty($pembayaran->nominal_du) || $pembayaran->nominal_du == 0) ? 'selected' : ''; ?>>
                                                            -- Pilih Gelombang --
                                                        </option>
                                                        <?php foreach ($gelombang as $g): ?>
                                                            <?php
                                                            $isSelected = (!empty($pembayaran->nominal_du) && $pembayaran->nominal_du > 0 && isset($pembayaran->id_gelombang) && $pembayaran->id_gelombang == $g->id_gelombang) ? 'selected' : '';
                                                            ?>
                                                            <option value="<?= $g->id_gelombang; ?>"
                                                                data-nominal="<?= $g->biaya_daftar_ulang; ?>"
                                                                <?= $isSelected; ?>>
                                                                <?= $g->nama_gelombang; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Nominal Biaya Daftar Ulang</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text bg-light fw-bold">Rp</span>
                                                        <input type="text" name="nominal_du" id="nominal_du" class="form-control rupiah" placeholder="0" value="<?= isset($pembayaran->nominal_du) ? number_format($pembayaran->nominal_du, 0, ',', '.') : ''; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Tanggal Pembayaran</label>
                                                    <input type="date" name="tgl_du" id="tgl_du" class="form-control" value="<?= isset($pembayaran->tgl_du) ? $pembayaran->tgl_du : date('Y-m-d'); ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Jam Pembayaran (Otomatis)</label>
                                                    <?php
                                                    $jam_du_db = isset($pembayaran->jam_du) ? $pembayaran->jam_du : '';
                                                    if (empty($jam_du_db) || $jam_du_db == '00:00:00' || $jam_du_db == '00:00') {
                                                        $jam_du_val = date('H:i');
                                                    } else {
                                                        $jam_du_val = date('H:i', strtotime($jam_du_db));
                                                    }
                                                    $jam_du_tampil = date('H.i', strtotime($jam_du_val));
                                                    ?>
                                                    <input type="text" name="jam_du" id="jam_du" class="form-control bg-light" value="<?= $jam_du_val; ?>" readonly>
                                                </div>

                                                <!-- ALERT BUKTI BAYAR DAFTAR ULANG -->
                                                <?php if (!empty($pembayaran->nominal_du) && $pembayaran->nominal_du > 0): ?>
                                                    <div class="alert alert-success mt-3 mb-0 border-0 shadow-sm" role="alert">
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-check-circle fa-2x me-3 text-success"></i>
                                                            <div>
                                                                <small class="fw-bold d-block text-uppercase text-success">Status: Daftar Ulang Lunas</small>
                                                                <span>Pendaftar atas nama <strong><?= isset($pendaftar->nama_lengkap) ? $pendaftar->nama_lengkap : 'Siswa'; ?></strong> telah membayar biaya daftar ulang pada tanggal <strong><?= date('d-m-Y', strtotime($pembayaran->tgl_du)); ?></strong> jam <strong><?= $jam_du_tampil; ?> WIB</strong>.</span>
                                                            </div>
                                                        </div>
                                                        <hr class="my-2">
                                                        <div class="text-end">
                                                            <div class="text-end">
                                                                <div class="text-end">
                                                                    <a href="<?= base_url('pendaftar/cetak_kwitansi_du/' . (isset($pendaftar->id_pendaftar) ? $pendaftar->id_pendaftar : '')); ?>" target="_blank" class="btn btn-sm btn-outline-primary">
                                                                        <i class="fa fa-print me-1"></i> Cetak Kwitansi DU
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                                <!-- Tombol Batalkan Daftar Ulang -->
                                                <!-- [DIUBAH 3] Tombol aksi dibungkus pengecekan agar sekretaris tidak bisa mengeksekusi pembatalan -->
                                                <?php if (strtolower(trim($this->session->userdata('peran'))) == 'administrator' || strtolower(trim($this->session->userdata('peran'))) == 'bendahara'): ?>
                                                    <button type="button" class="btn btn-danger btn-sm mt-2" onclick="batalkanDu()">
                                                        <i class="fa fa-times"></i> Batalkan Daftar Ulang
                                                    </button>
                                                <?php endif; ?>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </fieldset>
                        </div>
                        <!-- TAB 5: VERVAL -->
                        <div class="tab-pane fade" id="verval" role="tabpanel">
                            <fieldset <?= (in_array(strtolower(trim($this->session->userdata('peran'))), ['ketua_spmb', 'bendahara'])) ? 'disabled style="pointer-events: none; opacity: 0.8;"' : ''; ?>>
                                <!-- CHECKLIST PERSYARATAN -->
                                <div class="card border-0 bg-light p-3 mb-4">
                                    <h6 class="fw-bold text-dark mb-3"><i class="fa fa-tasks me-2"></i> Checklist Kelengkapan Berkas / Persyaratan</h6>

                                    <div class="table-responsive">
                                        <table class="table table-bordered bg-white align-middle">
                                            <thead class="table-light">
                                                <tr>
                                                    <th width="5%" class="text-center">No</th>
                                                    <th>Nama Persyaratan</th>
                                                    <th width="25%" class="text-center">Status Penyerahan</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                // Cek apakah nominal registrasi sudah diisi / > 0
                                                $sudah_bayar_reg = (!empty($pembayaran->nominal_reg) && $pembayaran->nominal_reg > 0);

                                                foreach ($master_syarat as $syarat):
                                                    // Mengambil status dari DB jika ada
                                                    $st = isset($status_syarat[$syarat->id_persyaratan]) ? $status_syarat[$syarat->id_persyaratan] : 'Belum';

                                                    // Jika nama persyaratan berisi kata "Registrasi" atau "Pembayaran", dan siswa SUDAH bayar,
                                                    // paksa status $st menjadi 'Sudah' secara otomatis.
                                                    if ((stripos($syarat->nama_persyaratan, 'Registrasi') !== false || $syarat->id_persyaratan == 1) && $sudah_bayar_reg) {
                                                        $st = 'Sudah';
                                                    }
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++; ?></td>
                                                        <td><?= $syarat->nama_persyaratan; ?></td>
                                                        <td class="text-center">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="syarat[<?= $syarat->id_persyaratan; ?>]"
                                                                    id="syarat_sudah_<?= $syarat->id_persyaratan; ?>"
                                                                    value="Sudah"
                                                                    <?= $st == 'Sudah' ? 'checked' : ''; ?>>
                                                                <label class="form-check-label text-success fw-semibold" for="syarat_sudah_<?= $syarat->id_persyaratan; ?>">Sudah</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="syarat[<?= $syarat->id_persyaratan; ?>]"
                                                                    id="syarat_belum_<?= $syarat->id_persyaratan; ?>"
                                                                    value="Belum"
                                                                    <?= $st == 'Belum' ? 'checked' : ''; ?>>
                                                                <label class="form-check-label text-danger fw-semibold" for="syarat_belum_<?= $syarat->id_persyaratan; ?>">Belum</label>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Bagian Tambahan: Input Catatan Verval -->
                                <div class="form-group mb-3">
                                    <label for="catatan_verval" class="font-weight-bold">
                                        <i class="fas fa-sticky-note text-warning"></i> Catatan / Alasan Belum Verval (Opsional)
                                    </label>
                                    <textarea name="catatan_verval" id="catatan_verval" class="form-control" rows="3"
                                        placeholder="Tuliskan jika ada berkas yang kurang, misal: Fotocopy Ijazah belum dilegalisir / Pas foto kurang 1 lembar..."><?= isset($pendaftar->catatan_verval) ? $pendaftar->catatan_verval : ''; ?></textarea>
                                    <small class="text-muted">Catatan ini akan dibaca oleh pendaftar untuk mengetahui kekurangan berkas mereka.</small>
                                </div>
                                <!-- STATUS FINAL VERVAL -->
                                <div class="card bg-light border-0 p-3">
                                    <label class="form-label fw-bold text-dark mb-2"><i class="fa fa-user-check me-1"></i> Status Verifikasi Akhir</label>
                                    <select name="verval" class="form-select fw-bold" required>
                                        <option value="Belum Verval" <?= $pendaftar->verval == 'Belum Verval' ? 'selected' : ''; ?>>Belum Verval</option>
                                        <option value="Sudah Verval" <?= $pendaftar->verval == 'Sudah Verval' ? 'selected' : ''; ?>>Sudah Verval (Berkas Lengkap)</option>
                                    </select>
                                </div>
                            </fieldset>
                        </div>

                        <div class="tab-pane fade" id="lain-lain" role="tabpanel" aria-labelledby="lain-lain-tab">
                            <fieldset <?= (in_array(strtolower(trim($this->session->userdata('peran'))), ['ketua_spmb', 'bendahara'])) ? 'disabled style="pointer-events: none; opacity: 0.8;"' : ''; ?>>
                                <div class="p-3">
                                    <h4 class="mb-3">Lain-lain</h4>

                                    <div class="mb-3">
                                        <label for="marketing" class="form-label fw-bold">Marketing / Pembawa Formulir</label>
                                        <input type="text" class="form-control" id="marketing" name="marketing" placeholder="Masukkan nama marketing atau pihak yang membawa formulir" value="<?= isset($pendaftar->marketing) ? $pendaftar->marketing : ''; ?>">
                                    </div>

                                </div>
                            </fieldset>
                        </div>
                    </div>

                    <hr class="my-4">
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4"><i class="fa fa-save me-1"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // =========================================================
    // 1. FUNGSI GLOBAL UNTUK TOMBOL (Harus di luar document.ready)
    // =========================================================

    // Fungsi Utama Pembatalan Registrasi
    function batalkanReg() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Batalkan Pembayaran Registrasi?',
                text: "Nominal akan direset dan status verval akan menjadi Belum.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Batalkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    eksekusiBatalReg();
                }
            });
        } else {
            // Fallback jika SweetAlert tidak terdeteksi
            if (confirm('Apakah Anda yakin ingin membatalkan pembayaran registrasi ini?')) {
                eksekusiBatalReg();
            }
        }
    }

    function eksekusiBatalReg() {
        // Reset nominal dan jam registrasi
        let nominalInput = document.querySelector('input[name="nominal_reg"]');
        if (nominalInput) {
            nominalInput.value = '0';
        }

        let jamInput = document.getElementById('jam_reg');
        if (jamInput) {
            jamInput.value = '00:00';
        }

        // Sembunyikan alert bukti bayar registrasi
        let alertReg = document.getElementById('alert_bukti_reg');
        if (alertReg) {
            alertReg.style.display = 'none';
        }

        // Otomatis ubah status radio Verval menjadi "Belum" untuk baris Pembayaran Registrasi
        $('input[type="radio"][name^="syarat"]').each(function() {
            let row = $(this).closest('tr');
            if (row.find('td').text().toLowerCase().includes('registrasi')) {
                if ($(this).val() === 'Belum') {
                    $(this).prop('checked', true);
                }
            }
        });
    }

    // Fungsi Utama Pembatalan Daftar Ulang (DU)
    function batalkanDu() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Batalkan Daftar Ulang?',
                text: "Nominal daftar ulang akan direset menjadi 0.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Batalkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    let nomDu = document.querySelector('input[name="nominal_du"]');
                    if (nomDu) {
                        nomDu.value = '0';
                    }

                    let jamDu = document.getElementById('jam_du');
                    if (jamDu) {
                        jamDu.value = '00:00';
                    }

                    let alertDu = document.getElementById('alert_bukti_du');
                    if (alertDu) {
                        alertDu.style.display = 'none';
                    }
                }
            });
        }
    }


    // =========================================================
    // 2. SCRIPT UTAMA KETIKA HALAMAN DIMUAT (document.ready)
    // =========================================================
    $(document).ready(function() {

        // Update Alamat Sekolah
        function updateAlamatSekolah() {
            var alamat = $('#id_sekolah option:selected').data('alamat');
            $('#alamat_sekolah').val(alamat ? alamat : '-');
        }

        updateAlamatSekolah();
        $('#id_sekolah').on('change', updateAlamatSekolah);


        // Fungsi Format Rupiah
        function formatRupiah(angka) {
            if (!angka) return '';
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        }


        // Format Rupiah Manual saat Ketik
        $(document).on('keyup', '.rupiah', function() {
            this.value = formatRupiah(this.value);
        });


        // Otomatis Isi Nominal Daftar Ulang Berdasarkan Gelombang
        function updateNominalGelombang() {
            var nominal = $('#id_gelombang option:selected').data('nominal');
            if (nominal && nominal != 0) {
                $('#nominal_du').val(formatRupiah(nominal));
            } else if (!$('#id_gelombang').val()) {
                $('#nominal_du').val('');
            }
        }

        // Jalankan saat dropdown diubah
        $('#id_gelombang').on('change', updateNominalGelombang);

        // Jalankan otomatis saat halaman awal di-load (jika edit data & gelombang sudah ada)
        if ($('#id_gelombang').val() && !$('#nominal_du').val()) {
            updateNominalGelombang();
        }

    });
</script>