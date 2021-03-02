<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CategoryRequest;
use App\Services\ProductCategoriesService;
use Illuminate\Http\Request;
use Log;
use Storage;

class CategoriesController extends Controller {

    private $service;

    function __construct() {
        parent::__construct();

        $this->service = new ProductCategoriesService;
    }

    /**
     * Return categories
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response()->json(['status' => 'ok', 'data' => $this->service->getAll()]);
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
    public function store(CategoryRequest $request) {
//        Log::info($request->toArray());
        $path = '';

        $category = $this->service->findOrNew((integer)$request['id']);
        $category->fill($request->toArray());
        $category->save();

        if (request()->hasFile('image') && request()->file('image')->isValid() && in_array(request()->file('image')->extension(), config('app.extensions.images'))) {
            $imageFile = \Storage::disk('public')->url(Storage::disk('public')->putFile('categories/'.$category->id, $request->file('image'), 'public'));               
            
            if($category->image && stripos($category->image, '://')===false && \Illuminate\Support\Facades\Storage::disk('public')->exists($category->image)){
                \Storage::disk('public')->delete($category->image);
            }
            
            $category->image=$imageFile;
            $category->save();
        }
        return response()->json(['status' => 'ok', 'item' => $category]);
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
