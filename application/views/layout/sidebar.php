<!-- SIDEBAR -->
<nav id="sidebar">
    <!-- Top Title Bar -->
    <div class="p-2 fw-bold text-white d-flex align-items-center gap-2" style="background: #19222c;">
        <i class="fa fa-graduation-cap text-warning fs-5"></i>
        <div>
            <div style="font-size: 13px;">Aplikasi SPMB</div>
            <div style="font-size: 9px; opacity: 0.7;">Sistem Penerimaan Murid Baru</div>
        </div>
    </div>

    <!-- Profil User (Dibuat Dinamis Sesuai Session) -->
    <div class="user-panel d-flex align-items-center gap-2">
        <img src="<?= base_url('assets/img/logospmb.jpg'); ?>" alt="Logo SPMB" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
        <div>
            <strong class="d-block text-white"><?= $this->session->userdata('nama'); ?></strong>
            <!-- [DIUBAH] Dari 'role' menjadi 'peran' agar sesuai database -->
            <small class="text-white-50" style="font-size: 11px;"><?= $this->session->userdata('peran'); ?></small><br>
            <span class="badge bg-success" style="font-size: 9px;">Akun Terverifikasi</span>
        </div>
    </div>

    <!-- Menu Utama -->
    <ul class="sidebar-menu mt-1">

        <!-- 1. BERANDA (Bisa diakses semua role) -->
        <li class="<?= ($this->uri->segment(1) == 'beranda' || $this->uri->segment(1) == 'dashboard') ? 'active' : ''; ?>">
            <a href="<?= base_url('beranda'); ?>"><i class="fa fa-desktop me-2"></i> Beranda</a>
        </li>

        <!-- 2. DATA MASTER (Hanya untuk Administrator) -->
        <!-- [DIUBAH] Mengecek 'peran' bukannya 'role' -->
        <?php if (strtolower(trim($this->session->userdata('peran'))) == 'administrator'): ?>
            <li class="treeview">
                <a href="#" class="menu-toggle">
                    <i class="fa fa-database me-2"></i> Data Master
                    <i class="fa fa-angle-left float-end mt-1"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= base_url('jurusan'); ?>"><i class="fa fa-circle-notch me-2"></i> Jurusan</a></li>
                    <li><a href="<?= base_url('gelombang'); ?>"><i class="fa fa-circle-notch me-2"></i> Gelombang</a></li>
                    <li><a href="<?= base_url('asal_sekolah'); ?>"><i class="fa fa-circle-notch me-2"></i> Asal Sekolah</a></li>
                    <li class="<?= ($this->uri->segment(1) == 'persyaratan') ? 'active' : ''; ?>">
                        <a href="<?= base_url('persyaratan'); ?>"><i class="fas fa-fw fa-tasks me-2"></i> Master Persyaratan</a>
                    </li>
                </ul>
            </li>
        <?php endif; ?>

        <!-- 3. DATA PENDAFTAR (Bisa diakses Administrator & Sekretaris) -->
        <li class="nav-item <?= ($this->uri->segment(1) == 'pendaftar') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('pendaftar'); ?>">
                <i class="fas fa-fw fa-user-graduate me-2"></i>
                <span>Data Pendaftar</span>
            </a>
        </li>

        <!-- 4. REKAPITULASI (Bisa diakses Administrator & Sekretaris) -->
        <li class="treeview">
            <a href="#" class="menu-toggle">
                <i class="fa fa-file-alt me-2"></i> Rekapitulasi
                <i class="fa fa-angle-left float-end mt-1"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a href="<?= base_url('rekapitulasi/data'); ?>">
                        <i class="fa fa-circle-notch me-2"></i> Rekap Data
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('rekapitulasi/pembayaran'); ?>">
                        <i class="fa fa-circle-notch me-2"></i> Rekap Pembayaran
                    </a>
                </li>
            </ul>
        </li>

        <!-- 5. HAK AKSES (Hanya untuk Administrator) -->
        <!-- [DIUBAH] Mengecek 'peran' bukannya 'role' -->
        <?php if (strtolower(trim($this->session->userdata('peran'))) == 'administrator'): ?>
            <li class="<?= ($this->uri->segment(1) == 'hak_akses') ? 'active' : ''; ?>">
                <a href="<?= base_url('hak_akses'); ?>">
                    <i class="fas fa-fw fa-user-shield me-2"></i>
                    <span>Hak Akses</span>
                </a>
            </li>
        <?php endif; ?>

        <!-- 6. PENGATURAN (Hanya untuk Administrator) -->
        <!-- [DIUBAH] Mengecek 'peran' bukannya 'role' -->
        <?php if (strtolower(trim($this->session->userdata('peran'))) == 'administrator'): ?>
            <li class="<?= ($this->uri->segment(1) == 'pengaturan') ? 'active' : ''; ?>">
                <a href="<?= base_url('pengaturan'); ?>"><i class="fa fa-cog me-2"></i> Pengaturan</a>
            </li>
        <?php endif; ?>

        <!-- LOGOUT -->
        <li class="mt-3">
            <a href="javascript:void(0);" onclick="konfirmasiLogout()" class="text-danger">
                <i class="fa fa-sign-out-alt me-2"></i> Logout
            </a>
        </li>

    </ul>
</nav>

<!-- CONTENT WRAPPER -->
<div id="content">
    <!-- Top Bar 1 -->
    <div class="top-header-1 d-flex justify-content-between align-items-center">
        <span></span>
        <button type="button" id="sidebarCollapse" class="btn btn-sm text-white p-0">
            <i class="fa fa-bars fs-6"></i>
        </button>
    </div>

    <!-- Top Bar 2 -->
    <div class="top-header-2 d-flex align-items-center gap-2">
        <i class="fa fa-university text-info"></i>
        <span class="fw-bold">SMK PGRI PESANGGARAN - 2027/2028 (versi 2026.a)</span>
    </div>

    <!-- CONTENT BODY -->
    <div class="p-3">