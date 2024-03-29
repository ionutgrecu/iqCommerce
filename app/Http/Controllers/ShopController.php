<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddToCartRequest;
use App\Http\Requests\CartCheckoutRequest;
use App\Models\ProductCategory;
use App\Services\BreadcrumbsService;
use App\Services\CartService;
use App\Services\ProductCategoriesService;
use App\Services\ProductsService;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Log;
use function abort;
use function redirect;
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
            $this->params['related'] = $categoryService->setProductExcludeId($prodId)->getProducts(limit: 4);
        } catch (Exception $ex) {
            Log::error(__FILE__ . '@' . __LINE__ . ': ' . $ex->getMessage());
        }

        $this->categoryToBreadcrumb($category, $breadcrumbService);
        $breadcrumbService->addBreadcrumb($product->name, $product->name, $product->getUrl());

        return view('shop.product', $this->params);
    }

    function addToCart($catSlug, $prodSlud, AddToCartRequest $request, ProductsService $productService, CartService $cartService) {
        try {
            $product = $productService->find($request->input('product_id'))->getItem();
        } catch (Exception $ex) {
            abort($ex->getCode(), $ex->getMessage());
        }

        $cartService->addToCart($product, $request->input('qty'));

        return redirect($request->url())->with('message', "Produsul &quot;{$product->name}&quot; a fost adaugat in cos.");
    }

    function removeFromCart($cartItemId, CartService $cartService) {
        $cartService->removeFromCart((int) $cartItemId);

        return redirect()->back();
    }

    function cartCheckout(Request $request, CartService $cartService) {
        return view('shop.checkout');
    }

    function postCartCheckout(CartCheckoutRequest $request, CartService $cartService) {
        if ($request->input('store_account')) {
            $user = Auth::user();
            $user->fill([
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'delivery_address' => $request->input('delivery_address'),
            ]);
            $user->save();
        }

        $cartService->order($request);

        return view('shop.checkout_done');
    }

    private function categoryToBreadcrumb(ProductCategory $category, BreadcrumbsService $breadcrumbService) {
        foreach ($category->parents as $parent)
            $breadcrumbService->addBreadcrumb($parent->name, $parent->name, $parent->getUrl());
        $breadcrumbService->addBreadcrumb($category->name, $category->name, $category->getUrl());
    }

}
