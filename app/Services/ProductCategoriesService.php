<?php

namespace App\Services;

use App\Http\Requests\Api\CategoryRequest;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Storage as Storage2;
use function config;

/** @version 1.0.0
 * @author Ionut Grecu
 * @copyright Copyright (C) 2021
 * @license Poprietary
 * @package 
 * @subpackage 
 */
class ProductCategoriesService {

    private $item;

    function deleteItem(int $id): bool {
        $item = ProductCategory::find($id);

        if (!$item)
            return false;

        Storage2::disk('public')->deleteDirectory("categories/{$item->id}");
        $item->delete();
        return true;
    }

    function getAll(int $exceptId = null): Collection {
        $productCategoryObj = ProductCategory::select('*')->with('childs');

        if ($exceptId)
            $productCategoryObj->where('id', '!=', $exceptId);

        return $productCategoryObj->orderBy('id', 'DESC')->get();
    }

    function getTree(int $exceptId = null, int $parentId = null): array {
        $return = [];

        $productCategoryObj = ProductCategory::whereCategoryId($parentId);
        if ($exceptId)
            $productCategoryObj->where('id', '!=', $exceptId);

        foreach ($productCategoryObj->orderBy('name', 'DESC')->cursor() as $item) {
            $item->loadMissingRecursive($exceptId, 'childs');

            $return[] = $item;

//            $subCategories=$this->getTree($exceptId,$item->id);
//            
//              if($subCategories)      
//            $return= array_merge($return, $subCategories);
        }

        return $return;
    }
    
    function getItem():ProductCategory{
        return $this->item;
    }

    function find(int $id): ProductCategoriesService {
        $this->item = ProductCategory::with('category')->find($id);

        return $this;
    }

    function findOrNew(int $id = null): ProductCategory {
        if (!$id)
            $this->item = new ProductCategory;
        else
            $this->item = ProductCategory::findOrNew($id);

        return $this->item;
    }

    /**
     * @param CategoryRequest $request
     * @return ProductCategory
     */
    function fillItemWithRequest(CategoryRequest $request): ProductCategory {
        if (!$this->item)
            throw new Exception('Item not loaded');

        $this->item->fill($request->toArray());
        $this->item->save();

        if ($request->hasFile('image') && $request->file('image')->isValid() && in_array($request->file('image')->extension(), config('app.extensions.images'))) {
            $imageFile = Storage2::disk('public')->url(Storage2::disk('public')->putFile('categories/' . $this->item->id, $request->file('image'), 'public'));

            if ($this->item->image && stripos($this->item->image, '://') === false)
                Storage2::disk('public')->delete($this->item->image);

            $this->item->image = $imageFile;
            $this->item->save();
        }

        return $this->item;
    }

}
