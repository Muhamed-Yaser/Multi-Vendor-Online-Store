<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//authAdmin
Route::controller(AdminController::class)->prefix('admin')->group(function () {

    Route::get('login', 'loginPage')->name('loginPage');
    Route::post('login', 'login')->name('login');
    Route::get('/logout', 'logout')->name('logout');
});

//Prfile

    Route::get('/dashboard/profile/edit', [ProfileController::class, 'edit'])->name('dashboard.profile.edit');
    Route::put('/dashboard/profile/update', [ProfileController::class, 'update'])->name('dashboard.profile.update');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

//Categories
Route::get('/dashboard/categories/trash', [CategoryController::class, 'trash'])->name('dashboard.categories.trash');
Route::post('/dashboard/categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
Route::delete('/dashboard/categories/{category}/forceDelete', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');

Route::resource('dashboard/categories', CategoryController::class)->names([
    'index' => 'dashboard.categories.index',
    'create' => 'dashboard.categories.create',
    'store' => 'dashboard.categories.store',
    'show' => 'dashboard.categories.show',
    'edit' => 'dashboard.categories.edit',
    'update' => 'dashboard.categories.update',
    'destroy' => 'dashboard.categories.destroy',
]);

//Products
Route::resource('dashboard/products', ProductController::class)->names([
    'index' => 'dashboard.products.index',
    // 'create'=>'dashboard.products.create',
    // 'store'=>'dashboard.products.store',
     'edit'=>'dashboard.products.edit',
    'update'=>'dashboard.products.update',
    'destroy'=>'dashboard.products.destroy',
]);

//fallback
Route::fallback(function () {
    return 'page not found';
});