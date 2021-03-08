<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoryCharacteristicsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CharacteristicsController extends Controller {

    private $service;

    function __construct() {
        parent::__construct();
        $this->service = new CategoryCharacteristicsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        return response()->json(['status' => 'ok', 'data' => $this->service->getAll()]);
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
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $item = $this->service->find($id);

        return response()->json(['status' => 'ok', 'data' => $item]);
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
