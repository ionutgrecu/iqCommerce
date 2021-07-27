<?php

namespace App\Http\Controllers;

use function view;

class PagesController extends Controller {

    function index() {
        return view('home');
    }

    function about() {
        return view('about');
    }

}
