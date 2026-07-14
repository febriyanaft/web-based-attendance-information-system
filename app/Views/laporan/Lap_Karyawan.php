<!-- Febriyana Triwijayanti - 2412501591 -->
<!-- Amanda Safira Bilqis - 24125010221 -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Daftar Karyawan</title>
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
            padding: 5px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p { margin: 2px 0; }

    </style>
</head>
<body>

<h2>Laporan Data Karyawan</h2>

<p style="text-align:center;">
    Febriyana Triwijayanti 2412501591 | Amanda Safira Bilqis 2412500221
</p>

<table>
    <thead>
        <tr>
            <th>ID Karyawan</th>
            <th>Nama Karyawan</th>
            <th>Jabatan</th>
            <th>Alamat</th>
            <th>No. Telp</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
        <tr>
            <td style="text-align:center;"><?= $row->id_karyawan ?></td>
            <td><?= $row->nama ?></td>
            <td><?= $row->nama_jabatan ?></td>
            <td><?= $row->alamat ?></td>
            <td><?= $row->no_telp ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<p style="text-align: right; margin-top: 20px;">Kelompok 4</p>

</body>
</html>
