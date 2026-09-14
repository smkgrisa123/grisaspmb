<?php
// Header HTTP agar file terbaca sebagai Excel (.xls)
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Rekap_Kelengkapan_Berkas_SPMB_" . date('d-m-Y') . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Export Rekap Data & Berkas</title>
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
            padding: 8px;
        }

        td {
            border: 1px solid #000000;
            vertical-align: middle;
            padding: 6px;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        .fw-bold {
            font-weight: bold;
        }

        .title {
            font-size: 16pt;
            font-weight: bold;
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitle {
            font-size: 11pt;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <div class="title">REKAPITULASI KELENGKAPAN BERKAS PENDAFTAR SPMB SMK GRISA</div>
    <div class="subtitle">Tanggal Cetak: <?= date('d-m-Y H:i'); ?> WIB</div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>No. Pendaftaran</th>
                <th>Nama Pendaftar</th>
                <th>Jurusan</th>
                <?php foreach ($persyaratan as $p): ?>
                    <th><?= $p->nama_persyaratan; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($pendaftar as $row): ?>
                <tr>
                    <td class="text-center"><?= $no++; ?></td>
                    <td class="text-center fw-bold">'<?= $row->no_pendaftaran; ?></td>
                    <td class="text-left"><?= $row->nama_lengkap; ?></td>
                    <td class="text-left"><?= isset($row->nama_jurusan) ? $row->nama_jurusan : '-'; ?></td>

                    <!-- Perulangan Status Berkas Persyaratan per Siswa -->
                    <?php foreach ($persyaratan as $p): ?>
                        <?php
                        $cek = $this->db->get_where('pendaftar_persyaratan', [
                            'id_pendaftar' => $row->id_pendaftar,
                            'id_persyaratan' => $p->id_persyaratan,
                            'status' => 'sudah'
                        ])->row();
                        ?>
                        <td class="text-center">
                            <?= ($cek) ? 'SUDAH' : 'BELUM'; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>