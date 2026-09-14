<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Pendaftar Siswa/i SMK GRISA tahun Pelajaran 2027/2028.xls");
?>

<h3>DATA LENGKAP PENDAFTAR SPMB</h3>
<table border="1">
    <thead>
        <tr style="background-color: #f2f2f2;">
            <th>No</th>
            <th>No Pendaftaran</th>
            <th>Nama Lengkap</th>
            <th>NIK</th>
            <th>JK</th>
            <th>Tempat Lahir</th>
            <th>Tgl Lahir</th>
            <th>No HP</th>
            <th>Jalan</th>
            <th>Dusun</th>
            <th>RT/RW</th>
            <th>Desa</th>
            <th>Kecamatan</th>
            <th>Kabupaten</th>
            <th>Agama</th>
            <th>No KK</th>
            <th>Asal Sekolah</th>
            <th>Nama Ayah</th>
            <th>Status Ayah</th>
            <th>Pekerjaan Ayah</th>
            <th>Alamat Ayah</th>
            <th>No HP Ayah</th>
            <th>Nama Ibu</th>
            <th>Status Ibu</th>
            <th>Pekerjaan Ibu</th>
            <th>Alamat Ibu</th>
            <th>No HP Ibu</th>
            <th>Nama Wali</th>
            <th>Pekerjaan Wali</th>
            <th>Alamat Wali</th>
            <th>No HP Wali</th>
            <th>Hubungan Wali</th>
            <th>Jurusan</th>
            <th>Pembawa Formulir</th>
            <th>Status Verval</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        foreach ($pendaftar as $p): ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $p->no_pendaftaran; ?></td>
                <td><?= $p->nama_lengkap; ?></td>
                <td>'<?= $p->nik; ?></td>
                <td><?= $p->jenis_kelamin; ?></td>
                <td><?= $p->tempat_lahir; ?></td>
                <td><?= $p->tgl_lahir; ?></td>
                <td>'<?= $p->no_hp; ?></td>
                <td><?= $p->jalan; ?></td>
                <td><?= $p->dusun; ?></td>
                <td><?= $p->rt_rw; ?></td>
                <td><?= $p->desa; ?></td>
                <td><?= $p->kecamatan; ?></td>
                <td><?= $p->kabupaten; ?></td>
                <td><?= $p->agama; ?></td>
                <td>'<?= $p->no_kk; ?></td>
                <td><?= $p->nama_sekolah; ?></td>
                <td><?= $p->nama_ayah; ?></td>
                <td><?= $p->status_ayah; ?></td>
                <td><?= $p->pekerjaan_ayah; ?></td>
                <td><?= $p->alamat_ayah; ?></td>
                <td>'<?= $p->no_hp_ayah; ?></td>
                <td><?= $p->nama_ibu; ?></td>
                <td><?= $p->status_ibu; ?></td>
                <td><?= $p->pekerjaan_ibu; ?></td>
                <td><?= $p->alamat_ibu; ?></td>
                <td>'<?= $p->no_hp_ibu; ?></td>
                <td><?= $p->nama_wali; ?></td>
                <td><?= $p->pekerjaan_wali; ?></td>
                <td><?= $p->alamat_wali; ?></td>
                <td>'<?= $p->no_hp_wali; ?></td>
                <td><?= $p->status_hubungan_wali; ?></td>
                <td><?= $p->nama_jurusan; ?></td>
                <td><?= $p->marketing; ?></td>
                <td><?= $p->verval; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>