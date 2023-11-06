<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/gallery', [HomeController::class, 'gallery'])->name('gallery');
Route::get('/products', [HomeController::class, 'products'])->name('products');
Route::get('/detail', [HomeController::class, 'detail'])->name('detail');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');

Route::get('/panel', [AuthController::class, 'login'])->name('login');
Route::post('/panel/go-login', [AuthController::class, 'goLogin'])->name('goLogin');
Route::get('/panel/log-out', [AuthController::class, 'logOut'])->name('logOut');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/panel/dashboard', [DashboardController::class, 'dashboard'])->name('panel.dashboard');
});

