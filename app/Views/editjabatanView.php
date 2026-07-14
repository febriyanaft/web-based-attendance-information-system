<!-- Febriyana Triwijayanti - 2412501591 -->
<!-- Amanda Safira Bilqis - 2412500221 -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Jabatan - Sistem Absensi</title>
    <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        label {
            min-width: 150px;
            font-weight: 500;
        }
        .card {
            border-radius: 12px;
            overflow: hidden;
        }
        .form-control {
            border-radius: 8px;
        }
        .btn-back {
            background-color: #6c757d;
            color: #fff;
        }
        .btn-back:hover {
            background-color: #5a6268;
            color: #fff;
        }
        .btn-submit {
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 500;
        }
        .card-header {
            background: linear-gradient(135deg, #4e73df, #224abe);
            color: #fff;
            font-size: 1.2rem;
        }
        .btn-back {
    background-color: #5dade2; /* biru soft */
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 6px 12px;
    font-size: 14px;
    transition: background-color 0.3s;
}
.btn-back:hover {
    background-color: #3498db; /* biru lebih gelap saat hover */
    color: #fff;
    text-decoration: none;
}

    </style>
</head>
<body>

<?php include "header.php"; ?>

<div class="container py-5">

    <!-- Tombol Kembali -->
    <div class="d-flex justify-content-end mb-3">
        <a href="<?= site_url('jabatan'); ?>" class="btn btn-back shadow-sm">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
    </div>

    <!-- Form Edit Jabatan -->
    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Edit Jabatan :</strong> <?= esc($jabatan['nama_jabatan']); ?>
        </div>
        <div class="card-body">
            <form method="post" action="<?= base_url('jabatan/update'); ?>">

                <div class="mb-3 row align-items-center">
                    <label class="col-sm-3 col-form-label">ID Jabatan</label>
                    <div class="col-sm-9">
                        <input type="text"
                               name="id_jabatan"
                               value="<?= esc($jabatan['id_jabatan']); ?>"
                               class="form-control shadow-sm"
                               readonly>
                    </div>
                </div>

                <div class="mb-3 row align-items-center">
                    <label class="col-sm-3 col-form-label">Nama Jabatan</label>
                    <div class="col-sm-9">
                        <input type="text"
                               name="nama_jabatan"
                               value="<?= esc($jabatan['nama_jabatan']); ?>"
                               class="form-control shadow-sm"
                               required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-submit btn-success shadow-sm">
                            <i class="bi bi-pencil-square"></i> Update Jabatan
                        </button>
                    </div>
                </div>

                <!-- hidden id untuk update -->
                <input type="hidden" name="id_jabatan" value="<?= esc($jabatan['id_jabatan']); ?>">

            </form>
        </div>
    </div>

</div>

<?php include "footer.php"; ?>
<script src="<?= base_url('js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
