<?php

namespace App\Controllers;

use App\models\ManageBarangayModel;
use App\Controllers\BaseController;

class UserLog extends BaseController
{
	public function index()
	{
		return view('user_brgy/login');
	}
	public function logout()
	{
		session()->destroy();
		return redirect()->to('userlogin');
	}
	public function loginAuth()
	{
		$session = session();
		$userModel = new ManageBarangayModel();

		$username = $this->request->getVar('username');
		$password = $this->request->getVar('password');

		$data = $userModel->where('username', $username)->first();

		if ($data) {
			$pass = $data['password'];
			$authenticatePassword = password_verify($password, $pass);
			if ($authenticatePassword) {
				$ses_data = [
					'id'	=> $data['id'],
					'name' => $data['name'],
					'username' => $data['username'],
					'account_type' => $data['account_type'],
					'isLoggedInUser' => TRUE
				];
				$session->set($ses_data);
				if (session()->get('account_type') == 'Barangay') {


					return redirect()->to('dataEntry');
				} else {
					return redirect()->to('dataEntryDump');
				}
			} else {
				$session->setFlashdata('msg', 'Wrong Password.');
				return redirect()->to('userlogin');
			}
		} else {
			$session->setFlashdata('msg', 'Username not Found!');
			return redirect()->to('userlogin');
		}
	}
}
