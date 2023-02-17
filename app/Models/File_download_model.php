<?php 
namespace App\Models;

use CodeIgniter\Model;

class File_download_model extends Model
{

	protected $table = 'file_download';
    protected $primaryKey = 'id_download';
    protected $allowedFields = [];

    // Listing
    public function listing()
    {
        $builder = $this->db->table('file_download');
        $builder->select('file_download.*, users.nama');
        $builder->join('users','users.id_user = file_download.id_user','LEFT');
        $builder->orderBy('file_download.id_download','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('file_download');
        $query = $builder->get();
        return $query->getNumRows();
    }

    // detail
    public function detail($id_download)
    {
        $builder = $this->db->table('file_download');
        $builder->select('file_download.*, users.nama');
        $builder->join('users','users.id_user = file_download.id_user','LEFT');
        $builder->where('file_download.id_download',$id_download);
        $builder->orderBy('file_download.id_download','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // tambah
    public function tambah($data)
    {
        $builder = $this->db->table('file_download');
        $builder->insert($data);
    }

    // tambah
    public function edit($data)
    {
        $builder = $this->db->table('file_download');
        $builder->where('id_download',$data['id_download']);
        $builder->update($data);
    }
    
    // slider
    public function slider()
    {
        $builder = $this->db->table('file_download');
        $builder->where('jenis_download','Homepage');
        $builder->orderBy('download.id_download','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    
}