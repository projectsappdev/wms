<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Demo extends BaseController
{
    public function index()
    {
        return view('demo/multiselect');
    }
}
