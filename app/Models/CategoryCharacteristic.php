<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Str;

class CategoryCharacteristic extends Model {

    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function boot(): void {
        parent::boot();

        self::saving(function($model) {
            if (!$model->slug)
                $model->slug = Str::limit(Str::slug($model->name), 64);
        });
    }

    function category() {
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');
    }

    function scopeWithValues($q, $productId) {
        $categoryCharacteristicTable = (new CategoryCharacteristic)->getTable();
        $productCharacteristicsTable = (new ProductCharacteristics)->getTable();

        $q->select("$categoryCharacteristicTable.*", "$productCharacteristicsTable.val_boolean", "$productCharacteristicsTable.val_numeric", "$productCharacteristicsTable.val_short_text", "$productCharacteristicsTable.val_text")->leftJoin($productCharacteristicsTable, function($join) use ($categoryCharacteristicTable, $productCharacteristicsTable, $productId) {
            $join->on("$categoryCharacteristicTable.id", '=', "$productCharacteristicsTable.category_characteristic_id")
                    ->where("$productCharacteristicsTable.product_id", '=', $productId);
        });
    }

    public function getSuggestedValuesAttribute() {
        $result = [];

        if ('text' == $this->type)
            return [];

        $productCharacteristicsobj = ProductCharacteristics::where('category_characteristic_id', $this->id);

        if ('boolean' == $this->type)
            $productCharacteristicsobj->raw('GROUP BY val_boolean HAVING val_boolean != NULL');
        elseif ('numeric' == $this->type)
            $productCharacteristicsobj->raw('GROUP BY val_numeric HAVING val_numeric != NULL');
        elseif ('short_text' == $this->type)
            $productCharacteristicsobj->raw('GROUP BY val_short_text HAVING val_short_text != NULL');

        foreach ($productCharacteristicsobj->cursor() as $item) {
            if ('boolean' == $this->type)
                $result[] = $item->val_boolean ? 1 : 0;
            elseif ('numeric' == $this->type)
                $result[] = $item->val_numeric;
            elseif ('short_text' == $this->type)
                $result[] = $item->val_short_text;
        }

        return $result;
    }

}
