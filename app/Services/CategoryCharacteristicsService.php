<?php

/** @version 1.0.0
 * @author Ionut Grecu
 * @copyright Copyright (C) 2021
 * @license Poprietary
 * @package 
 * @subpackage 
 */

namespace App\Services;

use App\Models\CategoryCharacteristic;
use Illuminate\Database\Eloquent\Collection;

/**
 * Description of CharacteristicsService
 *
 * @author ionut
 */
class CategoryCharacteristicsService {

    private $item;

    function getAll(): Collection {
        $characteristicsObj = CategoryCharacteristic::select('*')->with('category');

        return $characteristicsObj->orderBy('category_id', 'ASC')->orderBy('group', 'ASC')->orderBy('order', 'ASC')->get();
    }

    function find(int $id) {
        $this->item = CategoryCharacteristic::with('category')->find($id);

        return $this->item;
    }

}
