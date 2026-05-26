<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with compiled aggregate statistics.
     */
    public function __invoke()
    {
        $categoriesCount = Category::count();
        $productsCount = Product::count();
        $postsCount = Post::count();

        $totalStockValue = Product::sum(DB::raw('price * quantity'));

        $recentProducts = Product::latest()->take(3)->get();
        $recentPosts = Post::latest()->take(3)->get();

        return view('dashboard', compact(
            'categoriesCount',
            'productsCount',
            'postsCount',
            'totalStockValue',
            'recentProducts',
            'recentPosts'
        ));
    }
}
