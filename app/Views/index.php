<!-- Febriyana Triwijayanti - 2412501591 -->
<!-- Amanda Safira Bilqis - 2412500221 -->
 
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama - Sistem Absensi</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f7f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* ===== STAT CARD ===== */
        .stat-card {
            background: #ffffff;
            color: #333;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.12);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.2s;
            height: 100%;
        }

        .stat-card:hover {
            transform: translateY(-3px);
        }

        .stat-text p {
            margin: 0;
            font-size: 0.95rem;
            color: #666;
        }

        .stat-text h3 {
            margin: 5px 0 0 0;
            font-size: 1.8rem;
            font-weight: bold;
        }

        /* Border kiri */
        .stat-karyawan { border-left: 6px solid #4e73df; }
        .stat-jabatan  { border-left: 6px solid #1cc88a; }
        .stat-absensi  { border-left: 6px solid #f6c23e; }

        .stat-icon {
            font-size: 2.5rem;
            opacity: 0.25;
        }

        /* ===== WELCOME CARD ===== */
        .welcome-card {
            margin-top: 20px;
            background: #ffffff;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.2);
        }

        .credits {
            margin-top: 15px;
            font-size: 0.9rem;
            color: #777;
        }
    </style>
</head>

<body>
<?php include "header.php"; ?>

<div class="container mt-4">

    <!-- ===== ROW STATISTIK (INI KUNCI BIAR SEJAJAR) ===== -->
    <div class="row g-4 mb-4">

        <!-- Total Karyawan -->
        <div class="col-md-4">
            <a href="<?= site_url('karyawan'); ?>" class="text-decoration-none">
                <div class="stat-card stat-karyawan">
                    <div class="stat-text">
                        <p><strong>Data Karyawan</strong></p>
                        <h3><?= $totalKaryawan ?? 0; ?></h3>
                    </div>
                    <div class="stat-icon">👥</div>
                </div>
            </a>
        </div>

        <!-- Total Jabatan -->
        <div class="col-md-4">
            <a href="<?= site_url('jabatan'); ?>" class="text-decoration-none">
                <div class="stat-card stat-jabatan">
                    <div class="stat-text">
                        <p><strong>Data Jabatan</strong></p>
                        <h3><?= $totalJabatan ?? 0; ?></h3>
                    </div>
                    <div class="stat-icon">🏷️</div>
                </div>
            </a>
        </div>

        <!-- Total Absensi -->
        <div class="col-md-4">
            <a href="<?= site_url('absensi'); ?>" class="text-decoration-none">
                <div class="stat-card stat-absensi">
                    <div class="stat-text">
                        <p><strong>Data Absensi</strong></p>
                        <h3><?= $totalAbsensi ?? 0; ?></h3>
                    </div>
                    <div class="stat-icon">📅</div>
                </div>
            </a>
        </div>

    </div>

    <!-- ===== WELCOME CARD ===== -->
    <div class="row">
        <div class="col-md-12">
            <div class="welcome-card text-center">
                <h2><strong>Selamat Datang di Sistem Absensi 📇</strong></h2>
                <h4><strong>Aplikasi ini membantu pencatatan dan pelaporan kehadiran karyawan.</strong></h4>
                <p class="credits">
                    Febriyana Triwijayanti 2412501591 | Amanda Safira Bilqis 2412500221
                </p>
            </div>
        </div>
    </div>

</div>

<?php include "footer.php"; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
