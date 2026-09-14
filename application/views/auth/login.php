<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SPMB SMK GRISA</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #1b2a47;
            background-image: linear-gradient(135deg, #1b2a47 0%, #0f1c30 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #fff;
            overflow-x: hidden;
        }

        .login-card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            color: #333;
        }

        .header-box {
            background: rgba(27, 42, 71, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 12px;
        }

        .form-control,
        .form-select {
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            padding: 10px 15px;
            font-size: 14px;
        }

        .form-control:focus,
        .form-select:focus {
            background-color: #fff;
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .btn-login {
            background-color: #1b2a47;
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background-color: #2c426d;
            color: white;
        }

        .right-panel {
            background-color: #213354;
            color: white;
        }
    </style>
</head>

<body>

    <!-- Top / Header Section -->
    <div class="container py-4">
        <div class="row align-items-center justify-content-center text-center">
            <div class="col-md-10 d-flex flex-column flex-md-row align-items-center justify-content-center gap-3">
                <!-- LOGO SPMB DIPERBESAR DI HEADER -->
                <img src="<?= base_url('assets/img/logospmb.jpg'); ?>"
                    alt="Logo SPMB SMK GRISA"
                    class="img-fluid drop-shadow"
                    style="max-height: 110px; width: auto; object-fit: contain;">

                <!-- Judul & Keterangan -->
                <div class="text-md-start">
                    <h3 class="fw-bold m-0 text-white tracking-wide">SPMB SMK GRISA TAHUN 2027/2028</h3>
                    <p class="small text-white-50 m-0">Sistem Penerimaan Murid Baru • Pendaftaran Terintegrasi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Login Container -->
    <div class="container my-auto py-3">
        <div class="row justify-content-center">
            <div class="col-xl-9 col-lg-10">
                <div class="login-card row g-0">

                    <!-- KIRI: Form Masuk -->
                    <div class="col-md-6 p-4 p-lg-5 bg-white">
                        <h3 class="fw-bold text-center mb-4 text-dark" style="font-size: 24px;">Masuk</h3>

                        <!-- Notifikasi Pesan Error/Flashdata -->
                        <?php if ($this->session->flashdata('message')): ?>
                            <?= $this->session->flashdata('message'); ?>
                        <?php endif; ?>

                        <form action="<?= base_url('auth/proses_login'); ?>" method="post">
                            <div class="mb-3">
                                <label class="form-label text-muted small fw-semibold">Email / Username</label>
                                <input type="text" name="username" class="form-control rounded-2" placeholder="dapo.smkgrisa@gmail.com" required autocomplete="off">
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-semibold">Kata Sandi</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control rounded-start-2" placeholder="••••••••" required>
                                    <button class="btn btn-outline-secondary border text-muted small" type="button" id="togglePassword" style="font-size: 11px;">TAMPIL</button>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label text-muted small fw-semibold">Tahun Ajaran</label>
                                <select name="tahun_ajaran" class="form-select rounded-2">
                                    <option value="2026/2027 Gasal">2027/2028</option>
                                </select>
                            </div>

                            <div class="mb-4 form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label text-muted small" for="remember">Ingatkan saya pada peramban ini</label>
                            </div>

                            <button type="submit" class="btn btn-login w-100 rounded-2 shadow-sm">MASUK</button>
                        </form>
                    </div>

                    <!-- KANAN: Panel Sambutan (Diperbaiki dengan pembungkus kolom col-md-6 right-panel) -->
                    <div class="col-md-6 right-panel p-4 p-lg-5 d-flex flex-column justify-content-center align-items-center text-center">
                        <div class="mb-3">
                            <img src="<?= base_url('assets/img/logo.jpg'); ?>" alt="Logo Sekolah" style="width: 70px; height: 70px; object-fit: contain;" class="drop-shadow">
                        </div>

                        <h5 class="fw-bold mb-2 text-warning">Selamat Datang di Portal Resmi SPMB</h5>
                        <p class="text-white-50 small px-3 mb-4" style="line-height: 1.5;">
                            "Silakan masuk untuk mengelola data pendaftaran calon peserta didik baru SMK PGRI Pesanggaran Tahun Ajaran 2027/2028 dengan mudah dan terintegrasi."
                        </p>

                        <div class="d-grid gap-2 col-8 mx-auto">
                            <a href="<?= base_url('auth/registrasi'); ?>" class="btn btn-outline-light btn-sm py-2">Pendaftaran Siswa Baru</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer Copyright -->
    <footer class="text-center py-3 text-white-50 small" style="font-size: 12px;">
        &copy; 2026 • SMK PGRI Pesanggaran • version 1.01
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Script Toggle Password -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.textContent = type === 'password' ? 'TAMPIL' : 'SEMBUNYI';
        });
    </script>
</body>

</html>