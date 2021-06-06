<?php

namespace App\Http\Controllers;

use function view;

class PagesController extends Controller {

    function index() {
//        dd($this->data);
        return view('home', $this->params);
    }

    function about() {
        return 'about';
    }

    function contact() {
        return 'contact';
    }

}
