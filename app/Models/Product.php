<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Allow mass assignment for common fields
    protected $fillable = [
        'product_name',
        'product_description',
        'product_quantity',
        'product_price',
        'product_image',
        'product_category',
    ];

    // Casts
    protected $casts = [
        'product_price' => 'decimal:2',
        'product_quantity' => 'integer',
        'product_category' => 'integer',
    ];

    // Relationship: product belongs to a category (product_category stores category id)
    public function category()
    {
        return $this->belongsTo(Category::class, 'product_category');
    }
}
