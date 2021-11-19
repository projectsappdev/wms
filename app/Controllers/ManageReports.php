<?php

namespace App\Controllers;

use App\Models\Manage\ReportsModel;
use App\Controllers\BaseController;
use monken\TablesIgniter;

class ManageReports extends BaseController
{
	public function index()
	{
		//
		return view('admin/manage/manage_reports');
	}
	public function fetch_allB()
	{
		$manageModel = new ReportsModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($manageModel->noticeFunction())
			->setDefaultOrder("created_at", "DESC")
			->setSearch(["id", "name"])
			//	->setOrder(["fname", "mname", "lname", "suffix", "position", "status", false])
			->setOutput(["fname", "mname", "lname", "suffix", "position",  $manageModel->button()]);
		return $data_table->getDatatable();
	}
	public function actionB()
	{
		if ($this->request->getVar('action')) {
			helper(['form', 'url']);

			$lname_error = '';
			$fname_error = '';
			$position_error = '';


			$error = 'no';
			$updated = 'no';

			$error = $this->validate([
				'lname' => 'required|min_length[3]',
				'fname' => 'required|min_length[3]',
				'position' => 'required|min_length[3]',

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
				if ($validation->getError('position')) {
					$position_error = $validation->getError('position');
				}
			} else {
				$error = 'no';
				if ($this->request->getVar('action') == 'Add') {

					$manageModel = new ReportsModel();
					$manageModel->save([
						'lname' => $this->request->getVar('lname'),
						'fname' => $this->request->getVar('fname'),
						'mname' => $this->request->getVar('mname'),
						'suffix' => $this->request->getVar('suffix'),
						'position' => $this->request->getVar('position'),
						'status' => $this->request->getVar('authority'),
						'jo' => $this->request->getVar('check_hidden_id'),

					]);
				}
				if ($this->request->getVar('action') == 'Edit') {
					$updated = 'yes';


					$manageModel = new ReportsModel();

					$id = $this->request->getVar('hidden_id');
					$data = [
						'lname' => $this->request->getVar('lname'),
						'fname' => $this->request->getVar('fname'),
						'mname' => $this->request->getVar('mname'),
						'suffix' => $this->request->getVar('suffix'),
						'position' => $this->request->getVar('position'),
						'status' => $this->request->getVar('authority'),
						'jo' => $this->request->getVar('check_hidden_id'),
					];
					$manageModel->update($id, $data);
				}
			}

			$output = array(
				'lname_error' => $lname_error,
				'fname_error' => $fname_error,
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
			$manageModel = new ReportsModel();
			$user_data = $manageModel->where('id', $this->request->getVar('id'))->first();
			echo json_encode($user_data);
		}
	}
	public function delete()
	{
		if ($this->request->getVar('id')) {
			$id = $this->request->getVar('id');
			$manageModel = new ReportsModel();
			$manageModel->where('id', $id)->delete($id);
		}
	}
}
