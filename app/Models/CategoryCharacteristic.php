<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryCharacteristic extends Model {

    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    function category() {
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');
    }

    function scopeWithValues($q, $productId) {
        $categoryCharacteristicTable = (new CategoryCharacteristic)->getTable();
        $productCharacteristicsTable = (new ProductCharacteristics)->getTable();

        $q->select("$categoryCharacteristicTable.*","$productCharacteristicsTable.val_short_text AS value")->leftJoin($productCharacteristicsTable, function($join) use ($categoryCharacteristicTable,$productCharacteristicsTable, $productId) {
            $join->on("$categoryCharacteristicTable.id", '=', "$productCharacteristicsTable.category_characteristic_id")
                    ->where("$productCharacteristicsTable.product_id", '=', $productId);
        });
    }

}
