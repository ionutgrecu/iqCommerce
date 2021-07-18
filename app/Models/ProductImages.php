<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use function asset;
use function public_path;

class ProductImages extends Model {

    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function getUrl(): string {
        if (stripos($this->file, ':/') !== false)
            return $this->file;

        if (!is_file(public_path($this->file)))
            return asset('assets/no-image.jpg');

        return asset($this->file);
    }

}
