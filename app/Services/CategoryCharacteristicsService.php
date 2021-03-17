<?php

namespace App\Services;

use App\Http\Requests\Api\CharacteristicRequest;
use App\Models\CategoryCharacteristic;
use Arr;
use TheSeer\Tokenizer\Exception;

/** @version 1.0.0
 * @author Ionut Grecu
 * @copyright Copyright (C) 2021
 * @license Poprietary
 * @package 
 * @subpackage 
 */
class CategoryCharacteristicsService {

    private $item;

    function deleteItem(int $id): bool {
        $item = CategoryCharacteristic::find($id);

        if ($item) {
            $item->delete();
            return true;
        }

        return false;
    }

    function getAll(int $categoryId = null) {
        $characteristicsObj = CategoryCharacteristic::select('*')->with('category');

        if ($categoryId)
            $characteristicsObj->whereCategoryId($categoryId);

        return $characteristicsObj->orderBy('category_id', 'ASC')->orderBy('group', 'ASC')->orderBy('order', 'ASC')->get();
    }

    function getTree(int $categoryId = null, int $productId = null) {
        $return = [];

        $characteristicsObj = CategoryCharacteristic::select('*');

        if (null !== $categoryId)
            $characteristicsObj->whereCategoryId($categoryId);

        if (null !== $productId)
            $characteristicsObj->withValues($productId);

        foreach ($characteristicsObj->cursor() as $item)
            $return[$item->group ?? 'others'][] = $item;

        return $return;
    }

    function getItem():CategoryCharacteristic{
        return $this->item;
    }
    
    function find(int $id): CategoryCharacteristicsService  {
        $this->item = CategoryCharacteristic::with('category')->find($id);

        return $this;
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

        if (!$this->item->order === null)
            $this->item->order = 0;
        $this->item->is_filter = (!$request['is_filter'] || $request['is_filter'] == 'false') ? 0 : 1;

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
