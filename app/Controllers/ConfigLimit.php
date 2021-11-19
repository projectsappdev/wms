<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ConfigLimit extends BaseController
{


	public function writeLimit()
	{

		$file_content = $this->request->getVar('limitW');

		write_file("data.txt", $file_content);
	}
	public function readLimit()
	{
		$dataR = readfile("data.txt");

		return $dataR;
	}
}
