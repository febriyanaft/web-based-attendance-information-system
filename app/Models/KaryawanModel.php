<?php
namespace App\Models;
use CodeIgniter\Model;

class KaryawanModel extends Model
{
    protected $table      = 'karyawan';
    protected $primaryKey = 'id_karyawan';
    protected $allowedFields = ['nama','jabatan','alamat','telepon'];
    protected $returnType = 'array'; 

    public function getKaryawan($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where('id_karyawan', $id)->first();
        }
    }

    public function getKaryawanWithJabatan()
    {
        $builder = $this->db->table('karyawan k');
        $builder->select('k.id_karyawan, k.nama, k.no_telp, k.alamat, j.nama_jabatan');
        $builder->join('jabatan j', 'k.id_jabatan = j.id_jabatan', 'left');
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function saveKaryawan($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editKaryawan($data, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_karyawan', $id);
        return $builder->update($data);
    }

    public function hapusKaryawan($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_karyawan' => $id]);
    }

    public function getKaryawanJabatan()
    {
        return $this->db->table('karyawan k')
            ->select('k.id_karyawan, k.nama, j.nama_jabatan')
            ->join('jabatan j', 'j.id_jabatan = k.id_jabatan')
            ->get()->getResult();
    }

}