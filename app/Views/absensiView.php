<!-- Febriyana Triwijayanti - 2412501591 -->
<!-- Amanda Safira Bilqis - 2412500221 -->
 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Data Absensi - Sistem Absensi</title>
    <link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .card { border-radius: 12px; overflow: hidden; }
        .card-body { padding: 1.5rem; }
        table thead { background: linear-gradient(90deg, #4e73df, #224abe); color: #fff; }
        .table-hover tbody tr:hover { background-color: rgba(78, 115, 223, 0.1); }
        .btn-sm { border-radius: 6px; }
        .btn-back { background-color: #5dade2; color: white; border: none; border-radius: 6px; padding: 6px 12px; font-size: 14px; }
        .btn-back:hover { background-color: #3498db; color:white; }
        .action-buttons a, .action-buttons button { margin: 0 2px; }
        .controls { margin-bottom: 1rem; display: flex; justify-content: space-between; flex-wrap: wrap; gap:0.5rem; }
        .controls .form-select, .controls .form-control { width: auto; }
    </style>
</head>
<body>

<?php include "header.php"; ?>

<div class="container mt-5">

    <!-- Judul -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2 style="color:#4e73df;"><strong>Daftar Kehadiran</strong></h2>
        <a href="<?= site_url('absensi/tambah'); ?>" class="btn btn-back shadow-sm">Tambah Absensi</a>
    </div>

    <!-- ===== FILTER ===== -->
    <div class="controls">

        <!-- KIRI: Bulan + Tahun -->
        <div class="d-flex gap-2 align-items-center flex-wrap">
            <select id="bulanSelect" class="form-select form-select-sm">
                <option value="">Semua Bulan</option>
                <option value="01">Januari</option>
                <option value="02">Februari</option>
                <option value="03">Maret</option>
                <option value="04">April</option>
                <option value="05">Mei</option>
                <option value="06">Juni</option>
                <option value="07">Juli</option>
                <option value="08">Agustus</option>
                <option value="09">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
            </select>

            <select id="tahunSelect" class="form-select form-select-sm">
                <option value="">Semua Tahun</option>
                <?php for($y = date('Y'); $y >= 2020; $y--): ?>
                    <option value="<?= $y ?>"><?= $y ?></option>
                <?php endfor; ?>
            </select>

            <div>Total: <strong><span id="totalCount"><?= count($listAbsensi); ?></span></strong></div>
        </div>

        <!-- KANAN: Search + Limit -->
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

    <!-- ===== TABLE ===== -->
    <div class="card shadow-sm mb-5">
        <div class="card-body table-responsive">

        <?php if (!empty($listAbsensi)) : ?>
            <table class="table table-bordered table-hover text-center align-middle" id="absensiTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($listAbsensi as $a): ?>
                    <tr>
                        <td><?= $a->id_absensi ?></td>
                        <td><?= $a->tanggal ?></td>
                        <td><?= $a->nama ?></td>
                        <td><?= $a->nama_jabatan ?></td>
                        <td><?= $a->status ?></td>
                        <td><?= $a->jam_masuk ?? '-' ?></td>
                        <td><?= $a->jam_keluar ?? '-' ?></td>
                        <td>
                            <a href="<?= site_url('absensi/edit/'.$a->id_absensi); ?>" class="btn btn-success btn-sm">✎𓂃</a>
                            <button class="btn btn-danger btn-sm btn-hapus" data-id="<?= $a->id_absensi ?>">🗑⃨̅̅̅</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="alert alert-info text-center">Belum ada data absensi</div>
        <?php endif; ?>

        </div>
    </div>
</div>

<?php include "footer.php"; ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){

function updateTable(){
    const keyword = $("#searchInput").val().toLowerCase();
    const bulan   = $("#bulanSelect").val();
    const tahun   = $("#tahunSelect").val();
    const limit   = parseInt($("#rowsSelect").val());

    let show = 0;

    $("#absensiTable tbody tr").each(function(){
        const nama = $(this).find("td:nth-child(3)").text().toLowerCase();
        const tgl  = $(this).find("td:nth-child(2)").text(); // yyyy-mm-dd

        let ok = true;
        if(keyword && !nama.includes(keyword)) ok = false;
        if(bulan && tgl.substr(5,2) !== bulan) ok = false;
        if(tahun && tgl.substr(0,4) !== tahun) ok = false;

        if(ok && show < limit){
            $(this).show();
            show++;
        } else {
            $(this).hide();
        }
    });

    $("#totalCount").text(show);
}

$("#searchInput, #bulanSelect, #tahunSelect, #rowsSelect").on("change keyup", updateTable);
updateTable();

});
</script>
<script>
$(document).on("click", ".btn-hapus", function () {
    const id = $(this).data("id");
    const row = $(this).closest("tr");

    if (confirm("Yakin ingin menghapus data absensi ini?")) {
        $.ajax({
            url: "<?= site_url('absensi/hapusAjax'); ?>/" + id,
            type: "POST",
            dataType: "json",
            success: function (res) {
                if (res.status) {
                    row.fadeOut(300, function () {
                        $(this).remove();
                        updateTable(); // refresh jumlah data
                    });
                    alert(res.message);
                } else {
                    alert(res.message);
                }
            },
            error: function () {
                alert("Terjadi kesalahan sistem");
            }
        });
    }
});
</script>
<?php if (session()->getFlashdata('success')): ?>
<script>
    alert("<?= session()->getFlashdata('success'); ?>");
</script>

<?php endif; ?>
<script src="<?= base_url('js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
