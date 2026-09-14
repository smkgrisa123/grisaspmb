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

// Ambil data aman dengan pengecekan untuk menghindari error
$nominal = (isset($pembayaran) && isset($pembayaran->nominal_reg)) ? $pembayaran->nominal_reg : 0;
$formatted_nominal = 'Rp. ' . number_format($nominal, 0, ',', '.');
$terbilang_nominal = ucwords(terbilang($nominal));

$no_pendaftaran = (isset($pendaftar) && isset($pendaftar->no_pendaftaran)) ? $pendaftar->no_pendaftaran : ((isset($pendaftar) && isset($pendaftar->id_pendaftar)) ? $pendaftar->id_pendaftar : '-');
$nama_lengkap = (isset($pendaftar) && isset($pendaftar->nama_lengkap)) ? $pendaftar->nama_lengkap : '-';
$tgl_reg = (isset($pembayaran) && isset($pembayaran->tgl_reg)) ? $pembayaran->tgl_reg : date('Y-m-d');
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Cetak Kwitansi Pembayaran - <?= $nama_lengkap; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
            margin: 0;
            padding: 20px;
            background: #fff;
        }

        .kwitansi-container {
            width: 800px;
            margin: 0 auto;
            border: 2px solid #000;
            padding: 10px;
            background: #fff;
        }

        table.layout-table {
            width: 100%;
            border-collapse: collapse;
        }

        table.layout-table td {
            vertical-align: top;
            padding: 5px;
        }

        /* Bagian Potongan Kiri (Stub) */
        .col-left {
            width: 25%;
            border-right: 2px dashed #000;
            padding-right: 10px;
        }

        .col-left .title {
            font-weight: bold;
            font-size: 11px;
            margin-bottom: 8px;
            text-align: center;
            border-bottom: 1px solid #000;
            padding-bottom: 3px;
        }

        .field-label {
            font-size: 10px;
            margin-top: 5px;
            color: #444;
        }

        .field-line {
            border-bottom: 1px dotted #000;
            min-height: 15px;
            margin-bottom: 3px;
            font-size: 11px;
            word-break: break-all;
        }

        /* Bagian Utama Kanan */
        .col-right {
            width: 75%;
            padding-left: 15px;
        }

        .main-title {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
            text-decoration: underline;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .row-data {
            margin-bottom: 8px;
            font-size: 13px;
        }

        .row-data span {
            display: inline-block;
        }

        .box-nominal {
            border: 2px solid #000;
            padding: 8px 15px;
            font-weight: bold;
            font-size: 16px;
            display: inline-block;
            min-width: 200px;
            background: #f9f9f9;
            transform: skew(-10deg);
            margin-top: 10px;
        }

        .box-nominal span {
            transform: skew(10deg);
            display: inline-block;
        }

        .btn-print {
            margin: 20px auto;
            display: block;
            padding: 10px 20px;
            background: #007bff;
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
                margin: 10mm;
            }
        }
    </style>
</head>

<body onload="window.print()">

    <div class="kwitansi-container">
        <table class="layout-table">
            <tr>
                <!-- BAGIAN KIRI (POTONGAN / STUB) -->
                <!-- BAGIAN KRI (POTONGAN / STUB) -->
                <td class="col-left">
                    <div class="title">BUKTI PEMBAYARAN</div>

                    <div class="field-label">No:</div>
                    <div style="border-bottom: 1px dotted #000; padding-bottom: 3px; margin-bottom: 4px; font-weight: bold; font-size: 11px; word-break: break-all;"><?= $no_pendaftaran; ?></div>

                    <div class="field-label">Tanggal:</div>
                    <div style="border-bottom: 1px dotted #000; padding-bottom: 3px; margin-bottom: 4px; font-size: 11px;"><?= date('d/m/Y', strtotime($tgl_reg)); ?></div>

                    <div class="field-label">Terima Dari:</div>
                    <div style="border-bottom: 1px dotted #000; padding-bottom: 3px; margin-bottom: 4px; font-weight: bold; font-size: 11px;"><?= $nama_lengkap; ?></div>

                    <div class="field-label">Jumlah:</div>
                    <div style="border-bottom: 1px dotted #000; padding-bottom: 3px; margin-bottom: 4px; font-size: 11px;"><strong><?= $formatted_nominal; ?></strong></div>

                    <div class="field-label">Untuk Pembayaran:</div>
                    <div style="border-bottom: 1px dotted #000; padding-bottom: 3px; margin-top: 3px; margin-bottom: 4px; font-size: 11px; font-weight: bold; line-height: 1.2;">Biaya Registrasi Peserta Didik Baru</div>
                </td>

                <!-- BAGIAN KANAN (KWITANSI UTAMA) -->
                <td class="col-right">
                    <div style="float: right; font-size: 11px;">
                        <strong>No:</strong> <?= $no_pendaftaran; ?> &nbsp;&nbsp;&nbsp;&nbsp;
                        <strong>Tanggal:</strong> <?= date('d F Y', strtotime($tgl_reg)); ?>
                    </div>
                    <div style="clear: both;"></div>

                    <div class="main-title">Kwitansi Pembayaran</div>

                    <div class="row-data" style="margin-top: 15px;">
                        <strong>Terima Dari :</strong> <span style="border-bottom: 1px dotted #000; width: 80%; font-weight: bold;"><?= $nama_lengkap; ?></span>
                    </div>

                    <div class="row-data">
                        <strong>Terbilang :</strong> <span style="border-bottom: 1px dotted #000; width: 81%; font-style: italic;"><?= $terbilang_nominal; ?></span>
                    </div>

                    <div class="row-data">
                        <strong>Untuk Pembayaran :</strong> <span style="border-bottom: 1px dotted #000; width: 72%;">Biaya Registrasi Peserta Didik Baru (SPMB) SMK PGRI Pesanggaran</span>
                    </div>

                    <table style="width: 100%; margin-top: 20px;">
                        <tr>
                            <td style="width: 50%;">
                                <div class="box-nominal">
                                    <span><?= $formatted_nominal; ?>,-</span>
                                </div>
                            </td>
                            <td style="width: 50%; text-align: center;">
                                <div style="font-size: 11px; margin-bottom: 5px;">Pesanggaran, <?= date('d F Y', strtotime($tgl_reg)); ?></div>
                                <br><br><br>
                                <div style="border-bottom: 1px solid #000; width: 70%; margin: 0 auto;"></div>
                                <div style="font-size: 11px; margin-top: 3px;">Tanda Tangan Penerima</div>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <button class="btn-print" onclick="window.print()">Cetak Ulang Kwitansi</button>

</body>

</html>