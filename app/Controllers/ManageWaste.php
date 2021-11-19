<?php

namespace App\Controllers;

use App\Models\Manage\WasteModel;

use monken\TablesIgniter;
use App\Controllers\BaseController;

class ManageWaste extends BaseController
{
	public function index()
	{
		//
		return view('admin/manage/waste');
	}
	public function fetch_allB()
	{
		$manageModel = new WasteModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($manageModel->noticeFunction())
			->setDefaultOrder("created_at", "DESC")
			->setSearch(["id", "waste"])
			->setOrder(["id", "waste", "created_at", false])
			->setOutput(["id", "waste", "created_at", $manageModel->button()]);
		return $data_table->getDatatable();
	}
	public function actionB()
	{
		if ($this->request->getVar('action')) {
			helper(['form', 'url']);
			$type_error = '';

			$error = 'no';
			$updated = 'no';

			$error = $this->validate([
				'waste' => 'required|min_length[3]',
			]);

			if (!$error) {
				$error = 'yes';
				$validation = \Config\Services::validation();
				if ($validation->getError('waste')) {
					$waste_error = $validation->getError('waste');
				}
			} else {
				$error = 'no';
				if ($this->request->getVar('action') == 'Add') {

					$manageModel = new WasteModel();
					$manageModel->save([
						'waste' => $this->request->getVar('waste')


					]);
				}
				if ($this->request->getVar('action') == 'Edit') {
					$updated = 'yes';


					$manageModel = new WasteModel();

					$id = $this->request->getVar('hidden_id');
					$data = [
						'waste' => $this->request->getVar('waste')

					];
					$manageModel->update($id, $data);
				}
			}

			$output = array(
				'waste_error' => $type_error,

				'error' => $error,
				'updated' => $updated,
			);

			echo json_encode($output);
		}
	}

	public function fetch_single_dataB()
	{
		if ($this->request->getVar('id')) {
			$manageModel = new WasteModel();
			$user_data = $manageModel->where('id', $this->request->getVar('id'))->first();
			echo json_encode($user_data);
		}
	}
	public function delete()
	{
		if ($this->request->getVar('id')) {
			$id = $this->request->getVar('id');
			$manageModel = new WasteModel();
			$manageModel->where('id', $id)->delete($id);
		}
	}
}
