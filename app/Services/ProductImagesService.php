<?php

namespace App\Services;

use App\Models\ProductImages;
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

    function find(int $id): ProductImages {
        $this->item = ProductImages::find($id);

        return $this->item;
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
