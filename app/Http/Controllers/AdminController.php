<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;

class AdminController extends Controller
{
    // ======= Category ========

    public function addCategory() {
        return view('admin.addcategory');
    }

    public function postAddCategory(Request $request) {
        Category::create(['category_name' => $request->category_name]);
        return redirect()->back()->with('category_added', 'Category added successfully.');
    }

    public function viewCategory() {
        $categories = Category::all();
        return view('admin.viewcategory', compact('categories'));
    }

    public function editCategory($id) {
        $category = Category::findOrFail($id);
        return view('admin.editcategory', compact('category'));
    }

    public function updateCategory(Request $request, $id) {
        $category = Category::findOrFail($id);
        $category->update(['category_name' => $request->category_name]);
        return redirect()->route('admin.viewcategory')->with('success', 'Category updated.');
    }

    public function destroyCategory($id) {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.viewcategory')->with('success', 'Category deleted.');
    }

    // ======= Product ========

    public function addProduct() {
        $categories = Category::all();
        return view('admin.addproduct', compact('categories'));
    }

    public function postAddProduct(Request $request) {
        $product = new Product();
        $product->fill($request->only([
            'product_name',
            'author',
            'publisher',
            'isbn',
            'pages',
            'product_description',
            'product_quantity',
            'product_price',
        ]));

        // upload image
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products/'), $filename);
            $product->product_image = $filename;
        }

        $product->save();

        // attach multiple categories
        if ($request->has('product_categories')) {
            $product->categories()->attach($request->product_categories);
        }

        return redirect()->back()->with('product_added', 'Product added successfully.');
    }

    public function viewProduct() {
        $products = Product::with('categories')->get();
        return view('admin.viewproduct', compact('products'));
    }

    public function editProduct($id) {
        $product = Product::with('categories')->findOrFail($id);
        $categories = Category::all();
        return view('admin.editproduct', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id) {
        $product = Product::findOrFail($id);

        $product->fill($request->only([
            'product_name',
            'author',
            'publisher',
            'isbn',
            'pages',
            'product_description',
            'product_quantity',
            'product_price',
        ]));

        // update image if new one uploaded
        if ($request->hasFile('product_image')) {
            if ($product->product_image && file_exists(public_path('uploads/products/' . $product->product_image))) {
                unlink(public_path('uploads/products/' . $product->product_image));
            }

            $file = $request->file('product_image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/products/'), $filename);
            $product->product_image = $filename;
        }

        $product->save();

        // sync categories (update many-to-many)
        if ($request->has('product_categories')) {
            $product->categories()->sync($request->product_categories);
        }

        return redirect()->route('admin.viewproduct')->with('success', 'Product updated successfully.');
    }

    public function destroyProduct($id) {
        $product = Product::findOrFail($id);
        $product->categories()->detach(); // detach dari pivot
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

    // ======= Orders ========

    public function viewOrder() {
        $orders = Order::all();
        return view('admin.vieworder', compact('orders'));
    }

    public function showPaymentProof($id) {
        $order = Order::findOrFail($id);
        if (empty($order->payment_proof)) abort(404);
        $path = storage_path('app/public/' . $order->payment_proof);
        if (!file_exists($path)) abort(404);
        return response()->file($path);
    }

    public function changeStatus(Request $request, $id) {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}