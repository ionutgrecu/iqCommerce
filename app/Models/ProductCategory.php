<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Str;
use function route;

class ProductCategory extends Model {

    use HasFactory;

    protected $guarded = ['id', 'image', 'created_at', 'updated_at'];
    protected $appends = [
        'parents'
    ];

    protected static function boot(): void {
        parent::boot();

        self::saving(function($model) {
            if ('null' == $model->category_id)
                $model->category_id = null;
        });
    }

    public function category() {
        return $this->belongsTo(ProductCategory::class, 'category_id', 'id');
    }

    public function getUrl(): string {
        return route('shop.category', ['cat_slug' => Str::slug($this->name . '-' . $this->id)]);
    }

    public function getParentsAttribute() {
        $return = [];
        $categoryId = $this->category_id;

        while ($categoryId) {
            if ($parent = ProductCategory::find($categoryId)) {
                $return[] = $parent;
                $categoryId = $parent->category_id;
            } else
                $categoryId = null;
        }

        return array_reverse($return);
    }

    public function childs() {
        return $this->hasMany(ProductCategory::class, 'category_id', 'id')->orderBy('name');
    }

    public function filters() {
        return $this->hasMany(CategoryCharacteristic::class, 'category_id', 'id')->orderBy('name')->where('is_filter', 1);
    }
    
    public function scopeFilterBy($q,$filters){
        foreach($filters as $id=>$value)
            $q->where('id','!=','a');
    }

    public function getProductCount(): int {
        $result = 0;

        $result = Product::where('product_category_id', $this->id)->count();
        foreach ($this->childs as $child)
            $result += $child->getProductCount();

        return $result;
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
