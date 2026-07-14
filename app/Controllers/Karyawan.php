<?php
namespace App\Controllers;
use App\Models\KaryawanModel;

class Karyawan extends BaseController
{
    public function index()
    {
        $model = new KaryawanModel();
        $data['getKaryawan'] = $model->getKaryawanWithJabatan();
        return view('karyawanView', $data);
    }

    public function tambah()
    {
        return view('tambahkaryawanView');
    }

    public function add()
    {
        $model = new KaryawanModel();
        $data = [
            'id_karyawan' => $this->request->getPost('id_karyawan'),
            'nama'        => $this->request->getPost('nama'),
            'id_jabatan'  => $this->request->getPost('id_jabatan'),
            'alamat'      => $this->request->getPost('alamat'),
            'no_telp'     => $this->request->getPost('no_telp')
        ];
        $model->saveKaryawan($data);
        echo '<script>
                alert("Sukses Tambah Data Karyawan!: Kelompok 4");
                window.location="'.base_url('karyawan').'";
              </script>';
    }

    public function edit($id)
    {
        $model = new KaryawanModel();
        $data['karyawan'] = $model->getKaryawan($id);
        if($data['karyawan']){
            return view('editkaryawanView', $data);
        } else {
            echo '<script>
                    alert("ID karyawan '.$id.' Tidak ditemukan!: Kelompok 4");
                    window.location="'.base_url('karyawan').'";
                  </script>';
        }
    }

    public function update()
    {
        $model = new KaryawanModel();
        $id = $this->request->getPost('id_karyawan');
        $data = [
            'nama'       => $this->request->getPost('nama'),
            'id_jabatan' => $this->request->getPost('id_jabatan'),
            'alamat'     => $this->request->getPost('alamat'),
            'no_telp'    => $this->request->getPost('no_telp')
        ];
        $model->editKaryawan($data, $id);
        echo '<script>
                alert("Sukses Edit Data Karyawan!: Kelompok 4");
                window.location="'.base_url('karyawan').'";
              </script>';
    }

    public function hapus($id)
    {
        $model = new KaryawanModel();
        $cek = $model->getKaryawan($id);
        if($cek){
            $model->hapusKaryawan($id);
            echo '<script>
                    alert("Hapus Data Karyawan Sukses!: Kelompok 4");
                    window.location="'.base_url('karyawan').'";
                  </script>';
        } else {
            echo '<script>
                    alert("ID karyawan '.$id.' Tidak ditemukan!: Kelompok 4");
                    window.location="'.base_url('karyawan').'";
                  </script>';
        }
    }
}
