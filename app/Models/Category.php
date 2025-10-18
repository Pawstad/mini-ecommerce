<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name',
    ];

    // Relationship: category has many products
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product');
    }

}
