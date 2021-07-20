<?php

namespace App\Services;

use App\Http\Requests\Api\CategoryRequest;
use App\Models\CategoryCharacteristic;
use App\Models\Product;
use App\Models\ProductCategory;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
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

    private ProductCategory $item;
    private array $productExcludeId = [];

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
     * @param bool  $recursive  Get products from subcategories
     * @param array $filters
     * @return LengthAwarePaginator
     */
    function getProducts(bool $recursive = true, array $filters = [], string $sortBy = null, string $sortOrder = null, int $limit = 12): LengthAwarePaginator {
        if (!$this->item)
            return (new LengthAwarePaginator([], 0, 1));

        $catArr = [$this->item->id];
        if ($recursive) {
            $subcat = $this->getTree(parentId: $this->item->id);
            foreach ($subcat as $cat)
                $catArr[] = $cat->id;
        }
        $productObj = Product::whereIn((new Product)->getTable() . '.product_category_id', $catArr);

        if ($filters)
            $productObj->filterBy($filters);

        if ($sortBy)
            $productObj->sortBy($sortBy, $sortOrder);

        if ($limit)
            $productObj->limit($limit);

        if ($this->productExcludeId)
            $productObj->whereNotIn('id', $this->productExcludeId);

//dd(toSqlBinds($productObj));
        return $productObj->paginate($limit);
    }

    /** Get characteristics having is_filter=1 for previous loaded item via find() which have products
     * 
     * @param array $filters
     */
    function getFiltersHavingProducts(array $filters = []): Collection {
        if (!$this->item)
            return (new Collection);

        $itemObj = CategoryCharacteristic::whereCategoryId($this->item->id)->whereIsFilter(1)->orderBy('order')->orderBy('name');

        if ($filters)
            $itemObj->filterBy($filters);

//        dd(toSqlBinds($itemObj));
        return $itemObj->get();
    }

    function find(int $id): ProductCategoriesService {
        $this->item = ProductCategory::with('category')->find($id);

        if (!$this->item)
            throw new \Exception('Category not found', 404);

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

    function setProductExcludeId($id) {
        if (is_array($id)) {
            foreach ($id as $idItem)
                if (is_integer($idItem))
                    $this->productExcludeId[] = $idItem;
        } elseif (is_numeric($id))
            $this->productExcludeId[] = $id;
        else
            throw new \Exception("Invalid exclude id");

        return $this;
    }

}
