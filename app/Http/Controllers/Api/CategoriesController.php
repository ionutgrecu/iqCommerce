<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Services\ProductCategoriesService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function response;

class CategoriesController extends Controller {

    private $service;

    function __construct() {
        parent::__construct();

        $this->service = new ProductCategoriesService;
    }

    /**
     * Return categories
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
    public function store(CategoryRequest $request) {
        $path = '';

        $category = $this->service->findOrNew((integer) $request['id']);
        $this->service->fillItemWithRequest($request);

        return response()->json(['status' => 'ok', 'data' => $category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $item = $this->service->find($id);
        $categories = $this->service->getTree($item->id);

        return response()->json(['status' => 'ok', 'data' => $item, 'categories' => $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
//        return response()->json(['status' => 'edit']);
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
        if ($this->service->deleteItem($id))
            return response()->json(['status' => 'ok', 'id' => $id]);
        else
            return response()->json(['status' => 'failed', 'id' => $id, 'message' => 'Item not found']);
    }

}
