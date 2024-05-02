<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AdminController;
use App\Http\Controllers\Front\DashboardController;
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

Route::match(['get' , 'post'] , '/dashboard' , [DashboardController::class , 'index'])->name('dashboard.index');

//fallback
Route::fallback(function () {
    return 'page not found';
});
