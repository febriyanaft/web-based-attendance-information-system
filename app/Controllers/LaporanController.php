<?php

namespace App\Controllers;

use App\Models\DetailAbsensiModel;
use Dompdf\Dompdf;

class LaporanController extends BaseController
{
    public function Lap_Karyawan()
{
    // Koneksi database
    $db = \Config\Database::connect();

    // Ambil data karyawan lengkap beserta jabatan
    $dataList = $db->table('karyawan k')
        ->select('k.id_karyawan, k.nama, j.nama_jabatan, k.alamat, k.no_telp')
        ->join('jabatan j', 'j.id_jabatan = k.id_jabatan', 'left')
        ->orderBy('k.id_karyawan', 'ASC')
        ->get()
        ->getResult();

    // Panggil view laporan dan lempar data
    $html = view('laporan/lap_karyawan', ['data' => $dataList]);

    // Load Dompdf
    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);

    // Atur ukuran kertas dan orientasi
    $dompdf->setPaper('A4', 'portrait');

    // Render PDF
    $dompdf->render();

    // Tampilkan langsung di browser tanpa download otomatis
    $dompdf->stream('Lap_Daftar_Karyawan.pdf', ['Attachment' => false]);
}


    public function Lap_AbsensiKaryawan()
{
    $db = \Config\Database::connect();

    $dataList = $db->table('absensi a')
        ->select('
            a.tanggal,
            a.status,
            d.jam_masuk,
            d.jam_keluar,
            k.id_karyawan,
            k.nama,
            j.nama_jabatan
        ')
        ->join('karyawan k', 'k.id_karyawan = a.id_karyawan', 'left')
        ->join('jabatan j', 'j.id_jabatan = k.id_jabatan', 'left')
        ->join('detail_absensi d', 'd.id_absensi = a.id_absensi', 'left')
        ->orderBy('k.id_karyawan', 'ASC')
        ->orderBy('a.tanggal', 'ASC')
        ->get()
        ->getResult();

    $html = view('laporan/Lap_AbsensiKaryawan', [
        'data' => $dataList
    ]);

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('Lap_Absensi_Karyawan.pdf', ['Attachment' => false]);
}
public function Lap_Absensi()
{
    $db = \Config\Database::connect();

    $dataList = $db->table('absensi a')
        ->select('
            a.id_absensi,
            a.tanggal AS tgl_absensi,
            k.nama,
            j.nama_jabatan,
            a.status,
            d.jam_masuk,
            d.jam_keluar
        ')
        ->join('karyawan k', 'k.id_karyawan = a.id_karyawan', 'left')
        ->join('jabatan j', 'j.id_jabatan = k.id_jabatan', 'left')
        ->join('detail_absensi d', 'd.id_absensi = a.id_absensi', 'left')
        ->orderBy('a.tanggal', 'ASC')
        ->get()
        ->getResult();

    $html = view('laporan/lap_absensi', [
        'data' => $dataList
    ]);

    $dompdf = new \Dompdf\Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    $dompdf->stream('Lap_Absensi.pdf', [
        'Attachment' => false
    ]);
}
}