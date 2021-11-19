<?php

namespace App\Controllers;


use App\Models\Manage\WasteModel;
use App\Models\WasteBarangayModel;
use App\Controllers\BaseController;
use monken\TablesIgniter;

class UserBarangay extends BaseController
{
	public function index()
	{
		$wasteModel = new WasteModel();
		$model = new WasteBarangayModel();
		$data["data"] = $wasteModel->findAll();
		$data["rowSub"] = $model->getRowsubmittedData();

		return view("user_brgy/data_entry", $data);
	}

	public function actionB()
	{
		helper(['form', 'url', 'date']);
		$error = 'no';
		date_default_timezone_set("Asia/Manila");
		$wasteModel = new WasteModel();
		$count = $wasteModel->countAllResults();

		$manageModel = new WasteBarangayModel();

		$arr = json_encode($wasteModel->findAll());
		$dataJ = json_decode($arr, true);
		$d = strtotime("tomorrow");
		for ($x = 0; $x < $count; $x++) {

			$manageModel->save([
				'volume' => $this->request->getVar($dataJ[$x]['waste']),
				'waste_type' => $dataJ[$x]['waste'],
				'brgy_name'  => session()->get('name'),
				'brgy_id'    => session()->get('id'),
				'collection_date' => date('Y-m-d H:i:s'),
				'attempt'	=> 3,
				'status'    => 1

			]);
		}


		$output = array(

			'error' => $error,

		);

		echo json_encode($output);
	}
	public function reviewB()
	{

		$model = new WasteBarangayModel();
		$data["data"] = $model->CurrentData();
		//	$data["attempt"] = $model->getAttempt();
		//	$data = $model->findAll();

		return view("user_brgy/review",  $data);
	}
	public function fetchData()
	{
		$manageModel = new WasteBarangayModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($manageModel->updateData())
			->setDefaultOrder("collection_date", "DESC")
			->setOutput(["waste_type", "volume", "attempt", $manageModel->button()]);
		return $data_table->getDatatable();
	}
	public function fetch_single_data()
	{
		if ($this->request->getVar('id')) {
			$wastebarangayModel = new WasteBarangayModel();
			$user_data = $wastebarangayModel->where('id', $this->request->getVar('id'))->first();
			echo json_encode($user_data);
		}
	}
	public function updateReview()
	{
		date_default_timezone_set("Asia/Manila");
		helper(['form', 'url']);
		$updated = 'no';

		$updated = 'yes';

		$manageModel = new WasteBarangayModel();

		$id = $this->request->getVar('hidden_id');
		$data = [
			'volume' => $this->request->getVar('wastes'),
			'attempt' => $this->request->getVar('attempt') - 1,
			'updated_at' => date('Y-m-d H:i:s')
		];
		$manageModel->update($id, $data);

		$output = array(
			'updated' => $updated,
		);

		echo json_encode($output);
	}
	public function getRowSubmit()
	{
		$model = new WasteBarangayModel();
	}
	public function backlog_entry()
	{
		$model = new WasteBarangayModel();
		$wasteModel = new WasteModel();
		$data["data_waste"] = $wasteModel->findAll();
		$varBacklog = $this->request->getVar('backLogDate');
		$data["data"] = $model->getSubmissionDateDB($varBacklog);
		return view('user_brgy/backlog_entry', $data);
	}
	public function backLogDisplay()
	{
		$model = new WasteBarangayModel();

		$varBacklog = $this->request->getVar('backLogDate');
		$listing = $model->getSubmissionDateDB($varBacklog);
		$data = array();

		foreach ($listing as $key) {

			$row = array();

			$row[] = $key->waste_type;
			$row[] = $key->volume;
			$row[] = $key->attempt;
			//	$date = date_create($key->collection_date);
			//   $date = date_create("2021-08-22 11:41:15");
			$row[] = '<button type="button" name="edit" class="btn btn-info btn-sm edit" data-id="' . $key->id . '"><i class="fas fa-pencil-alt"></i> </button>';
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"data" => $data
		);
		echo json_encode($output);
	}

	public function backLogInput()
	{
		helper(['form', 'url', 'date']);
		$error = 'no';
		date_default_timezone_set("Asia/Manila");
		$wasteModel = new WasteModel();
		$count = $wasteModel->countAllResults();

		$manageModel = new WasteBarangayModel();

		$arr = json_encode($wasteModel->findAll());
		$dataJ = json_decode($arr, true);

		for ($x = 0; $x < $count; $x++) {

			$manageModel->save([
				'volume' => $this->request->getVar($dataJ[$x]['waste']),
				'waste_type' => $dataJ[$x]['waste'],
				'brgy_name'  => session()->get('name'),
				'brgy_id'    => session()->get('id'),
				'collection_date' => $this->request->getVar('backLogDate'),
				'attempt'	=> 3,
				'status'    => 1

			]);
		}


		$output = array(

			'error' => $error,

		);

		echo json_encode($output);
	}
}
