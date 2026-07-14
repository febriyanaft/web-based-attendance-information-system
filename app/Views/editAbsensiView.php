<!-- Febriyana Triwijayanti - 2412501591 -->
<!-- Amanda Safira Bilqis - 2412500221 -->
 
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title>Edit Absensi - Sistem Absensi</title>
<link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
<script src="<?= base_url('jquery/jquery.min.js'); ?>"></script>
<style>
body {
    background-color: #f8f9fa;
}
h2 {
    color: #4e73df;
}
.card {
    border-radius: 12px;
    overflow: hidden;
}
.form-control {
    border-radius: 8px;
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
    background-color: #3498db;
    color: #fff;
    text-decoration: none;
}
.btn-submit {
    border-radius: 8px;
    padding: 8px 20px;
    font-weight: 500;
}
input[type="time"]:disabled {
    background-color: #e9ecef !important;
    color: #6c757d;
    cursor: not-allowed;
}
</style>
</head>
<body>

<?php include "header.php"; ?>

<div class="container py-5">

    <!-- Judul & Tombol Kembali -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2><strong>Edit Absensi</strong></h2>
        <a href="<?= site_url('absensi'); ?>" class="btn btn-back shadow-sm">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
    </div>

    <!-- Card Form -->
    <div class="card shadow-sm">
        <div class="card-body">

            <form action="<?= site_url('absensi/update-edit'); ?>" method="post">

                <input type="hidden" name="id_absensi" value="<?= esc($absensi->id_absensi); ?>">

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">ID Absensi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control shadow-sm" value="<?= esc($absensi->id_absensi); ?>" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Tanggal</label>
                    <div class="col-sm-9">
                        <input type="date" name="tanggal" class="form-control shadow-sm" value="<?= esc($absensi->tanggal); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Nama</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control shadow-sm" value="<?= esc($absensi->nama); ?>" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Jabatan</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control shadow-sm" value="<?= esc($absensi->nama_jabatan); ?>" readonly>
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <select name="status" id="status" class="form-control shadow-sm">
                            <option value="Hadir" <?= $absensi->status=='Hadir'?'selected':''; ?>>Hadir</option>
                            <option value="Izin"  <?= $absensi->status=='Izin'?'selected':''; ?>>Izin</option>
                            <option value="Sakit" <?= $absensi->status=='Sakit'?'selected':''; ?>>Sakit</option>
                            <option value="Alpha" <?= $absensi->status=='Alpha'?'selected':''; ?>>Alpha</option>
                        </select>
                    </div>
                </div>

                <?php
                $jamMasuk  = $details[0]->jam_masuk ?? '';
                $jamKeluar = $details[0]->jam_keluar ?? '';
                ?>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Jam Masuk</label>
                    <div class="col-sm-9">
                        <input type="time" name="jam_masuk" id="jam_masuk" class="form-control shadow-sm" value="<?= esc($jamMasuk); ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Jam Keluar</label>
                    <div class="col-sm-9">
                        <input type="time" name="jam_keluar" id="jam_keluar" class="form-control shadow-sm" value="<?= esc($jamKeluar); ?>">
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-submit btn-success shadow-sm">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

<script>
$(document).ready(function () {
    function toggleJam() {
        const status = $("#status").val();
        if (status !== 'Hadir') {
            $("#jam_masuk, #jam_keluar").val('').prop('disabled', true);
        } else {
            $("#jam_masuk, #jam_keluar").prop('disabled', false);
        }
    }
    $("#status").on("change", toggleJam);
    toggleJam(); // auto jalan saat load
});
</script>


<?php include "footer.php"; ?>
<script src="<?= base_url('js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
