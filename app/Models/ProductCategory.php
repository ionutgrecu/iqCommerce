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
    
    public function category(){
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function childs() {
        return $this->hasMany(ProductCategory::class, 'category_id', 'id')->orderBy('name');
    }

    function loadMissingRecursive(int $exceptId = null, ...$relations) {
        if ($exceptId)
            foreach ($relations as $relation)
                $this->loadMissing([$relation => function($q)use($exceptId) {
                        $q->where('id', '!=', $exceptId);
                    }]);
        else
            $this->loadMissing($relations);

        foreach ($relations as $relation)
            foreach ($this->$relation as $child)
                $child->loadMissingRecursive($exceptId, $relation);
    }

}
