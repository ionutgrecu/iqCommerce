<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CharacteristicRequest;
use App\Services\CategoryCharacteristicsService;
use App\Services\ProductCategoriesService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function response;

class CharacteristicsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(CategoryCharacteristicsService $service) {
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
    public function store(CharacteristicRequest $request, CategoryCharacteristicsService $service) {
        $item = $service->findOrNew((integer) $request['id']);
        $service->fillItemWithRequest($request);

        return response(['data' => $item], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, CategoryCharacteristicsService $service) {
        $item = $service->find($id)->getItem();
        $categories = (new ProductCategoriesService)->getTree();
        $nameValues = $service->getUniqueValues('name');
        $groupValues = $service->getUniqueValues('group', $item->category_id);
        $typeValues = $service->getTypeValues();
        $prependValues = $service->getUniqueValues('prepend', $item->category_id);
        $appendValues = $service->getUniqueValues('append', $item->category_id);

        return response(['data' => $item, 'categories' => $categories, 'nameValues' => $nameValues, 'groupValues' => $groupValues, 'typeValues' => $typeValues, 'prependValues' => $prependValues, 'appendValues' => $appendValues]);
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
    public function destroy($id, CategoryCharacteristicsService $service) {
        if ($service->deleteItem($id))
            return response(['id' => $id]);
        else
            return response(['id' => $id, 'message' => 'Item not found']);
    }

}
