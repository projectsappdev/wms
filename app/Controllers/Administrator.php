<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Controllers\BaseController;

class Administrator extends BaseController
{
	public function index()
	{
		//
		helper(['form']);
		return view('administrator/login');
	}
	public function logout()
	{
		session()->destroy();
		return redirect()->to('administrator');
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
					'isLoggedIn' => TRUE
				];
				$session->set($ses_data);
				return redirect()->to('/dashboards');
			} else {
				$session->setFlashdata('msg', 'Wrong Password.');
				return redirect()->to('Administrator');
			}
		} else {
			$session->setFlashdata('msg', 'Username not Found!');
			return redirect()->to('Administrator');
		}
	}
}
