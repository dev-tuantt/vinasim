<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;

Route::get('/', [ClientController::class, 'home'])->name('home');
Route::get('/goi-cuoc-data-4g-5g', [ClientController::class, 'dataPackages'])->name('data-packages');
Route::get('/sim-so-dep', [ClientController::class, 'simNumbers'])->name('sim-numbers');
Route::get('/tin-tuc', [ClientController::class, 'news'])->name('news');
Route::get('/tin-tuc/{slug}', [ClientController::class, 'newsDetail'])->name('news.show');
Route::get('/ve-chung-toi', [ClientController::class, 'about'])->name('about');
Route::get('/tra-cuu-don-hang', [ClientController::class, 'orderTracking'])->name('order-tracking');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AdminController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminController::class, 'login'])->name('login.submit');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    Route::get('/users', [AdminController::class, 'user_index'])->name('users');
    Route::post('/users', [AdminController::class, 'store_user'])->name('users.store');
    Route::put('/users/{id}', [AdminController::class, 'update_user'])->name('users.update');
    Route::delete('/users/{id}', [AdminController::class, 'destroy_user'])->name('users.destroy');

    Route::get('/banners', [AdminController::class, 'banner_index'])->name('banners');
    Route::post('/banners/upload', [AdminController::class, 'upload_banner'])->name('banners.upload');
    Route::post('/banners/delete', [AdminController::class, 'delete_banner'])->name('banners.delete');

    Route::get('/seo', [AdminController::class, 'seo_index'])->name('seo');
    Route::post('/seo/save', [AdminController::class, 'save_seo'])->name('seo.save');

    Route::get('/orders', [AdminController::class, 'order_index'])->name('orders');

    Route::get('/news', [AdminController::class, 'news_index'])->name('news');
    Route::get('/news/editor', [AdminController::class, 'news_editor'])->name('news.editor');
    Route::get('/news/{id}', [AdminController::class, 'news_show'])->whereNumber('id')->name('news.show');
    Route::post('/news', [AdminController::class, 'store_news'])->name('news.store');
    Route::put('/news/{id}', [AdminController::class, 'update_news'])->whereNumber('id')->name('news.update');

    Route::get('/product', [ProductController::class, 'index'])->name('products');
    Route::post('/product', [ProductController::class, 'store'])->name('products.store');
    Route::post('/product/import', [ProductController::class, 'import'])->name('products.import');
    Route::put('/product/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});