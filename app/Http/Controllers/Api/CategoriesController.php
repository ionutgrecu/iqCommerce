<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Services\ProductCategoriesService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function response;

class CategoriesController extends Controller {

    /**
     * Return categories
     *
     * @return Response
     */
    public function index(ProductCategoriesService $service) {
        return response(['data' => $service->getAll()]);
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
    public function store(CategoryRequest $request, ProductCategoriesService $service) {
        $category = $service->findOrNew((integer) $request['id']);
        $service->fillItemWithRequest($request);

        return response(['data' => $category], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, ProductCategoriesService $service) {
        $item = $service->find($id)->getItem();
        $categories = $service->getTree($item->id);

        return response(['data' => $item, 'categories' => $categories]);
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
    public function destroy($id, ProductCategoriesService $service) {
        if ($service->deleteItem($id))
            return response(['id' => $id]);
        else
            return response(['id' => $id, 'message' => 'Item not found'], 404);
    }

}
