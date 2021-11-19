<?php

namespace App\Controllers;

use App\Models\Settings\AdminPasswordModel;
use App\Models\Settings\UserPasswordModel;
use App\Controllers\BaseController;

class Password extends BaseController
{
	public function index()
	{
		//

	}
	public function BarangayPass()
	{
		return view('user_brgy/changepass');
	}
	public function UpdatePassUser()
	{
		helper(['form', 'url']);
		//	$sessB = session()->get('id');

		$error = 'no';
		$passModel = new UserPasswordModel();

		$id = session()->get('id');
		$data = [
			'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
			'updated_at' => date("Y-m-d")
		];
		$passModel->update($id, $data);

		$output = array(
			'error'  => $error,

		);

		echo json_encode($output);
	}
	public function DumpsitePass()
	{
		return view('user_dumpsite/changepass');
	}
	public function UpdatePassAdmin()
	{
		//helper(['form', 'url']);
		//	$sessB = session()->get('id');

		$error = 'no';
		$passModelAdmin = new AdminPasswordModel();

		$id = session()->get('id');
		$data = [
			'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
			'updated_at' => date("Y-m-d h:i:s")
		];
		$passModelAdmin->update($id, $data);

		$output = array(
			'error'  => $error,

		);

		echo json_encode($output);
	}
	public function AdministratorPass()
	{
		return view('administrator/changepass');
	}
	public function SuperadminPass()
	{
		return view('admin/changepass');
	}
}
