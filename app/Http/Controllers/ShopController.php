<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    // หน้าแสดงสินค้าทั้งหมดในร้าน (หรือหน้าแคตตาล็อก)
    public function index()
    {
        $categories = Category::all();

        // Best Practice:
        // 1. เติม with('category') เพื่อป้องกัน N+1 Query
        // 2. เปลี่ยน get() เป็น paginate() เพื่อให้รองรับข้อมูลจำนวนมากๆ ได้อย่างสวยงาม
        $products = Product::with('category')
            ->when(request('category_id'), function ($query) {
                $query->where('category_id', request('category_id'));
            })
            ->latest()
            ->paginate(12);

        $popularProducts = Product::orderBy('views', 'desc')
            ->take(10)
            ->get();

        return view('shop', compact('categories', 'products', 'popularProducts'));
    }

    // หน้าแสดงรายละเอียดสินค้า "ทีละ 1 ชิ้น"
    public function show(Product $product)
    {
        $product->timestamps = false;
        $product->increment('views');

        return view('shop.show', compact('product'));
    }
}
