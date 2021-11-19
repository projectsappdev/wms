<?php

namespace App\Controllers;

use App\Models\ManageBarangayModel;
use App\Models\Manage\WasteModel;
use App\Models\WasteDumpsiteModel;
use App\Controllers\BaseController;

class WasteDumpsite extends BaseController
{
	public function index()
	{
		$variable = array(1, 2, 3);
		$arrayofObject = array(4, 5, 6);
		//
		$wasteModel = new WasteModel();
		$barangayModel = new ManageBarangayModel();
		/*	$data = $wasteModel->fetchWaste(); */
		$data['variable'] =  $barangayModel->listUser(); //from db or hardcoded

		$data['arrayofObject'] =  $wasteModel->fetchWaste(); //from db or hardcoded

		//from db or hardcoded
		//$data = $barangayModel->findAll();

		return view("admin/monitoring/dumpsite_waste_collection", $data);
	}
	public function table_data()
	{
		date_default_timezone_set("Asia/Manila");
		$model = new WasteDumpsiteModel();

		$dateFrom = $this->request->getVar('dateFrom');
		$select_waste = $this->request->getVar('select_waste');
		$dateTo = $this->request->getVar('dateTo');
		$select_name = $this->request->getVar('select_names');
		$listing = $model->get_datatables($select_waste, $dateFrom, $dateTo, $select_name);
		$count_data = $model->count_data();
		$filter_data = $model->filter_data($select_waste, $dateFrom, $dateTo, $select_name);
		$data = array();
		$no = $_POST['start'];

		foreach ($listing as $key) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $key->dump_name;
			$row[] = $key->waste_type;
			$row[] = $key->volume;
			$date = date_create($key->collection_date);
			//   $date = date_create("2021-08-22 11:41:15");
			$row[] = date_format($date, "Y/m/d");
			$data[] = $row;
		}
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $count_data->jml,
			"recordsFiltered" => $filter_data->jml,
			"data" => $data
		);
		echo json_encode($output);
	}
	public function Try()
	{
		$select = $this->request->getPost('multiSelection');
		$mySelection = '';

		foreach ($select as $widget) {
			$mySelection .= $widget . ", ";
		}
		$mySelection = preg_replace("/, $/", "", 	$mySelection);
		echo ($mySelection);
	}
}
