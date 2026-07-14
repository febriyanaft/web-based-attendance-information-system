<!-- Febriyana Triwijayanti - 2412501591 -->
<!-- Amanda Safira Bilqis - 2412500221 -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Data Jabatan - Sistem Absensi</title>
    <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <style>
        /* Card & Table Styling */
        .card {
            border-radius: 12px;
            overflow: hidden;
        }
        .table thead {
            background: linear-gradient(90deg, #4e73df, #224abe);
            color: #fff;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(78, 115, 223, 0.1);
        }
        .btn-sm {
            border-radius: 6px;
        }
        .btn-back {
            background-color: #5dade2; /* biru soft */
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 14px;
            transition: background-color 0.3s;
        }
        .btn-back:hover {
            background-color: #3498db; /* biru lebih tegas saat hover */
            color: white;
            text-decoration: none;
        }
        .action-buttons a {
            margin: 0 2px;
        }
        .card-body {
            padding: 1.5rem;
        }
        h2 {
            color: #4e73df;
        }
        .alert-info {
            font-weight: 500;
            background-color: #d1ecf1;
            color: #0c5460;
        }
        @media (max-width: 768px) {
            .table-responsive {
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>

<?php include "header.php"; ?>

<div class="container mt-5">

    <!-- Judul & Tombol Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2><strong>Daftar Jabatan</strong></h2>
        <a href="<?= base_url('jabatan/tambah');?>" class="btn btn-back shadow-sm">
            <i class="bi bi-plus-circle"></i> Tambah Data
        </a>
    </div>

    <!-- Card Table -->
    <div class="card shadow mb-5">
        <div class="card-body table-responsive">

            <?php if (!empty($getJabatan)) : ?>
                <table class="table table-bordered table-striped table-hover text-center mb-0 align-middle">
                    <thead>
                        <tr>
                            <th style="width: 120px;">ID Jabatan</th>
                            <th>Nama Jabatan</th>
                            <th style="width: 160px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($getJabatan as $item) : ?>
                        <tr>
                            <td><?= esc($item['id_jabatan']); ?></td>
                            <td><?= esc($item['nama_jabatan']); ?></td>
                            <td class="action-buttons">
                                <a href="<?= base_url('jabatan/edit/'.$item['id_jabatan']); ?>" 
                                   class="btn btn-success btn-sm">
                                   <i class="bi bi-pencil-square"></i> ✎𓂃
                                </a>
                                <a href="<?= base_url('jabatan/hapus/'.$item['id_jabatan']); ?>" 
                                   onclick="return confirm('Yakin ingin hapus data jabatan?: Kelompok 4')" 
                                   class="btn btn-danger btn-sm">
                                   <i class="bi bi-trash3-fill"></i> 🗑⃨̅̅̅
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else : ?>
                <div class="alert alert-info text-center mb-0">
                    Belum ada data jabatan.
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>

<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
<script src="<?= base_url('js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
