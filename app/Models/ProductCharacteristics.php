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

    function category_characteristic() {
        return $this->belongsTo(CategoryCharacteristic::class, 'category_characteristic_id', 'id');
    }

    function getValue() {
        switch ($this->category_characteristic->type) {
            case CategoryCharacteristic::TYPE_BOOLEAN:
                return $this->{self::COLUMN_BOOLEAN};
                break;
            case CategoryCharacteristic::TYPE_NUMERIC:
                return $this->{self::COLUMN_NUMERIC};
                break;
            case CategoryCharacteristic::TYPE_SHORT_TEXT:
                return $this->{self::COLUMN_SHORT_TEXT};
                break;
            case CategoryCharacteristic::TYPE_TEXT:
                return $this->{self::COLUMN_TEXT};
                break;
        }
    }

}
