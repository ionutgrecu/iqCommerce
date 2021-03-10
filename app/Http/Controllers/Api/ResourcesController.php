<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CategoryCharacteristicsService;
use App\Services\ProductCategoriesService;
use App\Services\ProductVendorsService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use function checkIfInput;
use function request;
use function response;

class ResourcesController extends Controller {

    /** Get a list of aditional resources like: categories, vendors, etc
     * Can be sent in GET/POST arguments, parameters like:
     * - object : category, categories-tree, vendors, characteristics
     * - category-id : For characteristics and characteristics-tree. Return characteristics for this category
     *
     * @return Response
     */
    public function index() {
        $data = [];

        if (checkIfInput(request()->input('object'), 'categories')) {
            $categoriesService = new ProductCategoriesService();
            $data['categories'] = $categoriesService->getAll();
        }

        if (checkIfInput(request()->input('object'), 'categories-tree')) {
            $categoriesService = new ProductCategoriesService();
            $data['categoriesTree'] = $categoriesService->getTree();
        }

        if (checkIfInput(request()->input('object'), 'vendors')) {
            $vendorsService = new ProductVendorsService();
            $data['vendors'] = $vendorsService->getAll();
        }

        if (checkIfInput(request()->input('object'), 'characteristics')) {
            $characteristicsService = new CategoryCharacteristicsService();
            $data['characteristics'] = $characteristicsService->getAll(request()->input('category-id'));
        }
        
        if(checkIfInput(request()->input('object'), 'characteristics-tree')){
            $characteristicsService=new CategoryCharacteristicsService();
            $data['characteristics-tree']=$characteristicsService->getTree(request()->input('category-id'));
        }

        return response()->json(['status' => 'ok', 'data' => $data]);
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
