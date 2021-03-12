<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRequest;
use App\Services\ProductsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function response;

class ProductsController extends Controller {

    private $service;

    function __construct() {
        parent::__construct();

        $this->service = new ProductsService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return 'index';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ProductRequest $request) {
        $product = $this->service->findOrNew((integer) $request['id']);
        $this->service->fillItemWithRequest($request);

        return response()->json(['status' => 'ok', 'data' => $product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
