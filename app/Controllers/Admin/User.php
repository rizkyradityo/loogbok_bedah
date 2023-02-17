<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\User_model;

class User extends BaseController
{

	// mainpage
	public function index()
	{
		checklogin();
		$m_user = new User_model();
		$user 	= $m_user->listing();
		$total 	= $m_user->total();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'nama' 		=> 'required',
            	'username' 	=> 'required|min_length[3]|is_unique[users.username]',
        	])) {
			// masuk database
			$data = [	'nama'			=> $this->request->getPost('nama'),
						'email'			=> $this->request->getPost('email'),
						'username'		=> $this->request->getPost('username'),
						'password'		=> sha1($this->request->getPost('password')),
						'akses_level'	=> $this->request->getPost('akses_level'),
						'tanggal_post'	=> date('Y-m-d H:i:s'),
						'nip_nup'	=> $this->request->getPost('nip_nup'),
						'nidn_nidk'	=> $this->request->getPost('nidn_nidk'),
						'orchid_id'	=> $this->request->getPost('orchid_id'),
						'scopus_id'	=> $this->request->getPost('scopus_id')
					];
			$m_user->save($data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah ditambah');
			return redirect()->to(base_url('admin/user'));
	    }else{
			$data = [	'title'			=> 'Pengguna Website: '.$total['total'],
						'user'			=> $user,
						'content'		=> 'admin/user/index'
					];
			echo view('admin/layout/wrapper',$data);
		}
	}

	// edit
	public function edit($id_user)
	{
		checklogin();
		$m_user = new User_model();
		$user 	= $m_user->detail($id_user);

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'nama' 	=> 'required|min_length[3]',
        	])) {
			// masuk database
			if(strlen($this->request->getPost('password')) >= 6 && strlen($this->request->getPost('password')) <= 32 ) {
				$data = [	'nama'			=> $this->request->getPost('nama'),
							'email'			=> $this->request->getPost('email'),
							'username'		=> $this->request->getPost('username'),
							'password'		=> sha1($this->request->getPost('password')),
							'akses_level'	=> $this->request->getPost('akses_level'),
							'nip_nup'	=> $this->request->getPost('nip_nup'),
							'nidn_nidk'	=> $this->request->getPost('nidn_nidk'),
							'orchid_id'	=> $this->request->getPost('orchid_id'),
							'scopus_id'	=> $this->request->getPost('scopus_id')
					];
			}else{
				$data = [	'nama'			=> $this->request->getPost('nama'),
							'email'			=> $this->request->getPost('email'),
							'username'		=> $this->request->getPost('username'),
							'akses_level'	=> $this->request->getPost('akses_level'),
							'nip_nup'	=> $this->request->getPost('nip_nup'),
							'nidn_nidk'	=> $this->request->getPost('nidn_nidk'),
							'orchid_id'	=> $this->request->getPost('orchid_id'),
							'scopus_id'	=> $this->request->getPost('scopus_id')
					];
			}
			$m_user->update($id_user,$data);
			// masuk database
			$this->session->setFlashdata('sukses','Data telah diedit');
			return redirect()->to(base_url('admin/user'));
	    }else{
			$data = [	'title'			=> 'Edit Pengguna: '.$user['nama'],
						'user'			=> $user,
						'content'		=> 'admin/user/edit'
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

	public function activation()
	{
		checklogin();
	
		$m_user = new User_model();
		$id_user = $this->request->getPost('id_user');
		$is_active_post = $this->request->getPost('is_active');

		$ret = "Active";
		$color = "green";
		if($is_active_post == 0){
			$is_active = 1;
		}
		else{
			$is_active = 0;
			$ret = "Inactive";
			$color = "red";
		}

		$data = [
				'is_active'	=> $is_active
				];
		
		$sql = $m_user->update($id_user,$data);
		echo json_encode(array("status" => $ret,"color"=>$color,"is_active"=>$is_active));
		// // masuk database
		// $this->session->setFlashdata('sukses','Data telah dihapus');
		// return redirect()->to(base_url('admin/user'));
	}
}