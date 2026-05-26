<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Product::with('category');

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // คำนวณค่าสถิติจากสินค้าที่ตรงตามเงื่อนไข (ก่อนทำการแบ่งหน้า)
        $totalProductsCount = $query->count();
        $totalQuantitySum = $query->sum('quantity');
        $totalStockValueSum = $query->sum(\Illuminate\Support\Facades\DB::raw('price * quantity'));

        // แบ่งหน้าละ 10 รายการ และคงค่า Query String (เช่น category_id) ในลิงก์เปลี่ยนหน้า
        $products = $query->paginate(10)->withQueryString();

        return view('products.index', compact(
            'products',
            'categories',
            'totalProductsCount',
            'totalQuantitySum',
            'totalStockValueSum'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        // 1. ดึงข้อมูลที่ผ่านการ Validate มาเก็บไว้
        $validated = $request->validated();

        // 2. ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพ "ใหม่" เข้ามาหรือไม่
        if ($request->hasFile('image')) {

            // 2.1 ถ้ามีรูปภาพเดิมอยู่แล้ว ให้ลบออกจากโฟลเดอร์เพื่อประหยัดพื้นที่
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // 2.2 อัปโหลดรูปภาพใหม่ และนำ Path ที่ได้ไปแทนที่ใน Array
            $validated['image'] = $request->file('image')->store('products', 'public');

        } else {
            // 2.3 ถ้า "ไม่มี" การอัปโหลดรูปใหม่ ให้ถอดคีย์ image ออกจาก Array
            // เพื่อป้องกันไม่ให้ระบบนำค่า null ไปเขียนทับ Path รูปเดิมในฐานข้อมูล
            unset($validated['image']);
        }

        // 3. อัปเดตข้อมูลทั้งหมดลงฐานข้อมูลในครั้งเดียว
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'อัปเดตข้อมูลสินค้าสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index');
    }
}
