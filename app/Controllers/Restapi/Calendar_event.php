<?php

namespace App\Controllers\Restapi;

use CodeIgniter\RESTful\ResourceController;
use App\Models\Calendar_event_model;
use App\Models\Group_logbook_model;
use App\Models\User_model;


class Calendar_event extends ResourceController
{
    //protected $Calendar_event_model;
    public function __construct()
    {
        //$this->foodModel = new M_Food();
        $this->m_calendar = new Calendar_event_model();
        $this->m_group_logbook = new Group_logbook_model();
    }

    public function index()
    {
        // $m_calendar = new Calendar_event_model();
        // $m_group_logbook = new Group_logbook_model();
        $group_logbook 	= $m_group_logbook->listing();

        $akses_level =  $this->request->getVar('akses_level');
        $cond = array();
        $where = false;
        if($akses_level != "Admin"){
            $id_user = $this->request->getVar('id_user');
            $cond["id_user"] = $id_user;
            $where = true;
        }
  
        $data_calendar = $m_calendar->get_list($where, $cond="");
		$calendar = array();
		foreach ($data_calendar as $key => $val) 
		{
			$calendar[] = array(
				'id' 	=> intval($val->id), 
				'title' => $val->title, 
				'description' => trim($val->description), 
				'start' => date_format( date_create($val->start_date) ,"Y-m-d H:i:s"),
				'end' 	=> date_format( date_create($val->end_date) ,"Y-m-d H:i:s"),// H:i:s
				'color' => $val->color,
			);
		}

        $data = [	'status'			=> 'OK',
					'calendar'		=> $calendar,
                    'group_logbook'=> $group_logbook
				];

        return $this->respond($data);
    }

    public function show($id = '')
    {
        $data       = $this->foodModel->getProductDetail($id);

        return $this->respond($data);
    }
}
