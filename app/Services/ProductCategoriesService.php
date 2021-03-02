<?php

namespace App\Services;

use App\Models\ProductCategory;

/** @version 1.0.0
 * @author Ionut Grecu
 * @copyright Copyright (C) 2021
 * @license Poprietary
 * @package 
 * @subpackage 
 */

/**
 * Description of CategoriesService
 *
 * @author ionut
 */
class ProductCategoriesService {

    function getAll() {
        return ProductCategory::all();
    }

    function findOrNew(int $id = null) {
        if (!$id)
            return new ProductCategory;
        else
            return ProductCategory::findOrNew($id);
    }

}
