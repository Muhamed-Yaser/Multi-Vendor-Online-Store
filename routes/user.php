<?php

use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckOutController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Home Page
Route::get('/home', [HomeController::class, 'index'])->name('front.index');

//Product details
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{gggg}', [ProductController::class, 'show'])->name('products.show');

//cart
Route::resource('/cart', CartController::class);

//checkout
Route::get('checkout',[CheckOutController::class , 'create'])->name('checkout');
Route::post('checkout',[CheckOutController::class , 'store'])->name('checkout.store');

//////
