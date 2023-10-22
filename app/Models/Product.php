<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    const ACTIVE_STATUS=1;


    protected $fillable = [
        "name",
        "description",
        "image",
        "price",
        "slug",
    ];

    function scopeActive($query) {

        return $query->where('products.is_active', Product::ACTIVE_STATUS);

    }




}
