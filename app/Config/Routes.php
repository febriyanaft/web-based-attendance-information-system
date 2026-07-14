<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
// Home Karyawan
$routes->get('/karyawan', 'Karyawan::index');
$routes->get('karyawan', 'Karyawan::index');
// Halaman Tambah
$routes->get('karyawan/tambah', 'Karyawan::tambah');
// Halaman Edit
$routes->get('karyawan/edit/(:segment)', 'Karyawan::edit/$1');
// Proses CRUD
// Insert
$routes->get('karyawan/add', 'Karyawan::add');
$routes->post('karyawan/add', 'Karyawan::add');
// Update
$routes->get('karyawan/update', 'Karyawan::update');
$routes->post('karyawan/update', 'Karyawan::update');
// Hapus
$routes->get('karyawan/hapus/(:any)', 'Karyawan::hapus/$1');

// Home Jabatan
$routes->get('/jabatan', 'Jabatan::index');
$routes->get('jabatan', 'Jabatan::index');
// Halaman Tambah
$routes->get('jabatan/tambah', 'Jabatan::tambah');
// Halaman Edit
$routes->get('jabatan/edit/(:segment)', 'Jabatan::edit/$1');
// Proses CRUD
// Insert
$routes->get('jabatan/add', 'Jabatan::add');
$routes->post('jabatan/add', 'Jabatan::add');
// Update
$routes->get('jabatan/update', 'Jabatan::update');
$routes->post('jabatan/update', 'Jabatan::update');
// Hapus
$routes->get('jabatan/hapus/(:any)', 'Jabatan::hapus/$1');

// Home Absensi
// ================== ABSENSI ==================
$routes->get('absensi', 'Absensi::index');
$routes->get('absensi/tambah', 'Absensi::tambah');

$routes->post('absensi/buatAbsensiAjax', 'Absensi::buatAbsensiAjax');
$routes->post('absensi/tambahDetail/(:segment)', 'Absensi::tambahDetail/$1');

$routes->get('absensi/edit/(:segment)', 'Absensi::editFix/$1');
$routes->post('absensi/update-edit', 'Absensi::updateEditAbsensi');

$routes->post('absensi/hapusAjax/(:segment)', 'Absensi::hapusAjax/$1');
$routes->post('absensi/hapusDetailAjax/(:segment)', 'Absensi::hapusDetailAjax/$1');

// Home Laporan
$routes->get('/lapkaryawan', 'LaporanController::Lap_Karyawan');
$routes->get('/lapabsensi', 'LaporanController::Lap_Absensi');
$routes->get('/lapabsensikaryawan', 'LaporanController::Lap_AbsensiKaryawan');