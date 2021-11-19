<?php

namespace App\Controllers;

use App\Models\WasteDumpsiteModel;
use App\Models\Manage\WasteModel;
use App\Controllers\BaseController;
use monken\TablesIgniter;

class UserDumpsite extends BaseController
{
	public function index()
	{
		//
		$wasteModel = new WasteModel();
		$data = $wasteModel->fetchWaste();
		return view('user_dumpsite/dataEntryDump', ['data' => $data]);
	}

	public function actionD()
	{
		helper(['form', 'url', 'date']);
		$error = 'no';

		$wasteModel = new WasteModel();
		$count = $wasteModel->countRes();


		$manageModel = new WasteDumpsiteModel();

		$arr = json_encode($wasteModel->fetchWaste());
		$dataJ = json_decode($arr, true);

		for ($x = 0; $x < $count; $x++) {

			$manageModel->save([
				'volume' => $this->request->getVar($dataJ[$x]['waste']),
				'waste_type' => $dataJ[$x]['waste'],
				'dump_name'  => session()->get('name'),
				'dump_id'    => session()->get('id'),
				'collection_date' => date('Y-m-d H:i:s')

			]);
		}

		$output = array(

			'error' => $error,

		);

		echo json_encode($output);
	}
	public function fetch_single_data()
	{
		if ($this->request->getVar('id')) {
			$wastebarangayModel = new WasteDumpsiteModel();
			$user_data = $wastebarangayModel->where('id', $this->request->getVar('id'))->first();
			echo json_encode($user_data);
		}
	}
	public function fetchData()
	{
		$manageModel = new WasteDumpsiteModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($manageModel->updateData())
			->setDefaultOrder("created_at", "DESC")
			->setOutput(["waste_type", "volume", $manageModel->button()]);
		return $data_table->getDatatable();
	}
	public function fetchBacklog()
	{
		$manageModel = new WasteDumpsiteModel();
		$data_table = new TablesIgniter();

		$data_table->setTable($manageModel->backlogData())
			->setDefaultOrder("created_at", "DESC")
			->setOutput(["waste_type", "volume"]);
		return $data_table->getDatatable();
	}
	public function reviewD()
	{

		$model = new WasteDumpsiteModel();
		$data = $model->CurrentData();

		//	$data = $model->findAll();

		return view("user_dumpsite/reviewDump", ["data" => $data]);
	}
	public function updateReview()
	{

		helper(['form', 'url']);
		$updated = 'no';

		$updated = 'yes';

		$manageModel = new WasteDumpsiteModel();

		$id = $this->request->getVar('hidden_id');
		$data = [
			'volume' => $this->request->getVar('wastes'),
			'updated_at' => date("Y-m-d H:i:s")
		];
		$manageModel->update($id, $data);

		$output = array(
			'updated' => $updated,
		);

		echo json_encode($output);
	}
}
