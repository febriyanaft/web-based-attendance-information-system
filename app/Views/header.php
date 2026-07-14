<?php
$uri = service('uri');
$current = $uri->getSegment(1);
?>
<style>
    html {
        overflow-y: scroll;
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="home">Sistem Absensi Karyawan</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" 
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link <?= ($current=='home') ? 'active' : '' ?>" href="home"><strong>Home</strong></a>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= in_array($current, ['karyawan','jabatan']) ? 'active' : '' ?>" href="#" id="masterDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <strong>Master</strong>
          </a>
          <ul class="dropdown-menu" aria-labelledby="masterDropdown">
            <li><a class="dropdown-item <?= ($current=='karyawan')?'active':'' ?>" href="karyawan"><strong>Karyawan</strong></a></li>
            <li><a class="dropdown-item <?= ($current=='jabatan')?'active':'' ?>" href="jabatan"><strong>Jabatan</strong></a></li>
          </ul>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= ($current=='absensi') ? 'active' : '' ?>" href="#" id="transaksiDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <strong>Transaksi</strong>
          </a>
          <ul class="dropdown-menu" aria-labelledby="transaksiDropdown">
            <li><a class="dropdown-item <?= ($current=='absensi')?'active':'' ?>" href="<?= site_url('absensi');?>"><strong>Absensi</strong></a></li>
          </ul>
        </li>
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle <?= in_array($current, ['lapkaryawan','lapabsensikaryawan','lapabsensi']) ? 'active' : '' ?>" href="#" id="laporanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <strong>Laporan</strong>
          </a>
          <ul class="dropdown-menu" aria-labelledby="laporanDropdown">
            <li><a class="dropdown-item <?= ($current=='lapkaryawan')?'active':'' ?>" href="<?= site_url('lapkaryawan');?>"><strong>Data Karyawan</strong></a></li>
            <li><a class="dropdown-item <?= ($current=='lapabsensikaryawan')?'active':'' ?>" href="<?= site_url('lapabsensikaryawan');?>" target="_blank"><strong>Absensi Karyawan</strong></a></li>
            <li><a class="dropdown-item <?= ($current=='lapabsensi')?'active':'' ?>" href="<?= site_url('lapabsensi');?>" target="_blank"><strong>Laporan Absensi</strong></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
