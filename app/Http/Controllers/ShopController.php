<?php

namespace App\Http\Controllers;

use App\Services\BreadcrumbsService;
use App\Services\ProductCategoriesService;
use App\Services\ProductsService;
use Exception;
use function abort;
use function slugToId;
use function view;

class ShopController extends Controller {

    function category($slug, ProductCategoriesService $service, BreadcrumbsService $breadcrumbService, \Illuminate\Http\Request $request) {
        $catId = slugToId($slug);
        $this->params['categorySlug'] = $slug;
        $this->params['filterRequest'] = $request->input('filter') ?? [];

        try {
            $category = $service->find($catId)->getItem();
            $this->params['category'] = $category;
        } catch (Exception $ex) {
            abort(404);
        }

        $this->params['products'] = $service->getProducts($this->params['filterRequest']);
        dd($this->params['products']);

        foreach ($category->parents as $parent)
            $breadcrumbService->addBreadcrumb($parent->name, $parent->name, $parent->getUrl());
        $breadcrumbService->addBreadcrumb($category->name, $category->name, $category->getUrl());

        return view('shop.category', $this->params);
    }

    function product($catSlug, $prodSlud, ProductsService $service) {
        $prodId = slugToId($prodSlud);
        return "product $prodId";
    }

}
