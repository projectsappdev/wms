<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\AdminModel;

class Admin extends BaseController
{
	public function index()
	{
		//
		helper(['form']);
		return view('admin/login');
	}
	public function register()
	{
		return view('admin/register');
	}
	public function dashboard()
	{
		//$session = session();
		// echo "Hello : ".$session->get('lname');
		//return view('admin/dashboard');
	}
	public function logout()
	{
		session()->destroy();
		return redirect()->to('admin');
	}

	public function store()
	{
		helper(['form']);
		$rules = [
			'lname'          => 'required|min_length[2]|max_length[50]',
			'username'       => 'required|min_length[4]|max_length[100]|is_unique[user_superadmin.username]',
			'password'     	 => 'required|min_length[4]|max_length[50]',
			'confirmpassword' => 'matches[password]'
		];

		if ($this->validate($rules)) {
			$adminModel = new AdminModel();
			$data = [
				'lname'     => $this->request->getVar('lname'),
				'username'  => $this->request->getVar('username'),
				'password' 	=> password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
			];
			$adminModel->save($data);

			return redirect()->to('admin');
		} else {
			$data['validation'] = $this->validator;
			echo view('admin/register', $data);
		}
	}
	public function loginAuth()
	{
		$session = session();
		$adminModel = new AdminModel();

		$username = $this->request->getVar('username');
		$password = $this->request->getVar('password');

		$data = $adminModel->where('username', $username)->first();

		if ($data) {
			$pass = $data['password'];
			$authenticatePassword = password_verify($password, $pass);
			if ($authenticatePassword) {
				$ses_data = [
					'id'	=> $data['id'],
					'lname' => $data['lname'],
					'username' => $data['username'],
					'account_type' => $data['account_type'],
					'isLoggedIn' => TRUE
				];
				$session->set($ses_data);
				if (session()->get('account_type') == 'MIS') {


					return redirect()->to('/dashboard');
				} else {
					return redirect()->to('/dashboards');
				}
			} else {
				$session->setFlashdata('msg', 'Wrong Password.');
				return redirect()->to('admin');
			}
		} else {
			$session->setFlashdata('msg', 'Username not Found!');
			return redirect()->to('admin');
		}
	}
}
