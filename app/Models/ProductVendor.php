<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVendor extends Model {

    use HasFactory;

    protected $guarded = ['id', 'image', 'created_at', 'update_at'];
    protected $appends = [
        'product_count',
    ];

    function getProductCountAttribute() {
        return $this->hasMany(Product::class, 'product_vendors_id', 'id')->count();
    }

}
