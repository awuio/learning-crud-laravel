<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShopController;
use App\Http\Middleware\IsAdminMiddleware;
use GuzzleHttp\Promise\Is;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    
    Route::middleware(IsAdminMiddleware::class)->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('posts', PostController::class);
        Route::resource('products', ProductController::class);
    });
    
    Route::get('/dashboard', function () {
        $categoriesCount = \App\Models\Category::count();
        $productsCount = \App\Models\Product::count();
        $postsCount = \App\Models\Post::count();
        
        $totalStockValue = \App\Models\Product::sum(\Illuminate\Support\Facades\DB::raw('price * quantity'));
        
        $recentProducts = \App\Models\Product::latest()->take(3)->get();
        $recentPosts = \App\Models\Post::latest()->take(3)->get();

        return view('dashboard', compact(
            'categoriesCount', 
            'productsCount', 
            'postsCount', 
            'totalStockValue',
            'recentProducts',
            'recentPosts'
        ));
    })->middleware(['verified'])->name('dashboard');
});

require __DIR__.'/auth.php';
