<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRequest;
use App\Services\ProductImagesService;
use App\Services\ProductsService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function exceptionToArray;
use function response;

class ProductsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(ProductsService $service) {
        return response($service->paginate()->toArray());
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
    public function store(ProductRequest $request, ProductsService $service) {
        $product = $service->findOrNew((integer) $request['id']);
        $service->fillItemWithRequest($request);

        return response(['data' => $product], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, ProductsService $service) {
        try {
            $product = $service->find((integer) $id)->getItem();
        } catch (Exception $ex) {
            return response(exceptionToArray($ex), 404);
        }

        return response(['data' => $product]);
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
    public function destroy($id, ProductsService $service) {
        if ($service->deleteItem($id))
            return response(['id' => $id]);
        else
            return response(['id' => $id, 'message' => 'Item not found'], 404);
    }

    public function deleteImage($id) {
        $imageService = new ProductImagesService();
        $imageService->delete((integer) $id);

        return response(['id' => $id]);
    }

    public function defaultImage($id) {
        $imageService = new ProductImagesService();

        try {
            $imageService->find((integer) $id)->makeDefault();
        } catch (Exception $ex) {
            return response(exceptionToArray($ex), 404);
        }

        return response(['id' => $id]);
    }

}
