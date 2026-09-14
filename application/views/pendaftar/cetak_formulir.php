<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Formulir SPMB - <?= $pendaftar->no_pendaftaran; ?></title>
    <style>
        /* Ukuran Kertas F4 (Folio): 215mm x 330mm */
        @page {
            size: 215mm 330mm;
            /* Margin lebih lebar agar printer tidak memotong area pinggir */
            margin: 10mm 15mm 10mm 15mm;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 9px;
            color: #000;
            margin: 0;
            padding: 0;
            background: #555;
            line-height: 1.1;
        }

        .container {
            /* Kita kurangi lebarnya agar tidak menabrak batas cetak kanan-kiri */
            width: 180mm;
            margin: 0 auto;
            background: #fff;
            padding: 5mm 5mm;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }

        /* Header */
        .header-table {
            width: 100%;
            border-bottom: 3px solid #000;
            padding-bottom: 5px;
            margin-bottom: 8px;
        }

        .logo-img {
            width: 50px;
            height: 50px;
        }

        .school-title {
            font-size: 9.5px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .main-title {
            font-size: 18px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .sub-title {
            font-size: 12px;
            font-style: italic;
            font-weight: bold;
        }

        /* Banner Section Hijau */
        .banner-section {
            background-color: #198754 !important;
            color: #fff !important;
            font-weight: bold;
            padding: 2px 6px;
            font-size: 10px;
            margin-top: 8px;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Form Tabel Detail */
        table.form-layout {
            width: 100%;
            border-collapse: collapse;
        }

        table.form-layout td {
            padding: 2px 2px;
            vertical-align: top;
        }

        .label-field {
            width: 150px;
            font-weight: bold;
        }

        .separator {
            width: 10px;
            text-align: center;
            font-weight: bold;
        }

        /* Kotak Isian */
        .box-box {
            border: 1px solid #000;
            min-height: 16px;
            padding: 2px 4px;
            background: #fff;
            font-size: 10px;
        }

        /* Checkbox Kotak */
        .custom-box {
            display: inline-block;
            width: 10px;
            height: 10px;
            border: 1px solid #000;
            margin-right: 4px;
            vertical-align: middle;
            text-align: center;
            line-height: 10px;
            font-size: 8px;
            font-weight: bold;
        }

        /* Kotak Foto 3x4 */
        .foto-frame {
            width: 80px;
            height: 110px;
            border: 1px solid #000;
            text-align: center;
            vertical-align: middle;
            font-size: 8.5px;
            color: #333;
            padding-top: 40px;
            box-sizing: border-box;
            background: #fff;
        }

        .sub-header {
            font-weight: bold;
            font-size: 9.5px;
            text-decoration: underline;
            margin-bottom: 3px;
        }

        /* Tombol print */
        .no-print {
            text-align: center;
            margin-top: 20px;
        }

        /* Pengaturan saat dicetak */
        @media print {
            @page {
                size: 215mm 330mm;
                margin: 5mm;
            }

            body {
                background: #fff;
                transform: scale(0.92);
                /* Mengecilkan sedikit ukuran saat dicetak */
                transform-origin: top center;
            }

            .container {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
                box-shadow: none !important;
            }

            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="container">

        <!-- HEADER -->
        <table class="header-table">
            <tr>
                <td width="60">
                    <img src="<?= base_url('assets/img/logo_grisa.png'); ?>" alt="Logo" class="logo-img">
                </td>
                <td>
                    <div class="school-title">YAYASAN PEMBINA LEMBAGA PENDIDIKAN DASAR DAN MENENGAH</div>
                    <div class="school-title">SMK PGRI PESANGGARAN</div>
                    <div class="main-title">FORMULIR SPMB</div>
                    <div style="font-size: 9.5px; font-weight: bold;">SISTEM PENERIMAAN SISWA BARU</div>
                </td>
                <td align="right" style="vertical-align: top;">
                    <div class="sub-title">TAHUN PELAJARAN 2027/2028</div>
                    <div style="font-size: 9px; margin-top: 2px; font-weight: bold; color: #b02a37;">No: <?= $pendaftar->no_pendaftaran; ?></div>
                    <div style="margin-top: 3px;">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=55x55&data=<?= $pendaftar->no_pendaftaran; ?>" alt="QR Barcode" style="width: 50px; height: 50px;">
                    </div>
                </td>
            </tr>
        </table>

        <!-- 1. BIODATA DIRI -->
        <div class="banner-section" style="width: 110px;">BIODATA DIRI</div>

        <table class="form-layout">
            <tr>
                <td class="label-field">Nama Lengkap</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box" style="font-weight: bold;"><?= $pendaftar->nama_lengkap; ?></div>
                </td>
                <td rowspan="6" width="90" align="right" style="vertical-align: top;">
                    <div class="foto-frame">
                        FOTO 3X4<br>BERWARNA
                    </div>
                </td>
            </tr>
            <tr>
                <td class="label-field">Tempat / Tanggal Lahir</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->tempat_lahir; ?>, <?= ($pendaftar->tgl_lahir) ? date('d-m-Y', strtotime($pendaftar->tgl_lahir)) : ''; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field">Jenis Kelamin</td>
                <td class="separator">:</td>
                <td>
                    <span class="custom-box"><?= ($pendaftar->jenis_kelamin == 'L') ? 'V' : ''; ?></span> Laki-laki &nbsp;&nbsp;&nbsp;&nbsp;
                    <span class="custom-box"><?= ($pendaftar->jenis_kelamin == 'P') ? 'V' : ''; ?></span> Perempuan
                </td>
            </tr>
            <tr>
                <td class="label-field">Jalan</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->jalan; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field">Dusun</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->dusun; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field">Rt/Rw</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->rt_rw; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field">Desa</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->desa; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field">Kecamatan</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->kecamatan; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field">Kabupaten</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->kabupaten; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field">Agama</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->agama; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field">No KK / NIK</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->no_kk; ?> / NIK: <?= $pendaftar->nik; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field">No Hp</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->no_hp; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field" style="vertical-align: top;">Jurusan</td>
                <td class="separator" style="vertical-align: top;">:</td>
                <td colspan="2">
                    <?php $id_j = isset($pendaftar->id_jurusan) ? $pendaftar->id_jurusan : ''; ?>
                    <table width="100%" style="font-size: 9.5px;">
                        <tr>
                            <td width="50%"><span class="custom-box"><?= ($id_j == 1) ? 'V' : ''; ?></span> Teknik Alat Berat (TAB)</td>
                            <td width="50%"><span class="custom-box"><?= ($id_j == 2) ? 'V' : ''; ?></span> Teknik Sepeda Motor (TSM)</td>
                        </tr>
                        <tr>
                            <td><span class="custom-box"><?= ($id_j == 3) ? 'V' : ''; ?></span> Agribisnis Pengolahan Hasil</td>
                            <td><span class="custom-box"><?= ($id_j == 4) ? 'V' : ''; ?></span> Perhotelan (PH)</td>
                        </tr>
                        <tr>
                            <td><span class="custom-box"><?= ($id_j == 5) ? 'V' : ''; ?></span> Akuntansi (AK)</td>
                            <td><span class="custom-box"><?= ($id_j == 6) ? 'V' : ''; ?></span> Perkantoran (MP)</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- 2. SEKOLAH ASAL -->
        <div class="banner-section" style="width: 100px;">SEKOLAH ASAL</div>
        <table class="form-layout">
            <tr>
                <td class="label-field">Nama SMP/MTs</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= isset($pendaftar->nama_sekolah) ? $pendaftar->nama_sekolah : '-'; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field">Alamat Sekolah</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= isset($pendaftar->alamat_sekolah) ? $pendaftar->alamat_sekolah : '-'; ?></div>
                </td>
            </tr>
        </table>

        <!-- 3. DATA ORANG TUA KANDUNG -->
        <div class="banner-section" style="width: 150px;">DATA ORANG TUA KANDUNG</div>
        <table class="form-layout">
            <tr>
                <td width="50%" style="vertical-align: top; padding-right: 5px;">
                    <div class="sub-header">DATA AYAH</div>
                    <table width="100%" style="font-size: 9.5px;">
                        <tr>
                            <td width="28%">Nama</td>
                            <td width="3%">:</td>
                            <td>
                                <div class="box-box"><?= $pendaftar->nama_ayah; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>
                                <span class="custom-box"><?= ($pendaftar->status_ayah == 'Hidup') ? 'V' : ''; ?></span> Hidup &nbsp;
                                <span class="custom-box"><?= ($pendaftar->status_ayah == 'Meninggal') ? 'V' : ''; ?></span> Meninggal
                            </td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td>
                                <div class="box-box"><?= $pendaftar->pekerjaan_ayah; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>
                                <div class="box-box" style="height: 25px;"><?= $pendaftar->alamat_ayah; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td>No. Hp</td>
                            <td>:</td>
                            <td>
                                <div class="box-box"><?= $pendaftar->no_hp_ayah; ?></div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td width="50%" style="vertical-align: top; padding-left: 5px;">
                    <div class="sub-header">DATA IBU</div>
                    <table width="100%" style="font-size: 9.5px;">
                        <tr>
                            <td width="28%">Nama</td>
                            <td width="3%">:</td>
                            <td>
                                <div class="box-box"><?= $pendaftar->nama_ibu; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>
                                <span class="custom-box"><?= ($pendaftar->status_ibu == 'Hidup') ? 'V' : ''; ?></span> Hidup &nbsp;
                                <span class="custom-box"><?= ($pendaftar->status_ibu == 'Meninggal') ? 'V' : ''; ?></span> Meninggal
                            </td>
                        </tr>
                        <tr>
                            <td>Pekerjaan</td>
                            <td>:</td>
                            <td>
                                <div class="box-box"><?= $pendaftar->pekerjaan_ibu; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>
                                <div class="box-box" style="height: 25px;"><?= $pendaftar->alamat_ibu; ?></div>
                            </td>
                        </tr>
                        <tr>
                            <td>No. Hp</td>
                            <td>:</td>
                            <td>
                                <div class="box-box"><?= $pendaftar->no_hp_ibu; ?></div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <!-- 4. DATA WALI -->
        <!-- 4. DATA WALI -->
        <div class="banner-section" style="width: 80px;">DATA WALI</div>
        <table class="form-layout">
            <tr>
                <td class="label-field">Nama Wali</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->nama_wali; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field">Pekerjaan Wali</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->pekerjaan_wali; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field">Alamat Wali</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->alamat_wali; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field">No HP Wali</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->no_hp_wali; ?></div>
                </td>
            </tr>
            <tr>
                <td class="label-field">Status Hubungan</td>
                <td class="separator">:</td>
                <td>
                    <div class="box-box"><?= $pendaftar->status_hubungan_wali; ?></div>
                </td>
            </tr>
        </table>
        <!-- TOMBOL AKSI CETAK -->
        <div class="no-print">
            <button onclick="window.print()" style="padding: 8px 25px; background: #198754; color: #fff; border: none; cursor: pointer; border-radius: 4px; font-weight: bold; font-size: 11px;">
                Cetak Formulir
            </button>
            <button onclick="window.close()" style="padding: 8px 25px; background: #6c757d; color: #fff; border: none; cursor: pointer; border-radius: 4px; font-weight: bold; font-size: 11px;">
                Tutup
            </button>
        </div>

    </div>

</body>

</html>