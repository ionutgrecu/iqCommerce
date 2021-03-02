<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ProductCategoriesService;
use Illuminate\Http\Request;

class CategoriesController extends Controller {

    private $servicce;

    function __construct() {
        parent::__construct();

        $this->servicce = new ProductCategoriesService;
    }

    /**
     * Return categories
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json(['status' => 'ok', 'data' => $this->servicce->getAll()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\App\Http\Requests\Api\CategoryRequest $request) {
//        print_r(request()->file('image'));
//        if (request()->file('image')->isValid() && in_array(request()->file('image')->extension(), config('app.extensions.images'))) {
////            $request->file('image')->storeAs();
//        }
        return response()->json(['status' => 'ok', 'request' => \Request::all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
