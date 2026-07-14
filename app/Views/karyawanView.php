<!-- Febriyana Triwijayanti - 2412501591 -->
<!-- Amanda Safira Bilqis - 2412500221 -->
 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Data Karyawan - Sistem Absensi</title>
    <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <style>
        /* Card & Table Styling */
        .card { border-radius: 12px; overflow: hidden; }
        .table thead { background: linear-gradient(90deg, #4e73df, #224abe); color: #fff; }
        .table-hover tbody tr:hover { background-color: rgba(78, 115, 223, 0.1); }
        .btn-sm { border-radius: 6px; }
        .btn-add { background: #1cc88a; border: none; }
        .btn-add:hover { background: #17a673; }
        .action-buttons a { margin: 0 2px; }
        .card-body { padding: 1.5rem; }
        h2 { color: #4e73df; }
        .alert-info { font-weight: 500; background-color: #d1ecf1; color: #0c5460; }
        @media (max-width: 768px) { .table-responsive { overflow-x: auto; } }
        .btn-back { background-color: #5dade2; color: white; border: none; border-radius: 6px; padding: 6px 12px; font-size: 14px; transition: background-color 0.3s; }
        .btn-back:hover { background-color: #3498db; color:white; text-decoration:none; }
        .controls { margin-bottom: 1rem; display: flex; justify-content: space-between; flex-wrap: wrap; gap:0.5rem; }
        .controls .form-select, .controls .form-control { width: auto; }
    </style>
</head>
<body>

<?php include "header.php"; ?>

<div class="container mt-5">

    <!-- Judul & Tombol Tambah -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2><strong>Daftar Karyawan</strong></h2>
        <a href="<?= base_url('karyawan/tambah');?>" class="btn btn-back shadow-sm">
            <i class="bi bi-plus-circle"></i> Tambah Data
        </a>
    </div>

    <!-- Kontrol Pencarian & Jumlah -->
    <div class="controls">
        <div>Total Karyawan: <span id="totalCount"><?= count($getKaryawan); ?></span></div>
        <div class="d-flex gap-2">
            <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari nama karyawan...">
            <select id="rowsSelect" class="form-select form-select-sm">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="20">20</option>
                <option value="50">50</option>
            </select>
        </div>
    </div>

    <!-- Card Tabel Karyawan -->
    <div class="card shadow mb-5">
        <div class="card-body table-responsive">

        <?php if (!empty($getKaryawan)) : ?>
            <table class="table table-bordered table-striped table-hover text-center mb-0 align-middle" id="karyawanTable">
                <thead>
                    <tr>
                        <th style="width: 80px;">ID</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Alamat</th>
                        <th>No. Telp</th>
                        <th style="width: 140px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($getKaryawan as $item): ?>
                    <tr>
                        <td><?= esc($item['id_karyawan']); ?></td>
                        <td><?= esc($item['nama']); ?></td>
                        <td><?= esc($item['nama_jabatan']); ?></td>
                        <td><?= esc($item['alamat']); ?></td>
                        <td><?= esc($item['no_telp']); ?></td>
                        <td class="action-buttons">
                            <a href="<?= base_url('karyawan/edit/'.$item['id_karyawan']); ?>" class="btn btn-success btn-sm">
                                <i class="bi bi-pencil-square"></i> ✎𓂃
                            </a>
                            <a href="<?= base_url('karyawan/hapus/'.$item['id_karyawan']); ?>" 
                               onclick="return confirm('Yakin ingin hapus data karyawan?: Kelompok 4')" 
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
                Belum ada data karyawan.
            </div>
        <?php endif; ?>

        </div>
    </div>

</div>

<!-- Script pencarian + limit -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    function updateTable() {
        const value = $("#searchInput").val().toLowerCase();
        const maxRows = parseInt($("#rowsSelect").val());
        let visibleCount = 0;

        $("#karyawanTable tbody tr").each(function(){
            const nama = $(this).find("td:nth-child(2)").text().toLowerCase();
            if(nama.includes(value)){
                if(visibleCount < maxRows){
                    $(this).show();
                    visibleCount++;
                } else {
                    $(this).hide();
                }
            } else {
                $(this).hide();
            }
        });

        $("#totalCount").text($("#karyawanTable tbody tr:visible").length);
    }

    $("#searchInput").on("keyup", function(e){
        updateTable();
        if(e.key === "Enter"){ $(this).blur(); }
    });

    $("#rowsSelect").on("change", updateTable);

    // Inisialisasi
    updateTable();
});
</script>

<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
<script src="<?= base_url('js/bootstrap.bundle.min.js'); ?>"></script>

</body>
</html>
