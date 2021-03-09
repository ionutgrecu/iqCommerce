<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class CategoryCharacteristic extends Model {

    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    function category() {
        return $this->hasOne(ProductCategory::class, 'id', 'category_id');
    }

}
