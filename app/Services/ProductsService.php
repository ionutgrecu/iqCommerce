<?php

namespace App\Services;

use App\Http\Requests\Api\ProductRequest;
use App\Models\Product;
use App\Models\ProductCharacteristics;
use TheSeer\Tokenizer\Exception;
use function GuzzleHttp\json_decode;

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

        foreach ($request['characteristics'] as $key => $jsonValues) {
            $values = json_decode($jsonValues, true);

            $productCharacteristic = ProductCharacteristics::firstOrNew([
                        'product_id' => $this->item->id,
                        'category_characteristic_id' => $key
            ]);
            
            $productCharacteristic->product_id = $this->item->id;
            $productCharacteristic->category_characteristic_id = $key;
            $productCharacteristic->fill($values);
            $productCharacteristic->save();
        }

        return $this->item;
    }

}
