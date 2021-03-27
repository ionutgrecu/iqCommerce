<?php

namespace App\Http\Controllers;

use App\Services\ProductCategoriesService;
use Exception;
use function abort;
use function slugToId;

class ShopController extends Controller {

    function category($slug, ProductCategoriesService $categoryService) {
        $catId = slugToId($slug);

        try {
            $this->data['category'] = $categoryService->find($catId);
        } catch (Exception $ex) {
            abort(404);
        }

        return "category $catId";
    }

    function product($slug) {
        $prodId = slugToId($slug);
        return "product $prodId";
    }

}
