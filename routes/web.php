<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view("auth.login");
});

Auth::routes();

 
Route::get('/AddToCart/{id}', [App\Http\Controllers\HomeController::class, 'AddToCart'])->name('AddToCart'); 
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/shop', [App\Http\Controllers\HomeController::class, 'shop'])->name('shop');
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
Route::get('/MyOrder', [App\Http\Controllers\HomeController::class, 'MyOrder'])->name('MyOrder');
Route::get('/MyAccount', [App\Http\Controllers\HomeController::class, 'MyAccount'])->name('MyAccount');
Route::get('/product/{id}', [App\Http\Controllers\HomeController::class, 'product'])->name('product');
Route::get('/AddToCart/{id}', [App\Http\Controllers\HomeController::class, 'AddToCart'])->name('AddToCart');
Route::post('/CartProduct/{id}', [App\Http\Controllers\HomeController::class, 'CartProduct'])->name('CartProduct');
Route::get('/cart', [App\Http\Controllers\HomeController::class, 'cart'])->name('cart');
Route::get('/layout/{id}', [App\Http\Controllers\HomeController::class, 'layout'])->name('layout');
Route::get('/removeCart/{id}', [App\Http\Controllers\HomeController::class, 'removeCart'])->name('removeCart');
Route::get('/checkout/{id}', [App\Http\Controllers\HomeController::class, 'checkout'])->name('checkout');
Route::put('/updatecheckout/{id}', [App\Http\Controllers\HomeController::class, 'UpdateCheckout'])->name('UpdateCheckout');
Route::get('/Logout', [App\Http\Controllers\HomeController::class, 'Logout'])->name('Logout');
Route::get('/ShopCategory/{id}', [App\Http\Controllers\HomeController::class, 'ShopCategory'])->name('ShopCategory');
Route::put('/order/update-status/{id}', [HomeController::class, 'updateOrderStatus'])->name('updateOrderStatus');



 