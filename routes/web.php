<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

use App\Models\Product;

Route::get('/', function () {
    // fetch 4 latest products to show on the homepage
    $latestProducts = Product::orderBy('created_at', 'desc')->take(4)->get();
    return view('index', compact('latestProducts'));
})->name('index');


Route::get('/dashboard', [UserController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Public catalog route (search + category filter)
use App\Http\Controllers\CatalogController;
Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','admin'])->group(function () {
    // Route::get('/tesadmin', [AdminController::class, 'tesadmin'])->name('admin.tes');
    Route::get('/add_category', [AdminController::class, 'addCategory'])->name('admin.addcategory');
    Route::post('/add_category', [AdminController::class, 'postAddCategory'])->name('admin.postaddcategory');
    Route::get('/add_product', [AdminController::class, 'addProduct'])->name('admin.addproduct');
    Route::post('/add_product', [AdminController::class, 'postAddProduct'])->name('admin.postaddproduct');
    Route::get('/vieworder', [AdminController::class, 'viewOrder'])->name('admin.vieworder');
    Route::post('/change_status/{id}', [AdminController::class, 'changeStatus'])->name('admin.change_status');
});

require __DIR__.'/auth.php';
