<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model {

    const STATUS_NEW = 'new';
    const STATUS_FINISHED = 'finished';

    use HasFactory;

    protected $guarded = ['id'];

    function items() {
        return $this->hasMany(CartItem::class);
    }
    
    function scopeStatusnew($q){
        $q->where('status',self::STATUS_NEW);
    }

}
