<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 'price', 'stock', 'image_url'
    ];

    // Relasi Many-to-One: Banyak Produk dimiliki satu Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}