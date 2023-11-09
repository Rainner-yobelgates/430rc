<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\SettingController;
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

Route::get('/', [WebsiteController::class, 'home'])->name('home');
Route::get('/about', [WebsiteController::class, 'about'])->name('about');
Route::get('/gallery', [WebsiteController::class, 'gallery'])->name('gallery');
Route::get('/products', [WebsiteController::class, 'products'])->name('products');
Route::get('/detail', [WebsiteController::class, 'detail'])->name('detail');
Route::get('/cart', [WebsiteController::class, 'cart'])->name('cart');

Route::get('/panel', [AuthController::class, 'login'])->name('login');
Route::post('/panel/go-login', [AuthController::class, 'goLogin'])->name('goLogin');
Route::get('/panel/log-out', [AuthController::class, 'logOut'])->name('logOut');
Route::group(['middleware' => 'auth'], function () {
    Route::get('/panel/dashboard', [DashboardController::class, 'dashboard'])->name('panel.dashboard');
    // FAQ
    Route::get('/panel/faq', [FaqController::class, 'index'])->name('panel.faq.index');
    Route::get('/panel/faq/data', [FaqController::class, 'data'])->name('panel.faq.data');
    Route::get('/panel/faq/create', [FaqController::class, 'create'])->name('panel.faq.create');
    Route::post('/panel/faq/store', [FaqController::class, 'store'])->name('panel.faq.store');
    Route::get('/panel/faq/{faq:id}/show', [FaqController::class, 'show'])->name('panel.faq.show');
    Route::get('/panel/faq/{faq:id}/edit', [FaqController::class, 'edit'])->name('panel.faq.edit');
    Route::patch('/panel/faq/{faq:id}/update', [FaqController::class, 'update'])->name('panel.faq.update');
    Route::delete('/panel/faq/{faq:id}/delete', [FaqController::class, 'delete'])->name('panel.faq.delete');
    
    Route::get('/panel/setting', [SettingController::class, 'index'])->name('panel.setting.index');
    Route::patch('/panel/setting/update', [SettingController::class, 'update'])->name('panel.setting.update');
});

