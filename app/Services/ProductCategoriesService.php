<?php

namespace App\Services;

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
    function getAll(){
        return \App\Models\ProductCategory::all();
    }
}
