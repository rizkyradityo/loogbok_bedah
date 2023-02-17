<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Dasbor_model;

class Dasbor extends BaseController
{
	public function index()
	{
		checklogin();		
		$data = [	'title'			=> 'Home',
					'content'		=> 'admin/dasbor/index'
				];
		echo view('admin/layout/wrapper',$data);
	}
}