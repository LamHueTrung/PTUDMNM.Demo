<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name_product', 'description', 'price', 'brand', 'id_image'];

    public function image()
    {
        return $this->belongsTo(Image::class, 'id_image');
    }
}

