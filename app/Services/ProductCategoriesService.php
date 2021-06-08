<?php

namespace App\Services;

use App\Http\Requests\Api\CategoryRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Storage as Storage2;
use function config;
use function dd;
use function toSqlBinds;

/** @version 1.0.0
 * @author Ionut Grecu
 * @copyright Copyright (C) 2021
 * @license Poprietary
 * @package 
 * @subpackage 
 */
class ProductCategoriesService {

    private ProductCategory $item;

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

    /** Get all products of most recent find() item, or category_id=0 items
     * 
     * @return LengthAwarePaginator
     */
    function getItems(): Collection {
        $productCategoryObj = ProductCategory::select('*');

        if ($this->item)
            $productCategoryObj->where('category_id', $this->item->id);
        else
            $productCategoryObj->where(function ($q) {
                $q->where('category_id', 0)->orWhereNull('category_id');
            });

        return $productCategoryObj->get();
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

    function getItem(): ProductCategory {
        return $this->item;
    }

    /** Get products for previous loaded item via find()
     * 
     * @param array $filters
     * @return LengthAwarePaginator
     */
    function getProducts(array $filters = []): LengthAwarePaginator {
        if (!$this->item)
            return (new LengthAwarePaginator([], 0, 1));

        $productObj = Product::where('category_id', $this->item->id);

        if ($filters)
            $productObj->filterBy($filters);
        dd(toSqlBinds($productObj));
    }

    function find(int $id): ProductCategoriesService {
        $this->item = ProductCategory::with('category')->find($id);

        if (!$this->item)
            throw new \Exception('Item not found');

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
