<?php
namespace App\Models;
use CodeIgniter\Model;

class JabatanModel extends Model
{
    protected $table      = 'jabatan';
    protected $primaryKey = 'id_jabatan';
    protected $allowedFields = ['nama_jabatan'];
    protected $returnType = 'array';

    // Ambil semua data jabatan atau jabatan tertentu
    public function getJabatan($id = false)
    {
        $builder = $this->db->table($this->table);
        if ($id === false) {
            return $builder->get()->getResultArray();
        } else {
            return $builder->where('id_jabatan', $id)->get()->getRowArray();
        }
    }

    // Simpan jabatan baru
    public function saveJabatan($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    // Edit/update jabatan
    public function editJabatan($data, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_jabatan', $id);
        return $builder->update($data);
    }

    // Hapus jabatan
    public function hapusJabatan($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_jabatan' => $id]);
    }
}