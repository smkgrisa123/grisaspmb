<div class="container-fluid p-3">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h4 class="fw-bold mb-0"><i class="fa fa-money-bill-wave me-2"></i> Rekapitulasi Pembayaran Pendaftar</h4>
        <a href="<?= base_url('rekapitulasi/excel_pembayaran'); ?>" class="btn btn-success fw-bold shadow-sm">
            <i class="fas fa-file-excel me-2"></i> Export Excel
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle" id="tableRekapPembayaran">
                    <thead class="table-dark text-center">
                        <tr>
                            <th rowspan="2" class="align-middle" width="5%">No</th>
                            <th rowspan="2" class="align-middle">No. Pendaftaran</th>
                            <th rowspan="2" class="align-middle">Nama Pendaftar</th>
                            <th rowspan="2" class="align-middle">Jurusan</th>
                            <th colspan="3" class="text-center align-middle">Biaya Registrasi</th>
                            <th colspan="4" class="text-center align-middle">Biaya Daftar Ulang</th>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>Nominal</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Gelombang</th>
                            <th>Nominal</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        // Inisialisasi variabel total di luar foreach agar aman dari Undefined Variable
                        $total_reg = 0;
                        $total_du = 0;

                        foreach ($pendaftar as $row):
                            $nom_reg = !empty($row->nominal_reg) ? $row->nominal_reg : 0;
                            $nom_du = !empty($row->nominal_du) ? $row->nominal_du : 0;

                            $total_reg += $nom_reg;
                            $total_du += $nom_du;
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="fw-bold text-center"><?= $row->no_pendaftaran; ?></td>
                                <td><?= $row->nama_lengkap; ?></td>
                                <td class="text-start"><?= isset($row->nama_jurusan) ? $row->nama_jurusan : '-'; ?></td>

                                <!-- Kolom Biaya Registrasi -->
                                <td class="text-center">
                                    <?php if ($nom_reg > 0): ?>
                                        <i class="fas fa-check-circle text-success fs-5" title="Sudah Lunas"></i>
                                    <?php else: ?>
                                        <i class="fas fa-times-circle text-danger fs-5" title="Belum Bayar"></i>
                                    <?php endif; ?>
                                </td>
                                <td><?= 'Rp ' . number_format($nom_reg, 0, ',', '.'); ?></td>
                                <td class="text-center"><?= !empty($row->tgl_reg) ? date('d-m-Y', strtotime($row->tgl_reg)) : '-'; ?></td>

                                <!-- Kolom Biaya Daftar Ulang -->
                                <td class="text-center">
                                    <?php if ($nom_du > 0): ?>
                                        <i class="fas fa-check-circle text-success fs-5" title="Sudah Lunas"></i>
                                    <?php else: ?>
                                        <i class="fas fa-times-circle text-danger fs-5" title="Belum Bayar"></i>
                                    <?php endif; ?>
                                </td>
                                <td class="text-start"><?= !empty($row->nama_gelombang) ? $row->nama_gelombang : '-'; ?></td>
                                <td><?= 'Rp ' . number_format($nom_du, 0, ',', '.'); ?></td>
                                <td class="text-center"><?= !empty($row->tgl_du) ? date('d-m-Y', strtotime($row->tgl_du)) : '-'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot class="table-light fw-bold">
                        <tr>
                            <td colspan="4" class="text-center">TOTAL KESELURUHAN</td>
                            <td class="text-center">-</td>
                            <td><?= 'Rp ' . number_format($total_reg, 0, ',', '.'); ?></td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td><?= 'Rp ' . number_format($total_du, 0, ',', '.'); ?></td>
                            <td class="text-center">-</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Script DataTables -->
<script>
    $(document).ready(function() {
        $('#tableRekapPembayaran').DataTable();
    });
</script>