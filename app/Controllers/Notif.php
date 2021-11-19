<?php

namespace App\Controllers;

use App\Models\WasteBarangayModel;
use App\Controllers\BaseController;
use monken\TablesIgniter;

class Notif extends BaseController
{
	public function index()
	{
		//
		$manageModel = new WasteBarangayModel();
		//	$id = 290;
		//	$data = [
		//		'status'				=>	"0"
		//	];
		//	$manageModel->where('id', $id);
		//	$manageModel->updateall($data);
		$manageModel->updateStatus();

		$data_seen = $manageModel->seen_notif();
		$counter = 0;
		foreach ($data_seen as $row) {
			$counter = $counter + $row['status'];
			$data = array(
				'status_a' => $counter
			);
		}
		/*	$data_seen = array(
			'statuss' => 1
		); */

		echo json_encode($data);
	}

	public function load_unseen()
	{
		$manageModel = new WasteBarangayModel();
		$data_seen = $manageModel->seen_notif();
		$counter = 0;
		foreach ($data_seen as $row) {
			$counter = $counter + $row['status'];
			$data = array(
				'status_a' => $counter
			);
		}
		/*	$data_seen = array(
			'statuss' => 1
		); */

		echo json_encode($data);
	}
	public function timeStamp()
	{
		$manageModel = new WasteBarangayModel();
		$data_time = $manageModel->timeStamps();

		echo json_encode($data_time);
	}


	public function viewNotif()
	{
		$model = new WasteBarangayModel();
		$data_notif['notification'] = $model->viewN();

		return view('admin/notifications/notifications', $data_notif);
	}
}
