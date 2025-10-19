<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Models\Product;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CartController;

Route::get('/product_details/{id}', [UserController::class, 'productDetails'])->name('product_details');


Route::get('/', function () {
    // fetch 4 latest products to show on the homepage
    $latestProducts = Product::orderBy('created_at', 'desc')->take(4)->get();
    return view('index', compact('latestProducts'));
})->name('index');

Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Public catalog route (search + category filter)
Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog.index');


Route::middleware(['auth','verified'])->group(function () {
    // Cart & checkout routes used by views
    Route::post('/cart', [CartController::class, 'add'])->name('cart');
    // alias used in some views
    Route::post('/cart', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');

    Route::get('/checkout', [CartController::class, 'showCheckoutForm'])->name('checkout.form');
    Route::post('/checkout', [CartController::class, 'processCheckout'])->name('checkout');
    // quick-buy: add item to cart then show checkout form (used by "Beli Sekarang")
    Route::post('/checkout/buy-now', [CartController::class, 'buyNow'])->name('checkout.buy_now');

    // public proof viewing (buyers can view uploaded proof if they have the link)
    Route::get('/order/{id}/proof-public', [\App\Http\Controllers\CartController::class, 'showPaymentProofPublic'])->name('order.proof_public');
    Route::get('/order/history', [CartController::class, 'orderHistory'])->name('order.history');
    

});
Route::middleware(['auth','admin'])->group(function () {
    // Route::get('/tesadmin', [AdminController::class, 'tesadmin'])->name('admin.tes');
    Route::get('/add_category', [AdminController::class, 'addCategory'])->name('admin.addcategory');
    Route::post('/add_category', [AdminController::class, 'postAddCategory'])->name('admin.postaddcategory');
    Route::get('/view_category', [AdminController::class, 'viewCategory'])->name('admin.viewcategory');
    // edit/update/delete category
    Route::get('/edit_category/{id}', [AdminController::class, 'editCategory'])->name('admin.editcategory');
    Route::post('/update_category/{id}', [AdminController::class, 'updateCategory'])->name('admin.updatecategory');
    Route::post('/delete_category/{id}', [AdminController::class, 'destroyCategory'])->name('admin.destroycategory');
    Route::get('/add_product', [AdminController::class, 'addProduct'])->name('admin.addproduct');
    Route::post('/add_product', [AdminController::class, 'postAddProduct'])->name('admin.postaddproduct');
    Route::get('/delete_product', [AdminController::class, 'deleteProduct'])->name('admin.deleteproduct');
    Route::post('/delete_product/{id}', [AdminController::class, 'destroyProduct'])->name('admin.destroyproduct');
    // view and edit products
    Route::get('/view_product', [AdminController::class, 'viewProduct'])->name('admin.viewproduct');
    Route::get('/edit_product/{id}', [AdminController::class, 'editProduct'])->name('admin.editproduct');
    Route::post('/update_product/{id}', [AdminController::class, 'updateProduct'])->name('admin.updateproduct');
    Route::get('/vieworder', [AdminController::class, 'viewOrder'])->name('admin.vieworder');
    // serve payment proof files to admins (protected)
    Route::get('/order/{id}/proof', [AdminController::class, 'showPaymentProof'])->name('admin.order_proof');
    Route::post('/change_status/{id}', [AdminController::class, 'changeStatus'])->name('admin.change_status');
});

require __DIR__.'/auth.php';
