<!-- Febriyana Triwijayanti - 2412501591 -->
<!-- Amanda Safira Bilqis - 2412500221 -->
 
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tambah Absensi - Sistem Absensi</title>
<link href="<?= base_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
.table-success {
    background: linear-gradient(135deg, #4e73df33, #224abe33) !important;
}
</style>
</head>
<body>

<?php include "header.php"; ?>

<div class="container py-5">

    <!-- Judul Halaman & Tombol Kembali -->
    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
        <h2><strong>Tambah Absensi</strong></h2>
        <a href="<?= site_url('absensi'); ?>" class="btn btn-back shadow-sm">
            <i class="bi bi-arrow-left-circle"></i> Kembali
        </a>
    </div>

    <!-- Card Informasi Absensi -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h5 class="mb-3"><strong>Informasi Absensi</strong></h5>
            <table class="table table-bordered table-striped mb-0">
                <tr>
                    <th style="width: 150px;">ID Absensi</th>
                    <td>
                        <input type="text" id="id_absensi_view" class="form-control shadow-sm"
                               value="<?= $newId ?>" readonly>
                        <input type="hidden" id="id_absensi" value="<?= $newId ?>">
                    </td>
                </tr>
                <tr>
                    <th style="width: 150px;">Tanggal</th>
                    <td>
                        <input type="date" id="tanggal" class="form-control shadow-sm" required>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Card Tambah Kehadiran -->
    <div class="card shadow-sm mb-3">
        <div class="card-body">
            <h5 class="mb-3"><strong>Tambah Kehadiran Karyawan</strong></h5>
            <table class="table table-bordered table-striped table-hover text-center mb-0">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 25%;">Nama Karyawan</th>
                        <th style="width: 15%;">Status</th>
                        <th style="width: 15%;">Jam Masuk</th>
                        <th style="width: 15%;">Jam Keluar</th>
                        <th style="width: 15%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <select id="id_karyawan" class="form-control shadow-sm">
                                <option value="">--Pilih Karyawan--</option>
                                <?php foreach ($listKaryawan as $k): ?>
                                    <option value="<?= $k->id_karyawan ?>">
                                        <?= $k->nama ?> - <?= $k->nama_jabatan ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>
                            <select id="status" class="form-control shadow-sm">
                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Alpha">Alpha</option>
                            </select>
                        </td>
                        <td><input type="time" id="jam_masuk" class="form-control shadow-sm" readonly></td>
                        <td><input type="time" id="jam_keluar" class="form-control shadow-sm" readonly></td>
                        <td>
                            <button type="button" id="addAbsensi" class="btn btn-primary btn-sm shadow-sm">Add</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Card Detail Absensi -->
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="mb-3"><strong>Detail Absensi</strong></h5>
            <table class="table table-bordered table-striped table-hover text-center mb-0">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 25%;">Nama Karyawan</th>
                        <th style="width: 20%;">Jabatan</th>
                        <th style="width: 15%;">Status</th>
                        <th style="width: 20%;">Jam Masuk</th>
                        <th style="width: 20%;">Jam Keluar</th>
                    </tr>
                </thead>
                <tbody id="dataAbsensi">
                    <tr>
                        <td colspan="5" class="text-muted">Belum ada data</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
const base_url = "<?= base_url(); ?>/";
$(document).ready(function(){
    // Status → kontrol jam
    $("#status").on("change", function(){
        const status = $(this).val();
        if(status !== "Hadir"){
            $("#jam_masuk, #jam_keluar")
                .val("")
                .prop("readonly", true)
                .addClass("bg-light");
        } else {
            $("#jam_masuk, #jam_keluar")
                .prop("readonly", false)
                .removeClass("bg-light");
        }
    }).trigger("change");

    function resetForm(){
        $("#id_karyawan").val('');
        $("#status").val('Hadir').trigger("change");
        $("#jam_masuk, #jam_keluar").val('');
    }

    // BUTTON ADD (HEADER ONLY)
$("#addAbsensi").on("click", function(){
    const id_absensi  = $("#id_absensi").val();
    const tanggal     = $("#tanggal").val();
    const id_karyawan = $("#id_karyawan").val();
    const status      = $("#status").val();

    if(!tanggal){
        alert("Tanggal wajib diisi!");
        return;
    }
    if(!id_karyawan){
        alert("Pilih karyawan!");
        return;
    }

    $.ajax({
        url: base_url + "absensi/buatAbsensiAjax",
        method: "POST",
        dataType: "json",
        data: { id_absensi, tanggal, id_karyawan, status },
        success: function(res){
            if(!res.status){
                alert(res.message ?? "Gagal simpan header");
                return;
            }

            // ⬇️ SATU-SATUNYA JALAN KE DETAIL
            simpanDetail(res.id_absensi);
        },
        error: function(){
            alert("Gagal simpan header absensi");
        }
    });
});


    function simpanDetail(id_absensi){
    const id_karyawan = $("#id_karyawan").val();
    const namaText = $("#id_karyawan option:selected").text();
    const status = $("#status").val();
    const jam_masuk = status === "Hadir" ? $("#jam_masuk").val() : '--';
    const jam_keluar = status === "Hadir" ? $("#jam_keluar").val() : '--';

    if(status === "Hadir"){
        $.ajax({
            url: base_url + "absensi/tambahDetail/" + id_absensi,
            method: "POST",
            dataType: "json",
            data: {
                id_karyawan: id_karyawan,
                jam_masuk: $("#jam_masuk").val(),
                jam_keluar: $("#jam_keluar").val()
            },
            success: function(res){
                if(!res.status){
                    alert("Gagal simpan detail");
                    return;
                }
                tampilkanDiDetail();
            }
        });
    } else {
        tampilkanDiDetail();
    }

    function tampilkanDiDetail(){
        if($("#dataAbsensi .text-muted").length){
            $("#dataAbsensi").empty();
        }

        const nama = namaText.split(" - ");

        $("#dataAbsensi").append(`
            <tr>
                <td>${nama[0]}</td>
                <td>${nama[1]}</td>
                <td>${status}</td>
                <td>${jam_masuk}</td>
                <td>${jam_keluar}</td>
            </tr>
        `);

        resetForm();
        alert("Absensi berhasil ditambahkan!");
    }
}


    function loadDetail(id_absensi){
        $.getJSON(base_url + "absensi/getDetailAbsensiAjax/" + id_absensi, function(data){
            $("#dataAbsensi").empty();
            if(data.length === 0){
                $("#dataAbsensi").append(`<tr><td colspan="5" class="text-muted">Belum ada data</td></tr>`);
            } else {
                data.forEach(d => {
                    $("#dataAbsensi").append(`
                        <tr>
                            <td>${d.nama}</td>
                            <td>${d.nama_jabatan}</td>
                            <td>Hadir</td>
                            <td>${d.jam_masuk || '--'}</td>
                            <td>${d.jam_keluar || '--'}</td>
                        </tr>
                    `);
                });
            }
        });
    }
});
</script>

<?php include "footer.php"; ?>
<script src="<?= base_url('js/bootstrap.bundle.min.js'); ?>"></script>
</body>
</html>
