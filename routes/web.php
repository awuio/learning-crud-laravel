<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Middleware\IsAdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/shop/{product}', [ShopController::class, 'show'])->name('shop.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');

    Route::middleware(IsAdminMiddleware::class)->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('posts', PostController::class);
        Route::resource('products', ProductController::class);
    });

    Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)
        ->middleware(['verified'])
        ->name('dashboard');
});

require __DIR__.'/auth.php';
