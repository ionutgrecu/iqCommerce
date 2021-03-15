<?php

namespace App\Services;

use App\Http\Requests\Api\ProductRequest;
use App\Models\Product;
use App\Models\ProductCharacteristics;
use App\Models\ProductImages;
use Storage;
use TheSeer\Tokenizer\Exception;
use function config;
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

    function deleteItem(int $id): bool {
        $item = Product::find($id);

        if (!$item)
            return false;

        Storage::disk('public')->deleteDirectory("products/{$item->id}");
        $item->delete();
        return true;
    }

    function getAll() {
        $productsObj = Product::with('vendor', 'images');

        return $productsObj->get();
    }

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

        if (is_array($request['image']))
            foreach ($request['image'] as $key => $image) {
                if (!$request->hasFile("image.$key") || !$request->file("image.$key")->isValid() || !in_array($request->file("image.$key")->extension(), config('app.extensions.images')))
                    continue;

                $imageFile = Storage::disk('public')->url(Storage::disk('public')->putFile('products/' . $this->item->id, $request->file("image.$key"), 'public'));

                $image = new ProductImages();
                $image->fill([
                    'product_id' => $this->item->id,
                    'file' => $imageFile,
                ]);
                $image->save();
            }

        return $this->item;
    }

}