<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'image', 'category_id', 'content', 'weight', 'price', 'discount'
    ];

    public function getImageAttribute($image)
    {
        return asset('storage/products/' . $image);
    }
}
