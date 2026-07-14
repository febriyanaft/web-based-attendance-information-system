<?php
namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table            = 'absensi';
    protected $primaryKey       = 'id_absensi';
    protected $useAutoIncrement = false;
    protected $returnType       = 'object';

    // WAJIB SESUAI STRUKTUR DB
    protected $allowedFields = [
    'id_absensi',
    'tanggal',
    'id_karyawan',
    'status',
    'keterangan'
];


    /* =========================
       GENERATE ID ABSENSI
    ========================= */
    public function generateIdAbsensi()
    {
        $last = $this->orderBy('id_absensi', 'DESC')->first();

        if (!$last) {
            return 'A001';
        }

        $num = (int) substr($last->id_absensi, 1) + 1;
        return 'A' . str_pad($num, 3, '0', STR_PAD_LEFT);
    }

    /* =========================
       AMBIL ABSENSI + KARYAWAN
    ========================= */
    public function getAbsensi()
{
    return $this->select('
            absensi.*,
            detail_absensi.jam_masuk,
            detail_absensi.jam_keluar,
            karyawan.nama,
            jabatan.nama_jabatan
        ')
        ->join('detail_absensi', 'detail_absensi.id_absensi = absensi.id_absensi', 'left')
        ->join('karyawan', 'karyawan.id_karyawan = absensi.id_karyawan')
        ->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan')
        ->orderBy('tanggal', 'DESC') // urut dari terbaru ke lama
        ->findAll();
}


    /* =========================
       HAPUS ABSENSI
    ========================= */
    public function hapusAbsensi($id_absensi)
    {
        return $this->delete($id_absensi);
    }
}