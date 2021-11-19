<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Mode extends BaseController
{
	public function index()
	{
		//
	}
	function modeOff()
	{

		$dataJson = file_get_contents("data.json");
		$data =  json_decode($dataJson, true);
		$data["mode"] = "off";
		$dataJson = json_encode($data);
		file_put_contents("data.json", $dataJson);
	}
	function modeOn()
	{

		$dataJson = file_get_contents("data.json");
		$data =  json_decode($dataJson, true);
		$data["mode"] = "on";
		$dataJson = json_encode($data);
		file_put_contents("data.json", $dataJson);
	}
	function dJson()
	{
		$dataJson = json_decode(file_get_contents("data.json"));
		echo json_encode($dataJson);
	}
}
