<?php
namespace App\Models;

use CodeIgniter\Model;

class DetailAbsensiModel extends Model
{
    protected $table      = 'detail_absensi';
    protected $primaryKey = 'id_detail';
    protected $returnType = 'object';

    protected $allowedFields = [
    'id_absensi',
    'id_karyawan',
    'jam_masuk',
    'jam_keluar'
];


    /* =========================
       AMBIL DETAIL PER ABSENSI
    ========================= */
    public function getDetailByAbsensi($id_absensi)
{
    return $this->db->table('detail_absensi d')
        ->select('d.*, a.status, k.nama, j.nama_jabatan')
        ->join('absensi a', 'a.id_absensi = d.id_absensi')
        ->join('karyawan k', 'k.id_karyawan = a.id_karyawan')
        ->join('jabatan j', 'j.id_jabatan = k.id_jabatan')
        ->where('d.id_absensi', $id_absensi)
        ->get()
        ->getResult();
}


    /* =========================
       HAPUS DETAIL
    ========================= */
    public function hapusDetail($id_detail)
    {
        return $this->delete($id_detail);
    }

    public function simpanDetail($data)
    {
        return $this->db->table($this->table)->replace($data);
    }

    /* =========================
       UPDATE DETAIL
    ========================= */
    public function updateDetail($id_absensi, $id_karyawan, $data)
    {
        return $this->where('id_absensi', $id_absensi)
                    ->where('id_karyawan', $id_karyawan)
                    ->set($data)
                    ->update();
    }
}