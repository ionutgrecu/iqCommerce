<?php

/** @version 1.0.0
 * @author ionut
 * @copyright Copyright (C) 2021 Websea Development
 * @license Poprietary
 * @package 
 * @subpackage 
 */

namespace App\Services;

use App\Http\Requests\Api\VendorRequest;
use App\Models\ProductVendor;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Storage;
use function config;

/**
 * Description of ProductVendorsService
 *
 * @author ionut
 */
class ProductVendorsService {

    private $item;

    function deleteItem(int $id): bool {
        $item = ProductVendor::find($id);

        if ($item) {
            Storage::disk('public')->deleteDirectory("vendors/{$item->id}");
            $item->delete();
            return true;
        }

        return false;
    }

    function getAll(): Collection {
        $vendorObj = ProductVendor::select('*');

        return $vendorObj->orderBy('id', 'DESC')->get();
    }

    function find(int $id) {
        $this->item = ProductVendor::find($id);

        return $this->item;
    }

    function findOrNew(int $id = null): ProductVendor {
        if (!$id)
            $this->item = new ProductVendor;
        else
            $this->item = ProductVendor::findOrNew($id);

        return $this->item;
    }

    /**
     * @param VendorRequest $request
     * @return ProductVendor
     */
    function fillItemWithRequest(VendorRequest $request): ProductVendor {
        if (!$this->item)
            throw new Exception('Item not loaded');

        $this->item->fill($request->toArray());
        $this->item->save();

        if ($request->hasFile('image') && $request->file('image')->isValid() && in_array($request->file('image')->extension(), config('app.extensions.images'))) {
            $imageFile = Storage::disk('public')->url(Storage::disk('public')->putFile('vendors/' . $this->item->id, $request->file('image'), 'public'));

            if ($this->item->image && stripos($this->item->image, '://') === false)
                Storage::disk('public')->delete($this->item->image);

            $this->item->image = $imageFile;
            $this->item->save();
        }

        return $this->item;
    }

}
