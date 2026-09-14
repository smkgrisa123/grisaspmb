<div class="container-fluid p-3">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="fw-bold mb-0"><i class="fa fa-file-alt me-2"></i> Rekapitulasi Kelengkapan Berkas Pendaftar</h4>
        <!-- Tombol Export Excel Rekap Data -->
        <a href="<?= base_url('rekapitulasi/excel_data'); ?>" class="btn btn-success fw-bold shadow-sm">
            <i class="fas fa-file-excel me-2"></i> Export Excel
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle" id="tableRekap">
                    <thead class="table-dark text-center">
                        <tr>
                            <th width="5%">No</th>
                            <th>No. Pendaftaran</th>
                            <th>Nama Pendaftar</th>
                            <th>Jurusan</th>
                            <!-- Kolom Persyaratan Dinamis dari Database -->
                            <?php foreach ($persyaratan as $p): ?>
                                <th class="text-center"><?= $p->nama_persyaratan; ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($pendaftar as $row): ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="fw-bold"><?= $row->no_pendaftaran; ?></td>
                                <td><?= $row->nama_lengkap; ?></td> <!-- Diperbaiki tanpa spasi -->
                                <td class="text-start">
                                    <?php
                                    // Mengecek berbagai kemungkinan nama kolom jurusan yang mungkin ada di database Anda
                                    if (isset($row->nama_jurusan)) {
                                        echo $row->nama_jurusan;
                                    } elseif (isset($row->jurusan)) {
                                        echo $row->jurusan;
                                    } else {
                                        echo '-';
                                    }
                                    ?>
                                </td>

                                <!-- Perulangan Status Persyaratan per Pendaftar -->
                                <?php foreach ($persyaratan as $p): ?>
                                    <?php
                                    // Cek ke database apakah pendaftar ini sudah centang 'sudah' pada persyaratan terkait
                                    $cek = $this->db->get_where('pendaftar_persyaratan', [
                                        'id_pendaftar' => $row->id_pendaftar, // Sesuaikan primary key pendaftar
                                        'id_persyaratan' => $p->id_persyaratan,
                                        'status' => 'sudah'
                                    ])->row();
                                    ?>
                                    <td class="text-center">
                                        <?php if ($cek): ?>
                                            <!-- Centang Hijau -->
                                            <i class="fas fa-check-circle text-success fs-5" title="Sudah Diserahkah"></i>
                                        <?php else: ?>
                                            <!-- Silang Merah -->
                                            <i class="fas fa-times-circle text-danger fs-5" title="Belum Lengkap"></i>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Script DataTables agar tabel bisa disortir/difilter -->
<script>
    $(document).ready(function() {
        $('#tableRekap').DataTable();
    });
</script>