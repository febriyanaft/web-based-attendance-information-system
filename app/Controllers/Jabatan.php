<?php
namespace App\Controllers;
use App\Models\JabatanModel;

class Jabatan extends BaseController
{
    public function index()
    {
        $model = new JabatanModel();
        $data['getJabatan'] = $model->findAll();
        return view('jabatanView', $data);
    }

    public function tambah()
    {
        return view('tambahjabatanView');
    }

    public function add()
    {
        $model = new JabatanModel();
        $data = [
            'id_jabatan'   => $this->request->getPost('id_jabatan'),
            'nama_jabatan' => $this->request->getPost('nama_jabatan')
        ];

        $model->saveJabatan($data);

        echo '<script>
                alert("Sukses Tambah Data Jabatan!: Kelompok 4");
                window.location="'.base_url('jabatan').'"
              </script>';
    }

    public function edit($id)
    {
        $model = new JabatanModel();
        $getJabatan = $model->find($id);

        if($getJabatan){
            $data['jabatan'] = $getJabatan;
            return view('editjabatanView', $data);
        } else {
            echo '<script>
                    alert("ID jabatan '.$id.' Tidak ditemukan!: Kelompok 4");
                    window.location="'.base_url('jabatan').'"
                  </script>';
        }
    }

    public function update()
    {
        $model = new JabatanModel();
        $id = $this->request->getPost('id_jabatan');
        $data = [
            'nama_jabatan' => $this->request->getPost('nama_jabatan')
        ];
        $model->update($id, $data);

        echo '<script>
                alert("Sukses Edit Data Jabatan!: Kelompok 4");
                window.location="'.base_url('jabatan').'"
              </script>';
    }

    public function hapus($id)
    {
        $model = new JabatanModel();
        $getJabatan = $model->getJabatan($id);

        if($getJabatan){
            $model->delete($id);
            echo '<script>
                    alert("Hapus Data Jabatan Sukses!: Kelompok 4");
                    window.location="'.base_url('jabatan').'"
                  </script>';
        } else {
            echo '<script>
                    alert("Hapus Gagal! ID jabatan '.$id.' Tidak ditemukan!: Kelompok 4");
                    window.location="'.base_url('jabatan').'"
                  </script>';
        }
    }
}