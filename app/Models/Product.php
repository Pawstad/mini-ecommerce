<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'product_name',
        'author',
        'publisher',
        'isbn',
        'pages',
        'product_description',
        'product_quantity',
        'product_price',
        'product_image',
    ];

    // Casting tipe data
    protected $casts = [
        'product_price' => 'decimal:2',
        'product_quantity' => 'integer',
    ];

    // Relasi many-to-many ke kategori
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product');
    }
}
