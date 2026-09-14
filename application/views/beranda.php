<div class="container-fluid p-3">

    <!-- 1. KARTU STATISTIK ATAS -->
    <div class="row g-3 mb-4">

        <!-- Pendaftar -->
        <div class="col-xl-2 col-md-4 col-6">
            <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="d-block small text-uppercase fw-semibold mb-1" style="font-size: 11px; opacity: 0.8;">Pendaftar</span>
                        <h3 class="fw-bold mb-0"><?= $total_pendaftar; ?></h3>
                    </div>
                    <i class="fas fa-users fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Sudah Verval -->
        <div class="col-xl-2 col-md-4 col-6">
            <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #1cc88a 0%, #13855c 100%);">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="d-block small text-uppercase fw-semibold mb-1" style="font-size: 11px; opacity: 0.8;">Sudah Verval</span>
                        <h3 class="fw-bold mb-0"><?= $sudah_verval; ?></h3>
                    </div>
                    <i class="fas fa-check-circle fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Laki-laki (Sudah Verval) -->
        <div class="col-xl-2 col-md-4 col-6">
            <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #36b9cc 0%, #258391 100%);">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="d-block small text-uppercase fw-semibold mb-1" style="font-size: 10px; opacity: 0.8;">Laki-Laki (Verval)</span>
                        <h3 class="fw-bold mb-0"><?= $jumlah_l; ?></h3>
                    </div>
                    <i class="fas fa-male fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Perempuan (Sudah Verval) -->
        <div class="col-xl-2 col-md-4 col-6">
            <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #f6c23e 0%, #dda20a 100%);">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="d-block small text-uppercase fw-semibold mb-1" style="font-size: 10px; opacity: 0.8;">Perempuan (Verval)</span>
                        <h3 class="fw-bold mb-0"><?= $jumlah_p; ?></h3>
                    </div>
                    <i class="fas fa-female fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Bayar Registrasi -->
        <div class="col-xl-2 col-md-4 col-6">
            <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #e74a3b 0%, #be2617 100%);">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="d-block small text-uppercase fw-semibold mb-1" style="font-size: 11px; opacity: 0.8;">Bayar Reg.</span>
                        <h3 class="fw-bold mb-0"><?= $bayar_reg; ?></h3>
                    </div>
                    <i class="fas fa-money-bill-wave fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Bayar Daftar Ulang -->
        <div class="col-xl-2 col-md-4 col-6">
            <div class="card border-0 shadow-sm text-white h-100" style="background: linear-gradient(135deg, #6f42c1 0%, #4a2d83 100%);">
                <div class="card-body d-flex align-items-center justify-content-between p-3">
                    <div>
                        <span class="d-block small text-uppercase fw-semibold mb-1" style="font-size: 11px; opacity: 0.8;">Daftar Ulang</span>
                        <h3 class="fw-bold mb-0"><?= $bayar_du; ?></h3>
                    </div>
                    <i class="fas fa-wallet fa-2x opacity-50"></i>
                </div>
            </div>
        </div>

    </div>

    <!-- 2. KONTEN UTAMA (KIRI & KANAN) -->
    <div class="row g-3">

        <!-- KOLOM KIRI: Profil Sekolah & Grafik Rekap Jurusan -->
        <div class="col-lg-7">

            <!-- Card Profil Sekolah -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="fw-bold m-0 text-dark"><i class="fas fa-school me-2 text-primary"></i> SMKS PGRI PESANGGARAN</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <!-- Informasi Detail Sekolah -->
                        <div class="col-md-7">
                            <table class="table table-borderless table-sm small mb-0">
                                <tr>
                                    <td class="text-muted fw-semibold" style="width: 40%;">NPSN</td>
                                    <td>: 20525594</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold">Bentuk Pendidikan</td>
                                    <td>: SMK</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold">Status</td>
                                    <td>: Swasta</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold">Kecamatan</td>
                                    <td>: Kec. Pesanggaran</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold">Kabupaten</td>
                                    <td>: Kab. Banyuwangi</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold">Provinsi</td>
                                    <td>: Prov. Jawa Timur</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold">Kepala Sekolah</td>
                                    <td>: Umi Qowiyah</td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold">Petugas</td>
                                    <td>: <?= $nama_operator; ?></td>
                                </tr>
                                <tr>
                                    <td class="text-muted fw-semibold">Username</td>
                                    <!-- [DIUBAH] Mengambil data username/email langsung dari session login CodeIgniter secara dinamis -->
                                    <td>: <?= $this->session->userdata('username'); ?></td>
                                </tr>
                            </table>
                        </div>

                        <!-- Banner Logo -->
                        <!-- [DIUBAH] Kelas bg-dark dan background gradient dihapus agar latar belakangnya transparan / putih bersih -->
                        <div class="col-md-5 d-flex align-items-center justify-content-center rounded-3 p-3 text-center">
                            <div>
                                <!-- [DIUBAH] max-height diperbesar lagi menjadi 180px (silakan ubah ke 200px jika masih kurang besar) -->
                                <img src="<?= base_url('assets/img/logospmb.jpg'); ?>" alt="Logo SMK Grisa" class="mb-2 img-fluid" style="max-height: 180px; width: auto; object-fit: contain;">

                                <!-- <h6 class="fw-bold text-uppercase mb-1 text-dark" style="font-size: 14px;">SPMB SMK GRISA</h6> -->
                                <p class="small text-muted mb-0" style="font-size: 12px;">Sistem Penerimaan Murid Baru Profesional & Terintegrasi</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light py-2 d-flex gap-2">

                </div>
            </div>

            <!-- Card Grafik: Rekap Jumlah Pendaftar Berdasarkan Jurusan (Di bawah profil sebelah kiri) -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold m-0 text-dark fs-6">
                        <i class="fas fa-chart-pie me-2 text-primary"></i> Rekap Jumlah Pendaftar Berdasarkan Jurusan
                    </h5>
                    <button class="btn btn-primary btn-sm" id="downloadChart" style="font-size: 11px;"><i class="fas fa-download me-1"></i> Unduh Grafik</button>
                </div>
                <div class="card-body">
                    <!-- Kanvas Grafik Donat -->
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-7" style="max-height: 280px; position: relative;">
                            <canvas id="jurusanChart"></canvas>
                        </div>
                    </div>

                    <!-- Indikator Bar Progress Detail per Jurusan -->
                    <?php if (!empty($rekap_jurusan)): ?>
                        <?php
                        $colors = ['bg-primary', 'bg-success', 'bg-warning', 'bg-info', 'bg-danger', 'bg-secondary', 'bg-dark'];
                        $i = 0;
                        foreach ($rekap_jurusan as $row):
                            $colorClass = $colors[$i % count($colors)];
                            $total_all = ($total_keseluruhan_pendaftar > 0) ? $total_keseluruhan_pendaftar : 1;
                            $persen = round(($row['jml'] / $total_all) * 100, 2);
                        ?>
                            <div class="mb-2 small">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="fw-bold text-dark"><?= $row['nama_jurusan']; ?></span>
                                    <span class="fw-semibold text-muted"><?= $row['jml']; ?> (<span class="text-primary"><?= $persen; ?>%</span>)</span>
                                </div>
                                <div class="progress" style="height: 6px;">
                                    <div class="progress-bar <?= $colorClass; ?>" role="progressbar" style="width: <?= $persen; ?>%;" aria-valuenow="<?= $row['jml']; ?>" aria-valuemin="0" aria-valuemax="<?= $total_all; ?>"></div>
                                </div>
                            </div>
                        <?php $i++;
                        endforeach; ?>
                    <?php else: ?>
                        <p class="text-center text-muted small">Belum ada data jurusan.</p>
                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN: Sambutan, Tabel Jurusan & Informasi Sistem -->
        <div class="col-lg-5">

            <!-- Kotak Sambutan -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <p class="small text-muted mb-1">Kepada Yth.</p>
                    <p class="small fw-bold text-dark mb-1">Panitia SPMB SMKS PGRI PESANGGARAN
                        <td> <?= $nama_operator; ?></td>
                    </p>
                    <p class="small text-secondary mb-3">Assalamualaikum, Selamat Siang, punten ngerepotin sebentar. Kalau ada waktu luang, mohon bantuannya buat cek data pendaftaran siswa baru sama verifikasi berkasnya secara berkala ya,di menu yang sudah ada. Makasih banyak sebelumnya.</p>
                    <div class="d-flex gap-2">
                        <div class="d-flex gap-2">
                            <a href="<?= base_url('pendaftar'); ?>" class="btn btn-secondary btn-sm flex-fill small text-decoration-none text-center" style="font-size: 11px;"><i class="fas fa-users me-1"></i> Data Pendaftar</a>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Card Jumlah Peserta Didik per Jurusan (Tabel di Kanan) -->
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                    <h5 class="fw-bold m-0 text-dark fs-6">
                        <i class="fas fa-users me-2 text-primary"></i> Jumlah Peserta Didik per Jurusan
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle mb-0 small">
                            <thead class="table-light text-uppercase">
                                <tr>
                                    <th class="py-2 ps-3" style="width: 8%;">No</th>
                                    <th class="py-2">Nama Jurusan</th>
                                    <th class="py-2 text-center" style="width: 12%;">L</th>
                                    <th class="py-2 text-center" style="width: 12%;">P</th>
                                    <th class="py-2 text-center" style="width: 12%;">Jml</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($rekap_jurusan)): ?>
                                    <?php $no = 1;
                                    foreach ($rekap_jurusan as $row): ?>
                                        <tr>
                                            <td class="ps-3 fw-semibold"><?= $no++; ?></td>
                                            <td class="fw-bold text-dark"><?= $row['nama_jurusan']; ?></td>
                                            <td class="text-center"><span class="badge bg-info text-dark px-2"><?= $row['l']; ?></span></td>
                                            <td class="text-center"><span class="badge bg-warning text-dark px-2"><?= $row['p']; ?></span></td>
                                            <td class="text-center fw-bold text-primary"><?= $row['jml']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-3 text-muted">Belum ada data jurusan.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Kotak Informasi Sistem -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white py-2 border-bottom">
                    <h6 class="fw-bold m-0 text-dark small"><i class="fas fa-info-circle me-2 text-primary"></i> Informasi Sistem</h6>
                </div>
                <div class="card-body small">
                    <ul class="list-unstyled mb-3 text-muted" style="line-height: 1.8;">
                        <li>• Versi Aplikasi : <strong>v.2026.a</strong></li>
                        <li>• Versi Database : <strong class="text-danger">2.104 (PRODUCTION)</strong></li>
                        <li>• Status Sistem : <strong class="text-success">Online & Normal</strong></li>
                    </ul>
                    <button class="btn btn-warning btn-sm w-100 fw-bold text-dark" style="font-size: 12px;"><i class="fas fa-history me-1"></i> Daftar Perubahan Versi</button>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Script Chart.js untuk Grafik Donat -->
<!-- Pastikan script Chart.js sudah ada di header/footer template Anda, jika belum, tambahkan CDN ini -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('jurusanChart').getContext('2d');
        var jurusanChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: <?= $chart_labels; ?>,
                datasets: [{
                    data: <?= $chart_data; ?>,
                    backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e', '#36b9cc', '#e74a3b', '#6f42c1', '#fd7e14'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            boxWidth: 12,
                            font: {
                                size: 11
                            }
                        }
                    }
                }
            }
        });

        // Tombol Unduh Grafik
        document.getElementById('downloadChart').addEventListener('click', function() {
            var image = jurusanChart.toBase64Image();
            var a = document.createElement('a');
            a.href = image;
            a.download = 'rekap-pendaftar-jurusan.png';
            a.click();
        });
    });
</script>