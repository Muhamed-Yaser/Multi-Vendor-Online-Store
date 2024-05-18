<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductController;

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


    Route::get('/profile', 'profile')->name('profile');
    Route::get('/editProfile', 'editProfile')->name('editProfile');
    Route::post('/updateProfile', 'updateProfile')->name('updateProfile');

    Route::get('/logout', 'logout')->name('logout');
});

Route::get('/dashboard' , [DashboardController::class , 'index'])->name('dashboard.index');

//Categories
Route::get('/dashboard/categories/trash' , [CategoryController::class , 'trash'])->name('dashboard.categories.trash');
Route::post('/dashboard/categories/{category}/restore' , [CategoryController::class , 'restore'])->name('categories.restore');
Route::delete('/dashboard/categories/{category}/forceDelete' , [CategoryController::class , 'forceDelete'])->name('categories.forceDelete');

Route::resource('dashboard/categories' , CategoryController::class)->names([
    'index'=>'dashboard.categories.index',
    'create'=>'dashboard.categories.create',
    'store'=>'dashboard.categories.store',
    'edit'=>'dashboard.categories.edit',
    'update'=>'dashboard.categories.update',
    'destroy'=>'dashboard.categories.destroy',
]);

//Products
Route::resource('dashboard/products' , ProductController::class)->names([
    // 'index'=>'dashboard.categories.index',
    // 'create'=>'dashboard.categories.create',
    // 'store'=>'dashboard.categories.store',
    // 'edit'=>'dashboard.categories.edit',
    // 'update'=>'dashboard.categories.update',
    // 'destroy'=>'dashboard.categories.destroy',
]);

//fallback
Route::fallback(function () {
    return 'page not found';
});