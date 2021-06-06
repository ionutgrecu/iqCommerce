<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCharacteristics extends Model {

    use HasFactory;

    protected $fillable = ['val_boolean', 'val_numeric', 'val_short_text', 'val_text'];

    public function fill(array $attributes) {
        $attributes['val_boolean'] = $attributes['val_boolean'] ?? 0;
        $attributes['val_numeric'] = $attributes['val_numeric'] ?? 0;
        $attributes['val_short_text'] = $attributes['val_short_text'] ?? '';
        $attributes['val_text'] = $attributes['val_text'] ?? '';

        parent::fill($attributes);
    }

}
