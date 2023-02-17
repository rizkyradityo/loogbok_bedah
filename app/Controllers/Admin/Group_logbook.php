<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Group_logbook_model;

class Group_logbook extends BaseController
{

	// mainpage
	public function index()
	{
		checklogin();
		$m_group_logbook = new Group_logbook_model();
		$group_logbook 	= $m_group_logbook->listing();
		$total 	= $m_group_logbook->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'group_name' 		=> 'required'
        	])) {
			// masuk database
            
			$data = [	'group_name'			=> $this->request->getPost('group_name'),
						'color'			=> $this->request->getPost('color'),
						'created_user_id'		=> $this->session->get('id_user')
					];
			$m_group_logbook->save($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah ditambah');
			return redirect()->to(base_url('admin/group_logbook'));
	    }else{
			$data = [	'title'			=> 'Grup Loogbok: '.$total['total'],
						'group_logbook'			=> $group_logbook,
						'content'		=> 'admin/group_logbook/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_group_logbook)
	{
		checklogin();
		$m_group_logbook = new Group_logbook_model();
		$group_logbook 	= $m_group_logbook->detail($id_group_logbook);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
                'group_name' 		=> 'required'
        	])) {
			// masuk database
            $data = [	'group_name'			=> $this->request->getPost('group_name'),
                        'color'			=> $this->request->getPost('color'),
                        'updated_user_id'		=> $this->session->get('id_user')
            ];

			$m_group_logbook->update($id_group_logbook,$data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diedit');
			return redirect()->to(base_url('admin/group_logbook'));
	    }else{
			$data = [	'title'			=> 'Edit Group Logbook: '.$group_logbook['group_name'],
						'group_logbook'			=> $group_logbook,
						'content'		=> 'admin/group_logbook/edit'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// delete
	public function delete($id_user)
	{
		checklogin();
		$m_user = new User_model();
		$data = ['id_user'	=> $id_user];
		$m_user->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/user'));
	}

}