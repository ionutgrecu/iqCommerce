<?php

namespace App\Services;

use App\Http\Requests\Api\ProductRequest;
use App\Models\Product;

/** @version 1.0.0
 * @author Ionut Grecu
 * @copyright Copyright (C) 2021
 * @license Poprietary
 * @package 
 * @subpackage 
 */
class ProductsService {

    private $item;

    function findOrNew(int $id = null): Product {
        if (!$id)
            $this->item = new Product;
        else
            $this->item = Product::findOrNew($id);

        return $this->item;
    }

    /**
     * 
     * @param ProductRequest $request
     * @return Product
     */
    function fillItemWithRequest(ProductRequest $request): Product {
        if (!$this->item)
            throw new Exception('Item not loaded');
        
        $this->item->fill($request->toArray());
        $this->item->save();
        
        return $this->item;
    }

}
