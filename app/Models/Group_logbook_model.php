<?php 
namespace App\Models;

use CodeIgniter\Model;

class Group_logbook_model extends Model
{

    protected $table = 'group_logbook';
    protected $primaryKey = 'id_group_logbook';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['id_group_logbook', 'group_name', 'color', 'created_user_id', 'created_dttm', 'updated_user_id', 'updated_dttm'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_dttm';
    protected $updatedField  = 'updated_dttm';
    //protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    // listing
    public function listing()
    {
        $builder = $this->db->table('group_logbook');
        $builder->orderBy('group_logbook.id_group_logbook','DESC');
        $query = $builder->get();
        return $query->getResultArray();
    }

    // total
    public function total()
    {
        $builder = $this->db->table('group_logbook');
        $builder->select('COUNT(*) AS total');
        $builder->orderBy('group_logbook.id_group_logbook','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }

    // detail
    public function detail($id_group_logbook)
    {
        $builder = $this->db->table('group_logbook');
        $builder->where('id_group_logbook',$id_group_logbook);
        $builder->orderBy('group_logbook.id_group_logbook','DESC');
        $query = $builder->get();
        return $query->getRowArray();
    }
}