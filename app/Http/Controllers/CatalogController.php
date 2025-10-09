<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CatalogController extends Controller
{
    /**
     * Display the catalog with optional search and category filter.
     * Query params:
     * - q: search term (matches product_name or product_description)
     * - category: category id to filter
     */
    public function index(Request $request)
    {
        $q = $request->query('q');
        $category = $request->query('category');

        $categories = Category::all();

        $productsQuery = Product::query();

        if ($q) {
            $productsQuery->where(function($w) use ($q) {
                $w->where('product_name', 'like', "%{$q}%")
                  ->orWhere('product_description', 'like', "%{$q}%");
            });
        }

        if ($category) {
            $productsQuery->where('product_category', $category);
        }

        $products = $productsQuery->orderBy('created_at', 'desc')->paginate(12)->withQueryString();

        return view('katalog', compact('products', 'categories', 'q', 'category'));
    }
}
