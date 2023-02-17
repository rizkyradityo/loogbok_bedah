<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Calendar_event_model;
use App\Models\Kategori_download_model;
use App\Models\Group_logbook_model;
use App\Models\User_model;

class Calendar_event extends BaseController
{
	
	// index
	public function index()
	{
		checklogin();
        $m_calendar = new Calendar_event_model();
        $m_group_logbook = new Group_logbook_model();
        $group_logbook 	= $m_group_logbook->listing();

        $akses_level =  $this->session->get('akses_level');
        $cond = array();
        $where = false;
        if($akses_level != "Admin"){
            $id_user = $this->session->get('id_user');
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

		// $data = array();
		// $data['get_data']			= json_encode($calendar);
		// $this->load->view('calendar', $data);

        $data = [	'title'			=> 'Calender Event',
					'get_data'		=> json_encode($calendar),
                    'group_logbook'=> $group_logbook,
					'content'		=> 'admin/calender_event/index'
				];
		echo view('admin/layout/wrapper',$data);
        
	}

    public function add_event()
	{
        // var_dump("tes");die;
        $m_calendar = new Calendar_event_model();

        if($this->request->getMethod() === 'post' && $this->validate(
			[
            'title' 	=> 'required',
        	])) {

                $param = $this->request->getPost();
                
                
                $calendar_id =  $this->request->getPost('calendar_id');
                //unset($param['calendar_id']);
                unset($param['calendar_id']);

                if($calendar_id == 0)
                {
                    $param['create_at']   	= date('Y-m-d H:i:s');
                    $param['create_by']   	= $this->session->get('id_user');
                    $insert = $m_calendar->insert_c($param);
                    //var_dump($insert);die;
                    if ($insert) 
                    {
                        $response['status'] = TRUE;
                        $response['notif']	= 'Success add calendar';
                        $response['id']		= $insert;
                    }
                    else
                    {
                        $response['status'] = FALSE;
                        $response['notif']	= 'Server wrong, please save again';
                    }
                }
                else
                {
                    $param['id'] = $calendar_id;
                    $param['modified_at']   	= date('Y-m-d H:i:s');
                    $update = $m_calendar->update_c($param);

                    if ($update ) 
                    {
                        $response['status'] = TRUE;
                        $response['notif']	= 'Success add calendar';
                        $response['id']		= $calendar_id;
                    }
                    else
                    {
                        $response['status'] = FALSE;
                        $response['notif']	= 'Server wrong, please save again';
                    }
                }
                
			// masuk database
	    }else{
			$response['status'] = FALSE;
            $response['notif']	= "Title Harus diisi";
		}
        echo json_encode($response);die;
	}

	// Delete
	public function delete_event()
	{
		//checklogin();
		$m_calendar = new Calendar_event_model();

        $calendar_id =  $this->request->getPost('id');

		$data = ['idx'	=> $calendar_id];
		$ret = $m_calendar->delete($data);

        $response['status'] = TRUE;
        $response['notif']	= 'Success delete calendar';
        $response['id']		= $calendar_id;

		echo json_encode($response);die;
	}

    public function list()
	{
		checklogin();
        $m_user = new User_model();

        $akses_level =  $this->session->get('akses_level');
        $cond = array();
        $where = false;
        if($akses_level != "Admin"){
            $id_user = $this->session->get('id_user');
            $cond["id_user"] = $id_user;
            $where = true;
        }

		$user 	= $m_user->listing_active($where, $cond);

        $m_calendar = new Calendar_event_model();
  
        $data_calendar = $m_calendar->get_list_loogbook();
        

        $data = [	'title'			=> 'Calender Event',
					'data_calendar'		=> $data_calendar,
                    'user'		=> $user,
					'content'		=> 'admin/calender_event/list'
				];
		echo view('admin/layout/wrapper',$data);
        
	}

    public function list_select()
	{
        $m_calendar = new Calendar_event_model();

        $id_user = $this->request->getPost('id_user');
        $start_date = $this->request->getPost('start_date');
		$end_date = $this->request->getPost('end_date');

        $cond = array('start_date >=' => ''.$start_date.'','end_date <='  => ''.$end_date.'');
        if($id_user != ""){
            $cond["id_user"] = $id_user;
        }

        $data_calendar = $m_calendar->get_list_loogbook(true, $cond);

        $view = '<table class="table table-bordered" id="example1">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="20%">Nama</th>
                            <th width="10%">Grup Loogbok</th>
                            <th width="10%">Tanggal Awal</th>
                            <th width="10%">Tanggal Akhir</th>
                            <th width="10%">Judul</th>
                            <th width="10%">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody>';
        foreach($data_calendar as $data_calendar) { 
            $no=1;
            $view .='<tr>
                        <td>'.$no.'</td>
                        <td>'.$data_calendar['nama'].'</td>
                        <td>'.$data_calendar['group_name'].'</td>
                        <td>'.$data_calendar['start_date'].'</td>
                        <td>'.$data_calendar['end_date'].'</td>
                        <td>'.$data_calendar['title'].'</td>
                        <td>'.$data_calendar['description'].'</td>
                    </tr>';
            $no++;
        }
        $view .='</tbody>
                </table>';
    

        echo json_encode(array("view" => $view));
	}
}