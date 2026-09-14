<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 fw-bold"><i class="fa fa-university me-2 text-primary"></i> Data Asal Sekolah (SMP / MTs)</h6>
        <button type="button" class="btn btn-primary btn-sm" onclick="tambahSekolah()">
            <i class="fa fa-plus me-1"></i> Tambah Sekolah
        </button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="tableSekolah" class="table table-bordered table-hover align-middle" style="font-size: 13px; width:100%;">
                <thead class="table-light">
                    <tr>
                        <th width="40" class="text-center">No</th>
                        <th>Nama Sekolah</th>
                        <th>Alamat Sekolah</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($sekolah)): $no = 1;
                        foreach ($sekolah as $s): ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td class="fw-bold"><?= $s->nama_sekolah; ?></td>
                                <td><?= $s->alamat_sekolah ? $s->alamat_sekolah : '-'; ?></td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm text-white" onclick="editSekolah(<?= $s->id_sekolah; ?>)">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" onclick="hapusSekolah(<?= $s->id_sekolah; ?>)">
                                        <i class="fa fa-trash"></i>
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

<!-- MODAL TAMBAH / EDIT -->
<div class="modal fade" id="modalSekolah" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" id="formSekolah">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalTitle">Tambah Asal Sekolah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_sekolah" id="id_sekolah">

                    <div class="mb-3">
                        <label class="form-label">Nama Sekolah</label>
                        <input type="text" name="nama_sekolah" id="nama_sekolah" class="form-control" placeholder="Contoh: SMPN 1 Pesanggaran" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Alamat Sekolah</label>
                        <textarea name="alamat_sekolah" id="alamat_sekolah" class="form-control" rows="3" placeholder="Contoh: Jl. Raya Pesanggaran No. 12"></textarea>
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

<!-- SCRIPT JS DATA TABLE & SWEETALERT -->
<script>
    $(document).ready(function() {
        // Inisialisasi DataTable
        $('#tableSekolah').DataTable({
            "language": {
                "search": "Cari:",
                "lengthMenu": "Tampilkan _MENU_ data",
                "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                "infoEmpty": "Menampilkan 0 sampai 0 dari 0 data",
                "zeroRecords": "Data tidak ditemukan",
                "paginate": {
                    "first": "Pertama",
                    "last": "Terakhir",
                    "next": "Selanjutnya",
                    "previous": "Sebelumnya"
                }
            }
        });

        // Eksekusi Toast Flashdata saat Halaman Loaded
        <?php if ($this->session->flashdata('toast')): ?>
            Toast.fire({
                icon: '<?= $this->session->flashdata('toast')['type']; ?>',
                title: '<?= $this->session->flashdata('toast')['message']; ?>'
            });
        <?php endif; ?>
    });

    // Konfigurasi SweetAlert2 Toast
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });

    function tambahSekolah() {
        $('#modalTitle').text('Tambah Asal Sekolah');
        $('#formSekolah').attr('action', '<?= base_url("asal_sekolah/simpan"); ?>');
        $('#id_sekolah').val('');
        $('#nama_sekolah').val('');
        $('#alamat_sekolah').val('');
        $('#modalSekolah').modal('show');
    }

    function editSekolah(id) {
        $.ajax({
            url: '<?= base_url("asal_sekolah/edit_data/"); ?>' + id,
            type: 'GET',
            dataType: 'JSON',
            success: function(data) {
                $('#modalTitle').text('Edit Asal Sekolah');
                $('#formSekolah').attr('action', '<?= base_url("asal_sekolah/update"); ?>');
                $('#id_sekolah').val(data.id_sekolah);
                $('#nama_sekolah').val(data.nama_sekolah);
                $('#alamat_sekolah').val(data.alamat_sekolah);
                $('#modalSekolah').modal('show');
            }
        });
    }

    function hapusSekolah(id) {
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data sekolah ini akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '<?= base_url("asal_sekolah/hapus/"); ?>' + id;
            }
        });
    }
</script>