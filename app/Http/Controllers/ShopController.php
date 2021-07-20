<?php

namespace App\Http\Controllers;

use App\Services\BreadcrumbsService;
use App\Services\ProductCategoriesService;
use App\Services\ProductsService;
use Exception;
use Illuminate\Http\Request;
use function abort;
use function slugToId;
use function view;

class ShopController extends Controller {

    function category($slug, ProductCategoriesService $service, BreadcrumbsService $breadcrumbService, Request $request) {
        $catId = slugToId($slug);
        $this->params['categorySlug'] = $slug;
        $this->params['filterRequest'] = $request->input('filter') ?? [];
        $this->params['sortbyRequest'] = $request->input('sort_by') ?? 'recommends';
        $this->params['sortRequest'] = $request->input('sort') ?? 'DESC';

        try {
            $category = $service->find($catId)->getItem();
            $this->params['category'] = $category;
        } catch (Exception $ex) {
            abort($ex->getCode(), $ex->getMessage());
        }

        $this->categoryToBreadcrumb($category, $breadcrumbService);

        $this->params['products'] = $service->getProducts(filters: $this->params['filterRequest'], sortBy: $this->params['sortbyRequest'], sortOrder: $this->params['sortRequest']);

        return view('shop.category', $this->params);
    }

    function product($catSlug, $prodSlud, ProductCategoriesService $categoryService, ProductsService $service, BreadcrumbsService $breadcrumbService, Request $request) {
        $catId = slugToId($catSlug);
        $prodId = slugToId($prodSlud);

        try {
            $category = $categoryService->find($catId)->getItem();
            $this->params['category'] = $category;
        } catch (Exception $ex) {
            abort($ex->getCode(), $ex->getMessage());
        }

        try {
            $product = $service->find($prodId)->getItem();
            $this->params['product'] = $product;
        } catch (Exception $ex) {
            abort($ex->getCode(), $ex->getMessage());
        }

        try {
            $this->params['related'] = $categoryService->getProducts();
        } catch (Exception $ex) {
            \Log::error(__FILE__ . '@' . __LINE__ . ': ' . $ex->getMessage());
        }

        $this->categoryToBreadcrumb($category, $breadcrumbService);
        $breadcrumbService->addBreadcrumb($product->name, $product->name, $product->getUrl());

        return view('shop.product', $this->params);
    }

    private function categoryToBreadcrumb(\App\Models\ProductCategory $category, BreadcrumbsService $breadcrumbService) {
        foreach ($category->parents as $parent)
            $breadcrumbService->addBreadcrumb($parent->name, $parent->name, $parent->getUrl());
        $breadcrumbService->addBreadcrumb($category->name, $category->name, $category->getUrl());
    }

}
