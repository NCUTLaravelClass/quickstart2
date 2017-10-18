<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskController extends Controller
{
    //

    public function __construct() //建構式 使用者驗證
    {
        $this->middleware('auth');
    }
}
