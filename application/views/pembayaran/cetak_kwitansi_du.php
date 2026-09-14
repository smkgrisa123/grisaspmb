<?php
// Fungsi untuk mengubah angka menjadi terbilang rupiah
function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " Belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " Puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " Seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " Ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " Seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " Ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " Juta" . penyebut($nilai % 1000000);
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil ? $hasil . " Rupiah" : "Nol Rupiah";
}

// Mengambil data khusus Daftar Ulang (nominal_du & tgl_du) dari database
$nominal = (isset($pembayaran) && isset($pembayaran->nominal_du)) ? $pembayaran->nominal_du : 0;
$formatted_nominal = 'Rp. ' . number_format($nominal, 0, ',', '.');
$terbilang_nominal = ucwords(terbilang($nominal));

$nama_lengkap = (isset($pendaftar) && isset($pendaftar->nama_lengkap)) ? $pendaftar->nama_lengkap : '-';
$alamat = (isset($pendaftar) && isset($pendaftar->alamat)) ? $pendaftar->alamat : '-';
$tgl_du = (isset($pembayaran) && isset($pembayaran->tgl_du)) ? $pembayaran->tgl_du : date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Kwitansi Daftar Ulang - <?= $nama_lengkap; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
            color: #000;
            margin: 0;
            padding: 20px;
            background: #fff;
        }

        .kwitansi-box {
            width: 750px;
            margin: 0 auto;
            border: 2px solid #0056b3;
            padding: 25px;
            background: #fff;
            position: relative;
        }

        /* Header */
        .header-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 12px;
        }

        .instansi-title {
            font-size: 20px;
            font-weight: bold;
            color: #0056b3;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .instansi-subtitle {
            font-size: 11px;
            color: #333;
            margin-top: 3px;
        }

        .kwitansi-label {
            font-size: 26px;
            font-weight: bold;
            color: #0056b3;
            text-align: right;
            letter-spacing: 2px;
        }

        /* Content Rows */
        .row-line {
            margin-bottom: 14px;
            position: relative;
            line-height: 1.4;
        }

        .row-line label {
            display: inline-block;
            width: 135px;
            font-weight: bold;
            color: #333;
            vertical-align: top;
        }

        .dot-line {
            border-bottom: 1px dotted #000;
            display: inline-block;
            width: 575px;
            padding-bottom: 2px;
            min-height: 16px;
        }

        /* Tanda Tangan */
        .footer-section {
            margin-top: 35px;
            width: 100%;
        }

        .sign-area {
            float: right;
            text-align: center;
            width: 230px;
            font-size: 12px;
        }

        .btn-print {
            margin: 20px auto;
            display: block;
            padding: 10px 20px;
            background: #0056b3;
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 14px;
            border-radius: 4px;
        }

        @media print {
            .btn-print {
                display: none;
            }

            body {
                padding: 0;
            }

            @page {
                size: landscape;
                margin: 15mm;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="kwitansi-box">
        <!-- Header Instansi & Judul Kwitansi -->
        <table class="header-table">
            <tr>
                <td>
                    <div class="instansi-title">SMK PGRI PESANGGARAN</div>
                    <div class="instansi-subtitle">Panitia Penerimaan Peserta Didik Baru (SPMB) Tahun 2026/2027</div>
                    <div class="instansi-subtitle">Jl. Pesanggaran No. 1 Banyuwangi Telp. (0333) xxxxxx</div>
                </td>
                <td style="vertical-align: middle;">
                    <div class="kwitansi-label">KWITANSI</div>
                </td>
            </tr>
        </table>

        <!-- Isi Kwitansi -->
        <div class="row-line">
            <label>Telah diterima dari</label> : <span class="dot-line"><strong>&nbsp;<?= $nama_lengkap; ?></strong></span>
        </div>

        <div class="row-line">
            <label>Alamat</label> : <span class="dot-line">&nbsp;<?= $alamat; ?></span>
        </div>

        <div class="row-line">
            <label>Uang Sebesar</label> : <span class="dot-line"><strong>&nbsp;<?= $formatted_nominal; ?></strong> &nbsp; <i>(<?= $terbilang_nominal; ?>)</i></span>
        </div>

        <div class="row-line">
            <label>Untuk Pembayaran</label> : <span class="dot-line">&nbsp;Biaya Daftar Ulang (DU) Peserta Didik Baru SMK PGRI Pesanggaran</span>
        </div>

        <!-- Tanda Tangan & Tanggal -->
        <table class="footer-section">
            <tr>
                <td></td>
                <td class="sign-area">
                    <div>Pesanggaran, <?= date('d F Y', strtotime($tgl_du)); ?></div>
                    <div style="margin-top: 5px;">Panitia / Bendahara,</div>
                    <br><br><br>
                    <div style="border-bottom: 1px solid #000; font-weight: bold; padding-bottom: 2px;">( ........................................ )</div>
                </td>
            </tr>
        </table>
    </div>

    <button class="btn-print" onclick="window.print()">Cetak Ulang Kwitansi Daftar Ulang</button>

</body>

</html>