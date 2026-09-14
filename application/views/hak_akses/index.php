<div class="content-wrapper">
    <section class="content p-4">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title fw-bold">Manajemen Hak Akses User</h3>
                    <button class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalTambah">
                        <i class="fas fa-plus"></i> Tambah User
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Peran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($users as $u): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $u->nama; ?></td>
                                    <td><?= $u->username; ?></td>
                                    <td><span class="badge bg-info text-dark"><?= ucwords(str_replace('_', ' ', $u->peran)); ?></span></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit<?= $u->id_user; ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <a href="<?= base_url('hak_akses/hapus/' . $u->id_user); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1">
    <div class="modal-dialog">
        <form action="<?= base_url('hak_akses/simpan'); ?>" method="post" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah User Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Peran</label>
                    <select name="peran" class="form-control" required>
                        <option value="administrator">Administrator</option>
                        <option value="ketua_spmb">Ketua SPMB</option>
                        <option value="sekretaris">Sekretaris</option>
                        <option value="bendahara">Bendahara</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit (Looping per User) -->
<?php foreach ($users as $u): ?>
    <div class="modal fade" id="modalEdit<?= $u->id_user; ?>" tabindex="-1">
        <div class="modal-dialog">
            <form action="<?= base_url('hak_akses/update/' . $u->id_user); ?>" method="post" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" value="<?= $u->nama; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" value="<?= $u->username; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password <small class="text-muted">(Kosongkan jika tidak diubah)</small></label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Peran</label>
                        <select name="peran" class="form-control" required>
                            <option value="administrator" <?= $u->peran == 'administrator' ? 'selected' : ''; ?>>Administrator</option>
                            <option value="ketua_spmb" <?= $u->peran == 'ketua_spmb' ? 'selected' : ''; ?>>Ketua SPMB</option>
                            <option value="sekretaris" <?= $u->peran == 'sekretaris' ? 'selected' : ''; ?>>Sekretaris</option>
                            <option value="bendahara" <?= $u->peran == 'bendahara' ? 'selected' : ''; ?>>Bendahara</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>