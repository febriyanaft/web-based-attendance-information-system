<?php

namespace App\Controllers;

use App\Models\AbsensiModel;
use App\Models\DetailAbsensiModel;
use App\Models\KaryawanModel;

class Absensi extends BaseController
{
protected $absensiModel;
protected $detailAbsensiModel;
protected $karyawanModel;

public function __construct()
{
    $this->absensiModel        = new AbsensiModel();
    $this->detailAbsensiModel  = new DetailAbsensiModel();
    $this->karyawanModel       = new KaryawanModel();
}

    /* =========================
       DAFTAR ABSENSI
    ========================= */
    public function index()
    {
        $data['listAbsensi'] = $this->absensiModel->getAbsensi();
        return view('absensiView', $data);
    }

    /* =========================
       FORM TAMBAH ABSENSI
    ========================= */
    public function tambah()
    {
        return view('tambahabsensiView', [
            'listKaryawan' => $this->karyawanModel->getKaryawanJabatan(),
            'newId'        => $this->absensiModel->generateIdAbsensi()
        ]);
    }

    /* =========================
       SIMPAN HEADER ABSENSI
    ========================= */
    public function buatAbsensiAjax()
    {
        $data = [
            'id_absensi'  => $this->request->getPost('id_absensi'),
            'tanggal'     => $this->request->getPost('tanggal'),
            'id_karyawan' => $this->request->getPost('id_karyawan'),
            'status'      => $this->request->getPost('status'),
            'keterangan'  => $this->request->getPost('status')
        ];

        // Simpan header SEKALI
        if (!$this->absensiModel->find($data['id_absensi'])) {
            $this->absensiModel->insert($data);
        }

        return $this->response->setJSON([
            'status'     => true,
            'id_absensi' => $data['id_absensi'],
            'message'    => 'Header absensi berhasil disimpan!: Kelompok 4'
        ]);
    }

    public function getDetailEditAbsensi($id_absensi)
{
    $details = $this->detailAbsensiModel
        ->select('detail_absensi.*, karyawan.nama, jabatan.nama_jabatan, absensi.status')
        ->join('absensi', 'absensi.id_absensi = detail_absensi.id_absensi')
        ->join('karyawan', 'karyawan.id_karyawan = absensi.id_karyawan')
        ->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan')
        ->where('detail_absensi.id_absensi', $id_absensi)
        ->findAll();

    return $this->response->setJSON([
        'status' => true,
        'data'   => $details
    ]);
}

    public function getDetailEditAjax($id_absensi)
{
    $details = $this->detailAbsensiModel->getDetailByAbsensi($id_absensi);

    return $this->response->setJSON([
        'status' => true,
        'data'   => $details
    ]);
}


    /* =========================
       SIMPAN DETAIL (HADIR)
    ========================= */
    public function tambahDetail($id_absensi)
{
    $data = [
        'id_absensi' => $id_absensi,
        'id_karyawan'=> $this->request->getPost('id_karyawan'),
        'jam_masuk'  => $this->request->getPost('jam_masuk'),
        'jam_keluar' => $this->request->getPost('jam_keluar')
    ];

    $this->detailAbsensiModel->insert($data);
    $id_detail = $this->detailAbsensiModel->insertID();

    $row = $this->detailAbsensiModel
        ->select('detail_absensi.*, karyawan.nama, jabatan.nama_jabatan, absensi.status')
        ->join('absensi', 'absensi.id_absensi = detail_absensi.id_absensi')
        ->join('karyawan', 'karyawan.id_karyawan = detail_absensi.id_karyawan')
        ->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan')
        ->where('id_detail', $id_detail)
        ->first();

    return $this->response->setJSON([
        'status' => true,
        'data'   => $row
    ]);
}


    public function editFix($id)
{
    // Ambil header absensi
    $absensi = $this->absensiModel
        ->select('absensi.*, karyawan.nama, jabatan.nama_jabatan')
        ->join('karyawan', 'karyawan.id_karyawan = absensi.id_karyawan')
        ->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan')
        ->where('absensi.id_absensi', $id)
        ->get()
        ->getRow();

    if (!$absensi) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
    }

    // Detail diambil semua (tidak cuma Hadir)
    $details = $this->detailAbsensiModel
        ->where('id_absensi', $id)
        ->get()
        ->getResult();

    return view('editAbsensiView', [
        'absensi' => $absensi,
        'details' => $details
    ]);
}
    public function edit($id)
{
    $absensi = $this->absensiModel
        ->select('absensi.*, karyawan.nama, jabatan.nama_jabatan')
        ->join('karyawan', 'karyawan.id_karyawan = absensi.id_karyawan')
        ->join('jabatan', 'jabatan.id_jabatan = karyawan.id_jabatan')
        ->where('absensi.id_absensi', $id)
        ->get()
        ->getRow();

    if (!$absensi) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
    }

    $detailAbsensi = $this->detailAbsensiModel->getDetailByAbsensi($id);

    return view('editAbsensiView', [
        'absensi' => $absensi,
        'detailAbsensi' => $detailAbsensi
    ]);
}

    /* =========================
       LOAD DETAIL ABSENSI
    ========================= */
    public function getDetailAbsensiAjax($id_absensi)
    {
        $data = $this->detailModel->getDetailByAbsensi($id_absensi);
        return $this->response->setJSON($data);
    }

    /* =========================
   HAPUS ABSENSI (AJAX)
========================= */
public function hapusAjax($id_absensi)
{
    try {
        // Hapus detail dulu (pakai property yang benar)
        $this->detailAbsensiModel
            ->where('id_absensi', $id_absensi)
            ->delete();

        // Hapus header absensi
        $this->absensiModel->delete($id_absensi);

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Absensi berhasil dihapus!: Kelompok 4'
        ]);

    } catch (\Exception $e) {
        return $this->response->setJSON([
            'status'  => false,
            'message' => 'Gagal hapus absensi!: Kelompok 4'
        ]);
    }}

    public function hapusDetailAjax($id_detail)
{
    $hapus = $this->detailAbsensiModel->hapusDetail($id_detail);
    return $this->response->setJSON(['status'=> (bool)$hapus]);
}



    // Tambah di dalam class Absensi
// Tambah di dalam class Absensi
public function updateDetailAjax($id_detail)
{
    $jam_masuk  = $this->request->getPost('jam_masuk');
    $jam_keluar = $this->request->getPost('jam_keluar');
    $status     = $this->request->getPost('status');

    // Update detail (jam_masuk, jam_keluar)
    $data = [
        'jam_masuk'  => $jam_masuk,
        'jam_keluar' => $jam_keluar
    ];

    $this->detailAbsensiModel->update($id_detail, $data);

    // Jika perlu update status di tabel absensi (karena status di absensi, bukan detail)
    if ($status) {
        // Cari id_absensi dari id_detail
        $detail = $this->detailAbsensiModel->find($id_detail);
        if ($detail) {
            $this->absensiModel->update($detail->id_absensi, ['status' => $status]);
        }
    }

    return $this->response->setJSON([
        'status' => true
    ]);
}

    public function updateEditAbsensi()
{
    $id_absensi = $this->request->getPost('id_absensi');
    $status     = $this->request->getPost('status');
    $tanggal    = $this->request->getPost('tanggal');
    $jam_masuk  = $this->request->getPost('jam_masuk');
    $jam_keluar = $this->request->getPost('jam_keluar');

    // ===============================
    // Update HEADER absensi
    // ===============================
    $this->absensiModel->update($id_absensi, [
        'tanggal' => $tanggal,
        'status'  => $status
    ]);

    // ===============================
    // Jika status = HADIR
    // ===============================
    if ($status === 'Hadir') {

        $detail = $this->detailAbsensiModel
            ->where('id_absensi', $id_absensi)
            ->first();

        if ($detail) {
            // UPDATE detail
            $this->detailAbsensiModel->update($detail->id_detail, [
                'jam_masuk'  => $jam_masuk,
                'jam_keluar' => $jam_keluar
            ]);
        } else {
            // INSERT detail
            $this->detailAbsensiModel->insert([
                'id_absensi' => $id_absensi,
                'jam_masuk'  => $jam_masuk,
                'jam_keluar' => $jam_keluar
            ]);
        }

    } else {
        // ===============================
        // Jika status BUKAN HADIR
        // ===============================
        $this->detailAbsensiModel
            ->where('id_absensi', $id_absensi)
            ->delete();
    }

    // ===============================
    // BALIK KE HALAMAN EDIT + ALERT
    // ===============================
    return redirect()->to(site_url('absensi'))
    ->with('success', 'Data absensi berhasil diperbarui!: Kelompok 4');

}
    public function successAdd()
{
    return redirect()->to(site_url('absensi'))
        ->with('success', 'Absensi berhasil ditambahkan!');
}

    public function updateHeaderAjax()
{
    $this->absensiModel->update(
        $this->request->getPost('id_absensi'),
        [
            'tanggal' => $this->request->getPost('tanggal'),
            'status'  => $this->request->getPost('status')
        ]
    );

    return $this->response->setJSON(['status' => true]);
}


}