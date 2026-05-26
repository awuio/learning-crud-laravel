<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,'.$category->id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // ตรวจสอบว่ามีสินค้าหรือโพสต์ที่เชื่อมโยงกับหมวดหมู่นี้อยู่หรือไม่
        if ($category->products()->exists() || $category->posts()->exists()) {
            return redirect()->back()->with('error', 'ไม่สามารถลบหมวดหมู่นี้ได้ เนื่องจากยังมีสินค้าหรือโพสต์ที่ใช้งานหมวดหมู่นี้อยู่');
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'ลบหมวดหมู่สำเร็จเรียบร้อยแล้ว');
    }
}
