<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Query\JoinClause;
use Str;
use function dd;

class CategoryCharacteristic extends Model {

    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public const TYPE_BOOLEAN = 'boolean', TYPE_NUMERIC = 'numeric', TYPE_SHORT_TEXT = 'short_text', TYPE_TEXT = 'text';

    protected static function boot(): void {
        parent::boot();

        self::saving(function ($model) {
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

        $q->select("$categoryCharacteristicTable.*", "$productCharacteristicsTable.val_boolean", "$productCharacteristicsTable.val_numeric", "$productCharacteristicsTable.val_short_text", "$productCharacteristicsTable.val_text")->leftJoin($productCharacteristicsTable, function ($join) use ($categoryCharacteristicTable, $productCharacteristicsTable, $productId) {
            $join->on("$categoryCharacteristicTable.id", '=', "$productCharacteristicsTable.category_characteristic_id")
                    ->where("$productCharacteristicsTable.product_id", '=', $productId);
        });
    }

    function getSuggestedValues(array $filters = []) {
        if (self::TYPE_TEXT == $this->type)
            return [];

        $result = [];

        $productCharacteristicsobj = ProductCharacteristics::where('category_characteristic_id', $this->id);

        if (self::TYPE_BOOLEAN == $this->type) {
            $valColumn = 'val_boolean';
            $productCharacteristicsobj->select($valColumn, DB::raw('COUNT(id) AS product_count'))->whereNotNull($valColumn)->groupBy($valColumn);
        } elseif (self::TYPE_NUMERIC == $this->type) {
            $valColumn = 'val_numeric';
            $productCharacteristicsobj->select($valColumn, DB::raw('COUNT(id) AS product_count'))->whereNotNull($valColumn)->groupBy($valColumn);
        } elseif (self::TYPE_SHORT_TEXT == $this->type) {
            $valColumn = 'val_short_text';
            $productCharacteristicsobj->select($valColumn, DB::raw('COUNT(id) AS product_count'))->whereNotNull($valColumn)->where($valColumn, '!=', '')->groupBy($valColumn);
        }

        if ($filters){
            $productCharacteristicsTable=(new ProductCharacteristics)->getTable();
            
            foreach ($filters as $id => $value) {
                $tableName = "characteristic_{$id}_" . \Str::random(3);
                $productCharacteristicsobj->whereRaw("(SELECT COUNT(`id`) FROM `$productCharacteristicsTable` AS `$tableName` WHERE `$tableName`.`category_characteristic_id`=? AND `$tableName`.`product_id`=`$productCharacteristicsTable`.`product_id` AND `$valColumn`=?)>0",[$id,$value]);
            }
        }

//        dd(toSqlBinds($productCharacteristicsobj));
        foreach ($productCharacteristicsobj->cursor() as $item) {
            if (self::TYPE_BOOLEAN == $this->type)
                $result[] = ['value' => $item->val_boolean ? 1 : 0, 'product_count' => $item->product_count];
            else
                $result[] = ['value' => $item->$valColumn, 'product_count' => $item->product_count];
        }

        return $result;
    }

    public function getSuggestedValuesAttribute() {
        if (self::TYPE_TEXT == $this->type)
            return [];

        $result = [];

        $productCharacteristicsobj = ProductCharacteristics::where('category_characteristic_id', $this->id);

        if (self::TYPE_BOOLEAN == $this->type)
            $productCharacteristicsobj->select('val_boolean', DB::raw('COUNT(id) AS product_count'))->whereNotNull('val_boolean')->groupBy('val_boolean');
        elseif (self::TYPE_NUMERIC == $this->type)
            $productCharacteristicsobj->select('val_numeric', DB::raw('COUNT(id) AS product_count'))->whereNotNull('val_numeric')->groupBy('val_numeric');
        elseif (self::TYPE_SHORT_TEXT == $this->type)
            $productCharacteristicsobj->select('val_short_text', DB::raw('COUNT(id) AS product_count'))->whereNotNull('val_short_text')->where('val_short_text', '!=', '')->groupBy('val_short_text');

//dd(toSqlBinds($productCharacteristicsobj));
        foreach ($productCharacteristicsobj->cursor() as $item) {
            if (self::TYPE_BOOLEAN == $this->type)
                $result[] = ['value' => $item->val_boolean ? 1 : 0, 'product_count' => $item->product_count];
            elseif (self::TYPE_NUMERIC == $this->type)
                $result[] = ['value' => $item->val_numeric, 'product_count' => $item->product_count];
            elseif (self::TYPE_SHORT_TEXT == $this->type)
                $result[] = ['value' => $item->val_short_text, 'product_count' => $item->product_count];
        }

        return $result;
    }

    public function getValAttributeName(): string {
        switch ($this->type) {
            case self::TYPE_BOOLEAN:
                return ProductCharacteristics::COLUMN_BOOLEAN;
                break;

            case self::TYPE_NUMERIC:
                return ProductCharacteristics::COLUMN_NUMERIC;
                break;

            case self::TYPE_SHORT_TEXT:
                return ProductCharacteristics::COLUMN_SHORT_TEXT;
                break;

            case self::TYPE_TEXT:
                return ProductCharacteristics::COLUMN_TEXT;
                break;
        }

        return ProductCharacteristics::COLUMN_SHORT_TEXT;
    }

    function scopeFilterBy(Builder $q, array $filters = []) {
        $tableProductsName = (new Product)->getTable();
        $tableProductCharacteristicsName = (new ProductCharacteristics)->getTable();

        foreach ($filters as $id => $value) {
            $categoryCharacteristic = CategoryCharacteristic::find($id);
            if (!$categoryCharacteristic || !$categoryCharacteristic->is_filter)
                continue;

            $tableName = "characteristic_{$id}_" . \Str::random(3);

            $q->join("$tableProductCharacteristicsName AS $tableName", function (JoinClause $join) use ($tableName, $tableProductsName, $tableProductCharacteristicsName, $id) {
                $join->on("{$this->getTable()}.id", "$tableName.category_characteristic_id")->whereRaw("(SELECT COUNT(id) FROM $tableProductCharacteristicsName)>0");
            })->groupBy("{$this->getTable()}.id")->select("{$this->getTable()}.*");
        }
    }

}
