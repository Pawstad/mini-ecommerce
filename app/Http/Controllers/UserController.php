<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::check() && Auth::user()->role == 'user') {
            return view('dashboard');
        } elseif (Auth::check() && Auth::user()->role == 'admin') {
            return view('admin.dashboard');
        }
    }

    public function productDetails($id)
    {
        // Fetch product details by ID
        $product = Product::findorFail($id);
        return view('product_details', compact('product'));
    }
}


            
