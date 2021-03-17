<?php

namespace App\Services;

use App\Models\ProductImages;
use Exception;
use Storage;

/** @version 1.0.0
 * @author Ionut Grecu
 * @copyright Copyright (C) 2021
 * @license Poprietary
 * @package 
 * @subpackage 
 */
class ProductImagesService {

    private $item;

    function getItem(): ProductImages {
        return $this->item;
    }

    function find(int $id): ProductImagesService {
        if ($this->item = ProductImages::find($id))
            return $this;

        throw new Exception('Product not found');
    }

    function makeDefault(): bool {
        if (!$this->item)
            throw new Exception('Item not loaded');

        if (1 == $this->item->default)
            return false;

        ProductImages::whereProductId($this->item->product_id)->update(['default' => 0]);

        $this->item->default = 1;
        $this->item->save();

        return true;
    }

    function delete(int $id): bool {
        if (!$this->find($id))
            return false;

        if (stripos($this->item->file, '://') === null)
            Storage::disk('public')->delete($this->item->file);

        $this->item->delete();

        return true;
    }

}
