<?php
// Set Header HTTP agar dibaca sebagai file Excel oleh browser
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Pembayaran_SPMB_SMK_Grisa_" . date('d-m-Y') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Export Rekap Pembayaran</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th {
            background-color: #1F4E78;
            color: #ffffff;
            text-align: center;
            vertical-align: middle;
            border: 1px solid #000000;
        }

        td {
            border: 1px solid #000000;
            vertical-align: middle;
            padding: 5px;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .fw-bold {
            font-weight: bold;
        }

        .title {
            font-size: 16pt;
            font-weight: bold;
            text-align: center;
        }

        .subtitle {
            font-size: 11pt;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="title">REKAPITULASI PEMBAYARAN PENDAFTAR SPMB SMK GRISA</div>
    <div class="subtitle">Tanggal Cetak: <?= date('d-m-Y H:i'); ?> WIB</div>

    <table>
        <thead>
            <tr>
                <th rowspan="2" width="5%">No</th>
                <th rowspan="2">No. Pendaftaran</th>
                <th rowspan="2">Nama Pendaftar</th>
                <th rowspan="2">Jurusan</th>
                <th colspan="3">Biaya Registrasi</th>
                <th colspan="4">Biaya Daftar Ulang</th>
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
            $total_reg = 0;
            $total_du = 0;
            foreach ($pendaftar as $row):
                $nominal_reg = !empty($row->nominal_reg) ? $row->nominal_reg : 0;
                $nominal_du = !empty($row->nominal_du) ? $row->nominal_du : 0;

                $total_reg += $nominal_reg;
                $total_du += $nominal_du;
            ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-center fw-bold">'<?= $row->no_pendaftaran; ?></td>
                    <td class="text-left"><?= $row->nama_lengkap; ?></td>
                    <td class="text-left"><?= isset($row->nama_jurusan) ? $row->nama_jurusan : '-'; ?></td>

                    <!-- Registrasi -->
                    <td class="text-center">
                        <?= ($nominal_reg > 0) ? 'LUNAS' : 'BELUM'; ?>
                    </td>
                    <td class="text-right"><?= number_format($nominal_reg, 0, ',', '.'); ?></td>
                    <td class="text-center"><?= !empty($row->tgl_reg) ? date('d-m-Y', strtotime($row->tgl_reg)) : '-'; ?></td>

                    <!-- Daftar Ulang -->
                    <td class="text-center">
                        <?= ($nominal_du > 0) ? 'LUNAS' : 'BELUM'; ?>
                    </td>
                    <td class="text-center"><?= !empty($row->nama_gelombang) ? $row->nama_gelombang : '-'; ?></td>
                    <td class="text-right"><?= number_format($nominal_du, 0, ',', '.'); ?></td>
                    <td class="text-center"><?= !empty($row->tgl_du) ? date('d-m-Y', strtotime($row->tgl_du)) : '-'; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr style="background-color: #F2F2F2; font-weight: bold;">
                <td colspan="4" class="text-center">TOTAL KESELURUHAN</td>
                <td class="text-center">-</td>
                <td class="text-right"><?= number_format($total_reg, 0, ',', '.'); ?></td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-center">-</td>
                <td class="text-right"><?= number_format($total_du, 0, ',', '.'); ?></td>
                <td class="text-center">-</td>
            </tr>
        </tfoot>
    </table>

</body>

</html>