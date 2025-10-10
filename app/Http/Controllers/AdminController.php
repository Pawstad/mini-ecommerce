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

    // ======= product ========
    public function addProduct(){
        $categories = Category::all();
        return view('admin.addproduct', compact('categories'));
    }

    public function postAddProduct(Request $request){
        $product = new Product();
        $product->product_name=$request->product_name;
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

    public function destroyProduct($id) {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }


    public function viewOrder() {
        $orders = Order::all();
        return view('admin.vieworder', compact('orders'));
    }

    public function changeStatus(Request $request, $id) {
        $order = Order::findOrFail($id);
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'Order status updated successfully.');
    }
}
