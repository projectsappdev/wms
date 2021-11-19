<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ManageAdminModel;
//use App\Models\Manage\WasteModel;
use monken\TablesIgniter;

class ManageAccountAdmin extends BaseController
{
	public function index()
	{
		/*	$wasteModel = new WasteModel();
		$data = $wasteModel->findAll(); 

		return view('admin/manage_admin_account', ["data" => $data]); */

		return view('admin/manage/manage_admin_account');
	}
	public function fetch_allB()
	{
		$manageModel = new ManageAdminModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($manageModel->noticeFunction())
			->setDefaultOrder("id", "DESC")
			->setSearch(["lname", "fname", "mname", "position"])
			->setOrder(["account_type", "fname", "lname", "mname", "username", "position", false])
			->setOutput(["account_type", "fname", "lname", "mname", "position", "username", $manageModel->button()]);
		return $data_table->getDatatable();
	}
	public function actionB()
	{
		if ($this->request->getVar('action')) {
			helper(['form', 'url']);
			$lname_error = '';
			$fname_error = '';
			$mname_error = '';
			$username_error = '';
			$position_error = '';
			$error = 'no';
			$updated = 'no';

			$error = $this->validate([
				'lname' => 'required|min_length[3]',
				'fname' => 'required|min_length[3]',
				'mname' => 'required|min_length[3]',
				'username' => 'required|min_length[3]',
				'position' => 'required|min_length[4]|max_length[50]',

			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('lname')) {
					$lname_error = $validation->getError('lname');
				}
				if ($validation->getError('fname')) {
					$fname_error = $validation->getError('fname');
				}
				if ($validation->getError('mname')) {
					$mname_error = $validation->getError('mname');
				}
				if ($validation->getError('username')) {
					$username_error = $validation->getError('username');
				}
				if ($validation->getError('position')) {
					$position_error = $validation->getError('position');
				}
			} else {
				$error = 'no';
				if ($this->request->getVar('action') == 'Add') {
					if ($this->request->getVar('userSelect') == 1) {
						$selectUser = 'Administrator';
					} else {
						$selectUser = 'MIS';
					}
					$manageModel = new ManageAdminModel();
					$manageModel->save([
						'lname' => $this->request->getVar('lname'),
						'fname' => $this->request->getVar('fname'),
						'mname' => $this->request->getVar('mname'),
						'username' => $this->request->getVar('username'),
						'position' => $this->request->getVar('position'),
						'account_type' => $selectUser,
						'password' => password_hash($this->request->getVar('username'), PASSWORD_DEFAULT),
					]);
				}
				if ($this->request->getVar('action') == 'Edit') {
					$updated = 'yes';

					if ($this->request->getVar('userSelect') == 1) {
						$selectUser = 'Administrator';
					} else {
						$selectUser = 'MIS';
					}
					$manageModel = new ManageAdminModel();

					$id = $this->request->getVar('hidden_id');
					$data = [
						'lname' => $this->request->getVar('lname'),
						'fname' => $this->request->getVar('fname'),
						'mname' => $this->request->getVar('mname'),
						'position' => $this->request->getVar('position'),
						'username' => $this->request->getVar('username'),
						'account_type' => $selectUser,
						'password' => password_hash($this->request->getVar('username'), PASSWORD_DEFAULT),
					];
					$manageModel->update($id, $data);
				}
			}

			$output = array(
				'lname_error' => $lname_error,
				'fname_error' => $fname_error,
				'mname_error' => $mname_error,
				'username_error' => $username_error,
				'position_error' => $position_error,
				'error' => $error,
				'updated' => $updated,
			);

			echo json_encode($output);
		}
	}
	public function fetch_single_dataB()
	{
		if ($this->request->getVar('id')) {
			$manageModel = new ManageAdminModel();
			$user_data = $manageModel->where('id', $this->request->getVar('id'))->first();
			echo json_encode($user_data);
		}
	}
	public function delete()
	{
		if ($this->request->getVar('id')) {
			$id = $this->request->getVar('id');
			$manageModel = new ManageAdminModel();
			$manageModel->where('id', $id)->delete($id);
		}
	}
	/*	public function try()
	{

		$id = $this->request->getVar('select_waste');
		$arr = array(
			'iddd' => $id
		);
		echo json_encode($arr);
	} */
}
