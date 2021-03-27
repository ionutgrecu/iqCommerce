<?php

namespace App\Http\Controllers;

use function view;

class PagesController extends Controller {

    function index() {
//        dd($this->data);
        $this->data['lang']='pt';
        return view('home');
    }

    function about() {
        return 'about';
    }

    function contact() {
        return 'contact';
    }

}
