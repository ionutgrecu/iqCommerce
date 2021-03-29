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

    function category($slug, ProductCategoriesService $service, BreadcrumbsService $breadcrumbService) {
        $catId = slugToId($slug);

        try {
            $category = $service->find($catId)->getItem();
            $this->params['category'] = $category;
        } catch (Exception $ex) {
            abort(404);
        }

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
