<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WebsiteController;
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
Route::get('/products/{product:slugs}/detail', [WebsiteController::class, 'detail'])->name('detail');
Route::post('/check-available', [WebsiteController::class, 'checkAvailable'])->name('checkAvailable');
Route::post('/add-to-cart', [WebsiteController::class, 'addToCart'])->name('addToCart');
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
    // Gallery
    Route::get('/panel/gallery', [GalleryController::class, 'index'])->name('panel.gallery.index');
    Route::get('/panel/gallery/data', [GalleryController::class, 'data'])->name('panel.gallery.data');
    Route::get('/panel/gallery/create', [GalleryController::class, 'create'])->name('panel.gallery.create');
    Route::post('/panel/gallery/store', [GalleryController::class, 'store'])->name('panel.gallery.store');
    Route::get('/panel/gallery/{gallery:id}/show', [GalleryController::class, 'show'])->name('panel.gallery.show');
    Route::get('/panel/gallery/{gallery:id}/edit', [GalleryController::class, 'edit'])->name('panel.gallery.edit');
    Route::patch('/panel/gallery/{gallery:id}/update', [GalleryController::class, 'update'])->name('panel.gallery.update');
    Route::delete('/panel/gallery/{gallery:id}/delete', [GalleryController::class, 'delete'])->name('panel.gallery.delete');
    // Product
    Route::get('/panel/product', [ProductController::class, 'index'])->name('panel.product.index');
    Route::get('/panel/product/data', [ProductController::class, 'data'])->name('panel.product.data');
    Route::get('/panel/product/create', [ProductController::class, 'create'])->name('panel.product.create');
    Route::post('/panel/product/store', [ProductController::class, 'store'])->name('panel.product.store');
    Route::get('/panel/product/{product:id}/show', [ProductController::class, 'show'])->name('panel.product.show');
    Route::get('/panel/product/{product:id}/edit', [ProductController::class, 'edit'])->name('panel.product.edit');
    Route::patch('/panel/product/{product:id}/update', [ProductController::class, 'update'])->name('panel.product.update');
    Route::delete('/panel/product/{product:id}/delete', [ProductController::class, 'delete'])->name('panel.product.delete');
    //Product Attribute
    Route::get('/panel/product/{product:id}/attribute/data', [ProductController::class, 'attributeData'])->name('panel.product.attribute.data');
    Route::get('/panel/product/{product:id}/attribute/create', [ProductController::class, 'attributeCreate'])->name('panel.product.attribute.create');
    Route::post('/panel/product/{product:id}/attribute/store', [ProductController::class, 'attributeStore'])->name('panel.product.attribute.store');
    Route::get('/panel/product/{product:id}/attribute/{attribute:id}/show', [ProductController::class, 'attributeShow'])->name('panel.product.attribute.show');
    Route::get('/panel/product/{product:id}/attribute/{attribute:id}/edit', [ProductController::class, 'attributeEdit'])->name('panel.product.attribute.edit');
    Route::patch('/panel/product/{product:id}/attribute/{attribute:id}/update', [ProductController::class, 'attributeUpdate'])->name('panel.product.attribute.update');
    Route::delete('/panel/product/{product:id}/attribute/{attribute:id}/delete', [ProductController::class, 'attributeDelete'])->name('panel.product.attribute.delete');
    //Product Attribute
    Route::get('/panel/product/{product:id}/image/data', [ProductController::class, 'imageData'])->name('panel.product.image.data');
    Route::get('/panel/product/{product:id}/image/create', [ProductController::class, 'imageCreate'])->name('panel.product.image.create');
    Route::post('/panel/product/{product:id}/image/store', [ProductController::class, 'imageStore'])->name('panel.product.image.store');
    Route::get('/panel/product/{product:id}/image/{image:id}/show', [ProductController::class, 'imageShow'])->name('panel.product.image.show');
    Route::get('/panel/product/{product:id}/image/{image:id}/edit', [ProductController::class, 'imageEdit'])->name('panel.product.image.edit');
    Route::patch('/panel/product/{product:id}/image/{image:id}/update', [ProductController::class, 'imageUpdate'])->name('panel.product.image.update');
    Route::delete('/panel/product/{product:id}/image/{image:id}/delete', [ProductController::class, 'imageDelete'])->name('panel.product.image.delete');
     // Color
     Route::get('/panel/color', [ColorController::class, 'index'])->name('panel.color.index');
     Route::get('/panel/color/data', [ColorController::class, 'data'])->name('panel.color.data');
     Route::get('/panel/color/create', [ColorController::class, 'create'])->name('panel.color.create');
     Route::post('/panel/color/store', [ColorController::class, 'store'])->name('panel.color.store');
     Route::get('/panel/color/{color:id}/show', [ColorController::class, 'show'])->name('panel.color.show');
     Route::get('/panel/color/{color:id}/edit', [ColorController::class, 'edit'])->name('panel.color.edit');
     Route::patch('/panel/color/{color:id}/update', [ColorController::class, 'update'])->name('panel.color.update');
     Route::delete('/panel/color/{color:id}/delete', [ColorController::class, 'delete'])->name('panel.color.delete');
    //Settings
    Route::get('/panel/setting', [SettingController::class, 'index'])->name('panel.setting.index');
    Route::patch('/panel/setting/update', [SettingController::class, 'update'])->name('panel.setting.update');
});

