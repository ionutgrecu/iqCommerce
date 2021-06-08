<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCharacteristics extends Model {

    use HasFactory;

    protected $fillable = ['val_boolean', 'val_numeric', 'val_short_text', 'val_text'];

    public const COLUMN_BOOLEAN = 'val_boolean', COLUMN_NUMERIC = 'val_numeric', COLUMN_SHORT_TEXT = 'val_short_text', COLUMN_TEXT = 'val_text';

    public function fill(array $attributes) {
        $attributes[self::COLUMN_BOOLEAN] = $attributes[self::COLUMN_BOOLEAN] ?? 0;
        $attributes[self::COLUMN_NUMERIC] = $attributes[self::COLUMN_NUMERIC] ?? 0;
        $attributes[self::COLUMN_SHORT_TEXT] = $attributes[self::COLUMN_SHORT_TEXT] ?? '';
        $attributes[self::COLUMN_TEXT] = $attributes[self::COLUMN_TEXT] ?? '';

        parent::fill($attributes);
    }

}
