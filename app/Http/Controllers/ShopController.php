<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Product::when(request('category_id'), function ($query) {
            $query->where('category_id', request('category_id'));
        })->latest()->get();

        return view('shop', compact('categories', 'products'));
    }
}
