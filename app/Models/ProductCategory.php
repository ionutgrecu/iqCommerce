<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model {

    use HasFactory;

    protected $guarded = ['id', 'image', 'created_at', 'updated_at'];

    protected static function boot(): void {
        parent::boot();

        self::saving(function($model) {
            if ($model->category_id == 'null')
                $model->category_id = null;
        });
    }

}
