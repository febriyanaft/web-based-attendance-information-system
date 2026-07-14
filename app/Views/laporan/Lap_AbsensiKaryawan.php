<!-- Febriyana Triwijayanti - 2412501591 -->
<!-- Amanda Safira Bilqis - 24125010221 -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Absensi Karyawan</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 5px; }
        th { background-color: #f2f2f2; text-align: center; }
        h3 { margin-bottom: 5px; }
        p { margin: 2px 0; }
        .bulan-row {
            background-color: #eee;
            font-weight: bold;
            text-align: left;
        }
    </style>
</head>
<body>

<?php
$currentKaryawan = '';
$currentBulan    = '';

foreach ($data as $row):

    $bulan = date('F Y', strtotime($row->tanggal));

    // ===== GANTI KARYAWAN =====
    if ($row->id_karyawan !== $currentKaryawan):

        // tutup tabel sebelumnya
        if ($currentKaryawan !== '') {
            echo '</tbody></table><br><br>';
        }
?>

<h3>Nama Karyawan : <?= $row->nama ?></h3>
<p>Jabatan : <?= $row->nama_jabatan ?></p>

<table>
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Status</th>
            <th>Jam Masuk</th>
            <th>Jam Keluar</th>
        </tr>
    </thead>
    <tbody>

<?php
        $currentKaryawan = $row->id_karyawan;
        $currentBulan    = '';
    endif;

    // ===== GANTI BULAN =====
    if ($bulan !== $currentBulan):
?>

<tr>
    <td colspan="4" class="bulan-row">Bulan : <?= $bulan ?></td>
</tr>

<?php
        $currentBulan = $bulan;
    endif;
?>

<tr>
    <td><?= date('d/m/Y', strtotime($row->tanggal)); ?></td>
    <td><?= $row->status ?></td>
    <td><?= $row->status === 'Hadir' ? $row->jam_masuk : '-' ?></td>
    <td><?= $row->status === 'Hadir' ? $row->jam_keluar : '-' ?></td>
</tr>

<?php endforeach; ?>

</tbody>
</table>

<p style="text-align: right; margin-top: 20px;">Kelompok 4</p>

</body>
</html>
