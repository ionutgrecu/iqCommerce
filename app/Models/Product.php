<?php

namespace App\Models;

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
        return route('shop.product', ['cat_id' => $this->category->id, 'cat_slug' => Str::slug($this->category->name), 'prod_id' => $this->id, 'prod_slug' => Str::slug($this->name)]);
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

}
