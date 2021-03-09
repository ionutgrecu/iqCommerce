<?php

/** @version 1.0.0
 * @author Ionut Grecu
 * @copyright Copyright (C) 2021
 * @license Poprietary
 * @package 
 * @subpackage 
 */

namespace App\Services;

use App\Http\Requests\Api\CharacteristicRequest;
use App\Models\CategoryCharacteristic;
use Arr;
use Illuminate\Database\Eloquent\Collection;
use TheSeer\Tokenizer\Exception;

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

    function find(int $id): CategoryCharacteristic {
        $this->item = CategoryCharacteristic::with('category')->find($id);

        return $this->item;
    }

    function findOrNew(int $id = null): CategoryCharacteristic {
        if (!$id)
            $this->item = new CategoryCharacteristic;
        else
            $this->item = CategoryCharacteristic::findOrNew($id);

        return $this->item;
    }

    function fillItemWithRequest(CharacteristicRequest $request): CategoryCharacteristic {
        if (!$this->item)
            throw new Exception('Item not loaded');

        $this->item->fill($request->toArray());

        if(!$this->item->order===null)$this->item->order=0;
        $this->item->is_filter=(!$request['is_filter'] || $request['is_filter']=='false')?0:1;
                
        $this->item->save();

        return $this->item;
    }

    function getUniqueValues(string $value, int $categoryId = null) {
        $itemObj = CategoryCharacteristic::select($value)->whereNotNull($value)->groupBy($value);

        if ($categoryId)
            $itemObj->whereCategoryId($categoryId);

        $values = Arr::pluck($itemObj->get(), $value);

        return $values;
    }

    function getTypeValues() {
        return CategoryCharacteristic::getPossibleEnumValues('type');
    }

}
