<?php 
namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\Konfigurasi_model;
use App\Models\User_model;

class Login extends BaseController
{

	public function __construct()
	{
		helper('form');
        $this->session   = session();
	}

	// Homepage
	public function index()
	{
		$session = \Config\Services::session();
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_user 		= new User_model();
		$konfigurasi 	= $m_konfigurasi->listing();

		// Start validasi
		if($this->request->getMethod() === 'post' && $this->validate(
			[
            'username' 	=> 'required|min_length[3]',
            'password'  => 'required|min_length[3]',
        	])) {
			$username 	= $this->request->getPost('username');
			$password 	= $this->request->getPost('password');
			$user 		= $m_user->login($username,$password);
			// Proses login
			if($user) {
				
				
				if($user["is_active"] == "0"){
					$this->session->setFlashdata('warning','User Belum Diaktivasi Oleh Admin');
					return redirect()->to(base_url('login'));
				}
				else{
					// Jika username password benar
					$this->session->set('username',$username);
					$this->session->set('id_user',$user['id_user']);
					$this->session->set('akses_level',$user['akses_level']);
					$this->session->set('nama',$user['nama']);
					$this->session->setFlashdata('sukses', 'Hai '.$user['nama'].', Anda berhasil login');
					return redirect()->to(base_url('admin/dasbor'));
				}
				
			}else{
				// jika username password salah
				$this->session->setFlashdata('warning','Username atau password salah');
				return redirect()->to(base_url('login'));
			}
	    }else{
			// End validasi
			$data = [	'title'			=> 'Login Administrator',
						'description'	=> $konfigurasi['namaweb'].', '.$konfigurasi['tentang'],
						'keywords'		=> $konfigurasi['namaweb'].', '.$konfigurasi['keywords'],
						'session'		=> $session
					];
			echo view('login/index',$data);
		}
		// End proses
	}

	// lupa
	public function lupa()
	{
		$session = \Config\Services::session();
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_user 		= new User_model();
		$konfigurasi 	= $m_konfigurasi->listing();

		$data = [	'title'			=> 'Lupa Password',
					'description'	=> $konfigurasi['namaweb'].', '.$konfigurasi['tentang'],
					'keywords'		=> $konfigurasi['namaweb'].', '.$konfigurasi['keywords'],
					'session'		=> $session
				];
		echo view('login/lupa',$data);
	}

	public function register()
	{
		$session = \Config\Services::session();
		$m_konfigurasi 	= new Konfigurasi_model();
		$m_user 		= new User_model();
		$konfigurasi 	= $m_konfigurasi->listing();

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
						'akses_level'	=> "User",
						'tanggal_post'	=> date('Y-m-d H:i:s'),
						'nip_nup'	=> $this->request->getPost('nip_nup'),
						'nidn_nidk'	=> $this->request->getPost('nidn_nidk'),
						'orchid_id'	=> $this->request->getPost('orchid_id'),
						'scopus_id'	=> $this->request->getPost('scopus_id'),
						'is_active'	=> 0,
					];
			$m_user->save($data);
			// masuk database
			$this->session->setFlashdata('sukses','Berhasil Registrasi, Akun Anda Akan Diaktivasi Oleh Admin Terlebih Dahulu');
			return redirect()->to(base_url('login/register'));
	    }
		else{
			$data = [	'title'			=> 'Register',
					'description'	=> $konfigurasi['namaweb'].', '.$konfigurasi['tentang'],
					'keywords'		=> $konfigurasi['namaweb'].', '.$konfigurasi['keywords'],
					'session'		=> $session
				];
			echo view('login/register',$data);
		}

		
	}

	// Logout
	public function logout()
	{
		$this->session->destroy();
		return redirect()->to(base_url('login?logout=sukses'));
	}

	
}