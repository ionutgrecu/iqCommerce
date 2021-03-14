<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model {

    use HasFactory,
        SoftDeletes;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $appends = ['images'];

    function getImagesAttribute() {
        return ProductImages::whereProductId($this->id)->get()->all();
    }

    public function vendor() {
        return $this->belongsTo(ProductVendor::class, 'product_vendors_id', 'id');
    }

    public function images() {
        return $this->hasMany(ProductImages::class, 'product_id', 'id')->orderBy('order', 'ASC');
    }

}
