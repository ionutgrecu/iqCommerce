<?php

namespace App\Http\Controllers;

use function view;

class PagesController extends Controller {

    function index() {
//        dd($this->data);
        return view('home');
    }

    function about() {
        return view('about');
    }

    function contact() {
        return 'contact';
    }

}
