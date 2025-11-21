<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ShopListController;


Route::get('/default', function () {
    return view('welcome');
});

Route::get('/subcategories/by-category/{catID}', function ($catID) {
    return \App\Models\SubCategory::where('catID', $catID)->get();
});


// Home
Route::get('/', function () {
    return view('Home');
})->name('home');

// About
Route::get('about', function(){
    return view('pages.about');
})->name('home');

// List
Route::get('/List', [ShopListController::class, 'index'])->name('List');

// Category Routes
Route::get('/AddCategory', [CategoryController::class, 'create'])->name('AddCategory');
Route::post('/categories/store', [CategoryController::class, 'store'])->name('categories.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Shop
// Shop Routes
Route::get('/AddShop', [ShopController::class, 'create'])->name('AddShop');
Route::post('/shops/store', [ShopController::class, 'store'])->name('shops.store');
Route::get('/shops/{shop}/edit', [ShopController::class, 'edit'])->name('shops.edit');
Route::put('/shops/{shop}', [ShopController::class, 'update'])->name('shops.update');
Route::delete('/shops/{shop}', [ShopController::class, 'destroy'])->name('shops.destroy');

