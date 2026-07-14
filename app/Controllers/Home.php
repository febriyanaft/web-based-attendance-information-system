<?php
namespace App\Controllers;
use App\Models\KaryawanModel;
use App\Models\JabatanModel;
use App\Models\AbsensiModel;

class Home extends BaseController
{
    public function index()
    {
        $karyawanModel = new KaryawanModel();
        $jabatanModel  = new JabatanModel();
        $absensiModel  = new AbsensiModel();

        $data = [
            'totalKaryawan' => $karyawanModel->countAllResults(),
            'totalJabatan'  => $jabatanModel->countAllResults(),
            'totalAbsensi'  => $absensiModel->countAllResults()
        ];

        return view('index', $data);
    }
}
