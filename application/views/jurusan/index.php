<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 fw-bold"><i class="fa fa-school me-2 text-primary"></i> Data Jurusan</h6>
        <button type="button" class="btn btn-primary btn-sm" onclick="tambahJurusan()">
            <i class="fa fa-plus me-1"></i> Tambah Jurusan
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle" style="font-size: 13px;">
                <thead class="table-light">
                    <tr>
                        <th width="50" class="text-center">No</th>
                        <th>Kode Jurusan</th>
                        <th>Nama Jurusan</th>
                        <th width="150" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($jurusan)): $no = 1;
                        foreach ($jurusan as $j): ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><span class="badge bg-secondary"><?= $j->kode_jurusan; ?></span></td>
                                <td><?= $j->nama_jurusan; ?></td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm text-white" onclick="editJurusan(<?= $j->id_jurusan; ?>)">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="hapusJurusan(<?= $j->id_jurusan; ?>)">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach;
                    else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Belum ada data jurusan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH / EDIT -->
<div class="modal fade" id="modalJurusan" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" id="formJurusan">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalTitle">Tambah Jurusan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_jurusan" id="id_jurusan">
                    <div class="mb-3">
                        <label class="form-label">Kode Jurusan</label>
                        <input type="text" name="kode_jurusan" id="kode_jurusan" class="form-control" placeholder="Contoh: RPL, TKJ, AKL" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Jurusan</label>
                        <input type="text" name="nama_jurusan" id="nama_jurusan" class="form-control" placeholder="Contoh: Rekayasa Perangkat Lunak" required>
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

<!-- SCRIPT JS JADI SATU DI SINI -->
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

    function tambahJurusan() {
        $('#modalTitle').text('Tambah Jurusan');
        $('#formJurusan').attr('action', '<?= base_url("jurusan/simpan"); ?>');
        $('#id_jurusan').val('');
        $('#kode_jurusan').val('');
        $('#nama_jurusan').val('');
        $('#modalJurusan').modal('show');
    }

    function editJurusan(id) {
        $.ajax({
            url: '<?= base_url("jurusan/edit_data/"); ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#modalTitle').text('Edit Jurusan');
                $('#formJurusan').attr('action', '<?= base_url("jurusan/update"); ?>');
                $('#id_jurusan').val(data.id_jurusan);
                $('#kode_jurusan').val(data.kode_jurusan);
                $('#nama_jurusan').val(data.nama_jurusan);
                $('#modalJurusan').modal('show');
            }
        });
    }

    function hapusJurusan(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data jurusan ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url("jurusan/hapus/"); ?>' + id;
            }
        });
    }
</script>