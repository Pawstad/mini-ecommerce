<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
class AdminController extends Controller
{
    // public function tesadmin() {
    //     return view('admin.tes');
    // }

    // ======= category ========

    public function addCategory(){
        return view('admin.addcategory');
    }

    public function postAddCategory(Request $request){
        $category = new Category();
        $category->category_name=$request->category_name;
        $category->save();
        return redirect()->back()->with('category_added', 'Category added successfully.');

    }

    public function viewCategory(){
        $categories = Category::all();
        return view('admin.viewcategory', compact('categories'));
    }

    public function editCategory($id) {
        $category = Category::findOrFail($id);
        return view('admin.editcategory', compact('category'));
    }

    public function updateCategory(Request $request, $id) {
        $category = Category::findOrFail($id);
        $category->category_name = $request->input('category_name');
        $category->save();
        return redirect()->route('admin.viewcategory')->with('success', 'Category updated.');
    }

    public function destroyCategory($id) {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.viewcategory')->with('success', 'Category deleted.');
    }

    // ======= product ========
    public function addProduct(){
        $categories = Category::all();
        return view('admin.addproduct', compact('categories'));
    }

    public function postAddProduct(Request $request){
        $product = new Product();
        $product->product_name=$request->product_name;
        $product->author = $request->input('author');
        $product->publisher = $request->input('publisher');
        $product->isbn = $request->input('isbn');
        $product->pages = $request->input('pages');
        $product->product_description=$request->product_description;
        $product->product_quantity=$request->product_quantity;
        $product->product_price=$request->product_price;
        if($request->hasFile('product_image')){
            $file=$request->file('product_image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('uploads/products/',$filename);
            $product->product_image=$filename;
        }
        $product->product_category=$request->product_category;

        $product->save();
        return redirect()->back()->with('product_added', 'Product added successfully.');
    }

    public function deleteProduct() {
        $products = Product::all();
        return view('admin.deleteproduct', compact('products'));
    }

    // new: show products (view/edit)
    public function viewProduct() {
        $products = Product::with('category')->get();
        return view('admin.viewproduct', compact('products'));
    }

    public function editProduct($id) {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.editproduct', compact('product','categories'));
    }

    public function updateProduct(Request $request, $id) {
        $product = Product::findOrFail($id);
        $product->product_name = $request->input('product_name');
        $product->author = $request->input('author');
        $product->publisher = $request->input('publisher');
        $product->isbn = $request->input('isbn');
        $product->pages = $request->input('pages');
        $product->product_description = $request->input('product_description');
        $product->product_quantity = $request->input('product_quantity');
        $product->product_price = $request->input('product_price');
        $product->product_category = $request->input('product_category');

        if($request->hasFile('product_image')){
            // delete old image if exists
            if($product->product_image && file_exists(public_path('uploads/products/' . $product->product_image))) {
                @unlink(public_path('uploads/products/' . $product->product_image));
            }
            $file=$request->file('product_image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('uploads/products/',$filename);
            $product->product_image=$filename;
        }

        $product->save();
        return redirect()->route('admin.viewproduct')->with('success', 'Product updated successfully.');
    }

    public function destroyProduct($id) {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }


    public function viewOrder() {
        $orders = Order::all();
        return view('admin.vieworder', compact('orders'));
    }

    // show payment proof (admin-only)
    public function showPaymentProof($id) {
        $order = Order::findOrFail($id);
        if (empty($order->payment_proof)) {
            abort(404);
        }
        $path = storage_path('app/public/' . $order->payment_proof);
        if (!file_exists($path)) {
            abort(404);
        }
        return response()->file($path);
    }

    public function changeStatus(Request $request, $id) {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
