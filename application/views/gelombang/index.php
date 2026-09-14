<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 fw-bold"><i class="fa fa-bullhorn me-2 text-primary"></i> Data Gelombang Pendaftaran</h6>
        <button type="button" class="btn btn-primary btn-sm" onclick="tambahGelombang()">
            <i class="fa fa-plus me-1"></i> Tambah Gelombang
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle" style="font-size: 13px;">
                <thead class="table-light">
                    <tr>
                        <th width="40" class="text-center">No</th>
                        <th>Gelombang</th>
                        <th>Tanggal</th>
                        <th>Benefit</th>
                        <th>Biaya Daftar Ulang</th>
                        <th class="text-center">Status</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($gelombang)): $no = 1;
                        foreach ($gelombang as $g): ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="fw-bold"><?= $g->nama_gelombang; ?></td>
                                <td>
                                    <small class="text-muted">
                                        <i class="fa fa-calendar me-1"></i><?= date('d/m/Y', strtotime($g->tgl_mulai)); ?> s.d <?= date('d/m/Y', strtotime($g->tgl_akhir)); ?>
                                    </small>
                                </td>
                                <td><?= nl2br($g->benefit); ?></td>
                                <td><strong>Rp <?= number_format($g->biaya_daftar_ulang, 0, ',', '.'); ?></strong></td>
                                <td class="text-center">
                                    <?php if ($g->status == 'aktif'): ?>
                                        <span class="badge bg-success">Aktif</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary">Tidak Aktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm text-white" onclick="editGelombang(<?= $g->id_gelombang; ?>)">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="hapusGelombang(<?= $g->id_gelombang; ?>)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-muted">Belum ada data gelombang.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH / EDIT -->
<div class="modal fade" id="modalGelombang" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="" method="post" id="formGelombang">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalTitle">Tambah Gelombang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_gelombang" id="id_gelombang">

                    <div class="mb-3">
                        <label class="form-label">Nama Gelombang Pendaftaran</label>
                        <input type="text" name="nama_gelombang" id="nama_gelombang" class="form-control" placeholder="Contoh: Gelombang 1 / Early Bird" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Akhir</label>
                            <input type="date" name="tgl_akhir" id="tgl_akhir" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Benefit</label>
                        <textarea name="benefit" id="benefit" class="form-control" rows="3" placeholder="Contoh: Gratis Seragam Olahraga, Cash back 200rb"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Biaya Daftar Ulang</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" name="biaya_daftar_ulang" id="biaya_daftar_ulang" class="form-control" placeholder="0" onkeyup="formatRupiah(this)" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="aktif">Aktif</option>
                                <option value="tidak aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save me-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SCRIPT JS GABUNGAN -->
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    <?php if ($this->session->flashdata('toast')): ?>
        Toast.fire({
            icon: '<?= $this->session->flashdata('toast')['type']; ?>',
            title: '<?= $this->session->flashdata('toast')['message']; ?>'
        });
    <?php endif; ?>

    // Format Input Rupiah Otomatis
    function formatRupiah(element) {
        let number_string = element.value.replace(/[^,\d]/g, '').toString();
        let split = number_string.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        element.value = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    }

    function tambahGelombang() {
        $('#modalTitle').text('Tambah Gelombang');
        $('#formGelombang').attr('action', '<?= base_url("gelombang/simpan"); ?>');
        $('#id_gelombang').val('');
        $('#nama_gelombang').val('');
        $('#tgl_mulai').val('');
        $('#tgl_akhir').val('');
        $('#benefit').val('');
        $('#biaya_daftar_ulang').val('');
        $('#status').val('aktif');
        $('#modalGelombang').modal('show');
    }

    function editGelombang(id) {
        $.ajax({
            url: '<?= base_url("gelombang/edit_data/"); ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#modalTitle').text('Edit Gelombang');
                $('#formGelombang').attr('action', '<?= base_url("gelombang/update"); ?>');
                $('#id_gelombang').val(data.id_gelombang);
                $('#nama_gelombang').val(data.nama_gelombang);
                $('#tgl_mulai').val(data.tgl_mulai);
                $('#tgl_akhir').val(data.tgl_akhir);
                $('#benefit').val(data.benefit);

                // Set biaya dengan format ribuan
                $('#biaya_daftar_ulang').val(new Intl.NumberFormat('id-ID').format(data.biaya_daftar_ulang));
                $('#status').val(data.status);
                $('#modalGelombang').modal('show');
            }
        });
    }

    function hapusGelombang(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data gelombang ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url("gelombang/hapus/"); ?>' + id;
            }
        });
    }
</script>