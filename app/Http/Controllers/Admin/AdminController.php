<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class AdminController extends \App\Http\Controllers\Controller
{
    function index(){
        return view('admin.index');
    }
}
