<!-- Febriyana Triwijayanti - 2412501591 -->
<!-- Amanda Safira Bilqis - 24125010221 -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi - Per Periode</title>

    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 30px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        h2 { text-align: center; margin-bottom: 5px; }
        .periode {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>

<h2>Laporan Absensi</h2>

<p style="text-align:center;">
    Febriyana Triwijayanti 2412501591 | Amanda Safira Bilqis 2412500221
</p>

<p style="text-align:right;">
    Tanggal Cetak: <?= date('d-m-Y'); ?>
</p>

<?php
$currentPeriode = '';

foreach ($data as $row):

    $periode = date('F Y', strtotime($row->tgl_absensi));

    // ===== GANTI PERIODE =====
    if ($periode !== $currentPeriode):

        if ($currentPeriode !== '') {
            echo '</tbody></table>';
        }
?>

<p class="periode">Periode: <?= $periode ?></p>

<table>
    <thead>
        <tr>
            <th>ID Absensi</th>
            <th>Tanggal</th>
            <th>Nama Karyawan</th>
            <th>Jabatan</th>
            <th>Status</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
        </tr>
    </thead>
    <tbody>

<?php
        $currentPeriode = $periode;
    endif;
?>

<tr>
    <td style="text-align:center;"><?= $row->id_absensi ?></td>
    <td><?= date('d/m/Y', strtotime($row->tgl_absensi)); ?></td>
    <td><?= $row->nama ?></td>
    <td><?= $row->nama_jabatan ?></td>
    <td style="text-align:center;"><?= $row->status ?></td>
    <td style="text-align:center;">
        <?= $row->status === 'Hadir' ? $row->jam_masuk : '-' ?>
    </td>
    <td style="text-align:center;">
        <?= $row->status === 'Hadir' ? $row->jam_keluar : '-' ?>
    </td>
</tr>

<?php endforeach; ?>

</tbody>
</table>

<p style="text-align:right; margin-top:20px;">Kelompok 4</p>

</body>
</html>
