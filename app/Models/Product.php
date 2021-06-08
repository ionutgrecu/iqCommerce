<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;
use function asset;
use function public_path;
use function route;

class Product extends Model {

    use HasFactory,
        SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $appends = ['image'];

    function getImageAttribute() {
        return ProductImages::whereProductId($this->id)->orderBy('default', 'DESC')->first();
    }

    public function vendor() {
        return $this->belongsTo(ProductVendor::class, 'product_vendors_id', 'id');
    }

    public function category() {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function images() {
        return $this->hasMany(ProductImages::class, 'product_id', 'id')->orderBy('order', 'ASC');
    }

    public function getUrl(): string {
        return route('shop.product', ['cat_slug' => Str::slug($this->category->name . '-' . $this->category->id), 'prod_slug' => Str::slug($this->name . '-' . $this->id)]);
    }

    public function getImageUrl(): string {
        if (!$this->image)
            return asset('assets/no-image.jpg');

        if (stripos($this->image->file, ':/') !== false)
            return $this->image->file;

        if (!is_file(public_path($this->image->file)))
            return asset('assets/no-image.jpg');

        return asset($this->image->file);
    }

    public function isDiscountEligible(): bool {
        if ($this->price_min > 0 && $this->price_min < $this->price)
            return true;

        return false;
    }

    public function proposePrice(): float {
        //TODO: Custom price proposal
        if (!$this->price_min > 0 || $this->price_min >= $this->price)
            return $this->price;

        return max($this->price * 0.98, $this->min_price);
    }

    public function scopeFilterBy(Builder $q, $filters) {
        foreach ($filters as $id => $value) {
            $categoryCharacteristic = CategoryCharacteristic::find($id);
            if (!$categoryCharacteristic || !$categoryCharacteristic->is_filter)
                continue;

            $tableName = "characteristic_{$id}_" . \Str::random(3);

            $q->join((new ProductCharacteristics)->getTable() . " AS $tableName", function ($join) use ($tableName, $id) {
                        $join->on("{$this->getTable()}.id", "$tableName.product_id")->where("$tableName.category_characteristic_id", $id);
                    })
                    ->where("$tableName.{$categoryCharacteristic->getValAttributeName()}", $value);
        }
    }

}
