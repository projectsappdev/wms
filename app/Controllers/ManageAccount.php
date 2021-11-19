<?php

namespace App\Controllers;


use App\Models\ManageBarangayModel;
use monken\TablesIgniter;

class ManageAccount extends BaseController
{
	public function index()
	{
		return view('admin/manage/manage_users_account');
	}
	public function fetch_allB()
	{
		$manageModel = new ManageBarangayModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($manageModel->noticeFunction())
			->setDefaultOrder("id", "DESC")
			->setSearch(["name", "username", "email", "phone_no"])
			->setOrder(["account_type", "name", "username", "email", false, false])
			->setOutput(["account_type", "name", "username", "email", "phone_no", $manageModel->button()]);
		return $data_table->getDatatable();
	}
	public function actionB()
	{
		if ($this->request->getVar('action')) {
			helper(['form', 'url']);
			$name_b_error = '';
			$username_error = '';
			$email_error = '';
			$phone_no_error = '';

			$error = 'no';
			$updated = 'no';


			$error = $this->validate([
				'name_b'	=>	'required|min_length[3]',
				'username'	=>	'required|min_length[3]',
				'email'		=>	'required|min_length[4]|max_length[100]|valid_email',
				'phone_no'	=>	'required|min_length[4]|max_length[11]',


			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('name_b')) {
					$name_b_error = $validation->getError('name_b');
				}
				if ($validation->getError('username')) {
					$username_error = $validation->getError('username');
				}
				if ($validation->getError('phone_no')) {
					$phone_no_error = $validation->getError('phone_no');
				}
				if ($validation->getError('email')) {
					$email_error = $validation->getError('email');
				}
			} else {
				$error = 'no';
				if ($this->request->getVar('action') == 'Add') {
					if ($this->request->getVar('userSelect') == 1) {
						$selectUser = 'Barangay';
					} else {
						$selectUser = 'Dumpsite';
					}
					$manageModel = new ManageBarangayModel();
					$manageModel->save([
						'name'			=>	$this->request->getVar('name_b'),
						'username'		=>	$this->request->getVar('username'),
						'phone_no'		=>	$this->request->getVar('phone_no'),
						'email'			=>	$this->request->getVar('email'),
						'account_type'	=>	$selectUser,
						'password' 		=> password_hash($this->request->getVar('username'), PASSWORD_DEFAULT)
					]);
				}
				if ($this->request->getVar('action') == 'Edit') {
					$updated = 'yes';

					if ($this->request->getVar('userSelect') == 1) {
						$selectUser = 'Barangay';
					} else {
						$selectUser = 'Dumpsite';
					}
					$manageModel = new ManageBarangayModel();

					$id = $this->request->getVar('hidden_id');
					$data = [
						'name'				=>	$this->request->getVar('name_b'),
						'phone_no'			=>  $this->request->getVar('phone_no'),
						'email'				=>	$this->request->getVar('email'),
						'username'			=>	$this->request->getVar('username'),
						'account_type'		=>	$selectUser,
						'password' 			=>  password_hash($this->request->getVar('username'), PASSWORD_DEFAULT)
					];
					$manageModel->update($id, $data);
				}
			}

			$output = array(
				'name_b_error'		=>	$name_b_error,
				'username_error'	=>	$username_error,
				'phone_no_error'	=>	$phone_no_error,
				'email_error'		=>	$email_error,
				'error'				=>	$error,
				'updated'			=>	$updated
			);

			echo json_encode($output);
		}
	}
	public function fetch_single_dataB()
	{
		if ($this->request->getVar('id')) {
			$manageModel = new ManageBarangayModel();
			$user_data = $manageModel->where('id', $this->request->getVar('id'))->first();
			echo json_encode($user_data);
		}
	}
	public function delete()
	{
		if ($this->request->getVar('id')) {
			$id = $this->request->getVar('id');
			$manageModel = new ManageBarangayModel();
			$manageModel->where('id', $id)->delete($id);
		}
	}
	/*	public function getBname()
	{
		$id = $this->request->getVar('id');
		$db = \Config\Database::connect();
		$builder = $db->table('user_brgy');
		$query = $builder->getWhere(['brgy_id'	=> $id]);
	
		$db->close;
	} */
}
