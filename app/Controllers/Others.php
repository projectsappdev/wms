<?php

namespace App\Controllers;

use App\Models\Manage\WasteModel;
use App\Controllers\BaseController;

class Others extends BaseController
{
	public function index()
	{
		//

		$model = new WasteModel();
		$data = $model->findAll();
		return view('settings/others', ['data' => $data]);
	}
	public function fetch_single_data()
	{
		if ($this->request->getVar('id')) {
			$wastebarangayModel = new WasteModel();
			$user_data = $wastebarangayModel->where('id', $this->request->getVar('id'))->first();
			echo json_encode($user_data);
		}
	}
	public function updateAllow()
	{

		helper(['form', 'url']);
		$updated = 'no';

		$manageModel = new WasteModel();

		$id = $this->request->getVar('hidden_id');
		$data = [
			'status' => $this->request->getVar('rdhidden'),
			'updated_at' => date("Y-m-d")
		];
		$manageModel->update($id, $data);



		$output = array(
			'updated' => $updated,
		);

		echo json_encode($output);
	}
}
