<?php
namespace App\Controllers\Frontend;
use App\Controllers\BaseController;

class Test extends BaseController
{
    public function index()
    {
        return view('test');
    }
}
