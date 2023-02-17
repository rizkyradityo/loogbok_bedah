<?php 
namespace App\Controllers\Admin;

use CodeIgniter\Controller;
use App\Models\Download_model;
use App\Models\File_download_model;
use App\Models\User_model;
use App\Models\Kategori_download_model;

class File_download extends BaseController
{
	
	// index
	public function index()
	{
		checklogin();
		$m_download 			= new File_download_model();
		$download 				= $m_download->listing();
		$total 					= $m_download->total();

		$data = [	'title'			=> 'Data File Download ('.$total.')',
					'download'		=> $download,
					'content'		=> 'admin/file_download/index'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// Tambah
	public function tambah()
	{
		checklogin();
		$m_download = new File_download_model();
		$m_user = new User_model();

        $akses_level =  $this->session->get('akses_level');
        $cond = array();
        $where = false;
        if($akses_level != "Admin"){
            $id_user = $this->session->get('id_user');
            $cond["id_user"] = $id_user;
            $where = true;
        }

		$user = $m_user->listing_active($where, $cond);
        

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
				'title' => 'required',
				'file'	 	=> [
									'uploaded[file]',
					                'mime_in[file,image/jpg,image/jpeg,image/gif,image/png,application/pdf,application/doc,application/msword,application/xls,application/xlsx,application/ppt,application/pptx]',
					                'max_size[file,4096]',
            					],
        	])) {

            $data = array(
                'id_user'				=> $this->request->getVar('id_user'),
                'title'		            => $this->request->getVar('title'),
                //'file' 				    => $namabaru,
                'created_dttm'			=> date('Y-m-d H:i:s'),
                'created_user_id'	    => $this->session->get('id_user')
            );
            
			if(!empty($_FILES['file']['name'])) {
				// Image upload
				$avatar  	= $this->request->getFile('file');
				$namabaru 	= str_replace(' ','-',$avatar->getName());
	            $avatar->move(WRITEPATH . '../assets/upload/file/',$namabaru);
                //$avatar->move('/Users/umsi05/',$namabaru);
                $data['file'] = $namabaru;
	        	// masuk database
			}else{
				// $data = array(
	        	// 	'id_user'				=> $this->session->get('id_user'),
				// 	'id_kategori_download'	=> $this->request->getVar('id_kategori_download'),
				// 	'judul_download'		=> $this->request->getVar('judul_download'),
				// 	'jenis_download'		=> $this->request->getVar('jenis_download'),
				// 	'isi'					=> $this->request->getVar('isi'),
				// 	'website'				=> $this->request->getVar('website'),
				// 	'tanggal_post'			=> date('Y-m-d H:i:s')
	        	// );
	        	// $m_download->tambah($data);
        		// return redirect()->to(base_url('admin/file_download'))->with('sukses', 'Data Berhasil di Simpan');
			}
            $m_download->tambah($data);
            return redirect()->to(base_url('admin/file_download'))->with('sukses', 'Data Berhasil di Simpan');
		}

		$data = [	'title'				=> 'Tambah Download',
					'user'	            => $user,
					'content'			=> 'admin/file_download/tambah'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// edit
	public function edit($id_download)
	{
		checklogin();
		$m_download 			= new File_download_model();
		$download 				= $m_download->detail($id_download);
        $m_user = new User_model();
        $akses_level =  $this->session->get('akses_level');
        $cond = array();
        $where = false;
        if($akses_level != "Admin"){
            $id_user = $this->session->get('id_user');
            $cond["id_user"] = $id_user;
            $where = true;
        }

        $user = $m_user->listing_active($where, $cond);

		// Start validasi
		if($this->request->getMethod() === 'post' ) {

                $data = array(
                    'id_download'			=> $id_download,
                    'id_user'				=> $this->request->getVar('id_user'),
                    'title'		            => $this->request->getVar('title'),
                    //'file' 				    => $namabaru,
                    //'created_dttm'			=> date('Y-m-d H:i:s'),
                    'updated_user_id'	    => $this->session->get('id_user')
                );
			if(!empty($_FILES['file']['name']) && $this->validate(
                [
                    'title' => 'required',
                    'file'	 	=> [
                                        'uploaded[file]',
                                        'mime_in[file,image/jpg,image/jpeg,image/gif,image/png,application/pdf,document/doc,application/msword,application/xls,application/xlsx,application/ppt,application/pptx]',
                                        'max_size[file,4096]',
                                    ],
                ])) {
				// Image upload
				$avatar  	= $this->request->getFile('file');
				$namabaru 	= str_replace(' ','-',$avatar->getName());
	            $avatar->move(WRITEPATH . '../assets/upload/file/',$namabaru);
                //$avatar->move('/Users/umsi05/',$namabaru);
                $data['file'] = $namabaru;
	        	// masuk database
	            // $data = array(
	            // 	'id_download'			=> $id_download,
	        	// 	'id_user'				=> $this->session->get('id_user'),
				// 	'id_kategori_download'	=> $this->request->getVar('id_kategori_download'),
				// 	'judul_download'		=> $this->request->getVar('judul_download'),
				// 	'jenis_download'		=> $this->request->getVar('jenis_download'),
				// 	'isi'					=> $this->request->getVar('isi'),
				// 	'gambar' 				=> $namabaru,
				// 	'website'				=> $this->request->getVar('website'),
	        	// );
	        	// $m_download->edit($data);
        		// return redirect()->to(base_url('admin/download'))->with('sukses', 'Data Berhasil di Simpan');
	        }else{

	        	// $data = array(
	        	// 	'id_download'			=> $id_download,
	        	// 	'id_user'				=> $this->session->get('id_user'),
				// 	'id_kategori_download'	=> $this->request->getVar('id_kategori_download'),
				// 	'judul_download'		=> $this->request->getVar('judul_download'),
				// 	'jenis_download'		=> $this->request->getVar('jenis_download'),
				// 	'isi'					=> $this->request->getVar('isi'),
				// 	'website'				=> $this->request->getVar('website'),
	        	// );
	        	// $m_download->edit($data);
        		// return redirect()->to(base_url('admin/download'))->with('sukses', 'Data Berhasil di Simpan');
	        }
            $m_download->edit($data);
            return redirect()->to(base_url('admin/file_download'))->with('sukses', 'Data Berhasil di Simpan');
	    }

		$data = [	'title'				=> 'Edit Download: '.$download['title'],
                    'user'	            => $user,
					'download'			=> $download,
					'content'			=> 'admin/file_download/edit'
				];
		echo view('admin/layout/wrapper',$data);
	}

	// unduh
	public function unduh($id_download)
	{
		checklogin();
		$m_download 			= new File_download_model();
		$download 				= $m_download->detail($id_download);
		return $this->response->download(WRITEPATH . '../assets/upload/file/'.$download['file'], null);
	}

	// Delete
	public function delete($id_download)
	{
		checklogin();
		$m_download = new File_download_model();
		$data = ['id_download'	=> $id_download];
		$m_download->delete($data);
		// masuk database
		$this->session->setFlashdata('sukses','Data telah dihapus');
		return redirect()->to(base_url('admin/file_download'));
	}

    public function view_file()
	{
		checklogin();
        $id_download     = $this->request->getPost('id_download');
		$m_download 			= new File_download_model();
		$download 				= $m_download->detail($id_download);
        $url_file =  base_url('assets/upload/file/'.$download['file']);
        //$url_file =  base_url('assets/upload/file/SURAT-TUGAS-BOGOR-27-29-NOVEMBER-2019.pdf');
        //$view = '<iframe src="http://docs.google.com/gview?url='.$url_file.'" style="width:100%; height: 100%" frameborder="0"> </iframe>';

        $view ='<object data="'.$url_file.'" width="100%" height="500px" />';
        
         echo json_encode(array("view" => $view));
	
	}
}