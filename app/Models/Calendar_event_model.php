<?php 
namespace App\Models;

use CodeIgniter\Model;

class Calendar_event_model extends Model
{

	protected $table = 'calendar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'title', 'description', 'color', 'start_date', 'end_date', 'create_at', 'create_by', 'modified_at', 'modified_by', 'id_group_logbook'];

    public function get_list($where=FALSE, $cond="" )
	{
        $builder = $this->db->table('calendar');
		if ($where) {
			$builder->where($cond);
		}
		$query = $builder->get();
        return $query->getResult();
	}	

	public function insert_c($data)
	{
        $builder = $this->db->table('calendar');
        return $builder->insert($data);
        //return $builder;
	}

	public function update_c($data)
	{
		$builder = $this->db->table('calendar');
        $builder->where('id',$data['id']);
        return $builder->update($data);
	}

	public function delete_c($where)
	{
		$this->db->where($where);
		$this->db->delete('calendar');
		return $this->db->affected_rows();
	}

	public function get_list_loogbook($where=FALSE, $cond="")
    {
        $builder = $this->db->table('calendar');
        $builder->select('calendar.*, group_logbook.group_name, users.nama');
        $builder->join('group_logbook','calendar.color = group_logbook.color','LEFT');
        $builder->join('users','users.id_user = calendar.create_by','LEFT');
		if($where == true){
			$builder->where($cond);
		}
       // $builder->where('staff.id_kategori_staff',$id_kategori_staff);
        $builder->orderBy('calendar.start_date','ASC');
        $query = $builder->get();
        return $query->getResultArray();
    }

}