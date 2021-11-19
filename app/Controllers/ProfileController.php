<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ProfileController extends BaseController
{
	public function index()
	{
		//
		$session = session();
        echo "Hello : ".$session->get('lname');
	}
}
