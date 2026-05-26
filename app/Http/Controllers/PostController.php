<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('posts.create', compact('categories'));
    }

    public function store(StorePostRequest $request)
    {
        Post::create($request->validated());

        return redirect()->route('posts.index')->with('success', 'โพสต์ใหม่ถูกสร้างเรียบร้อยแล้ว');
    }

    public function show(Post $post)
    {
        //
    }

    public function edit(Post $post)
    {
        $categories = Category::all();

        return view('posts.edit', compact('post', 'categories'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        // เมื่อโค้ดทำงานมาถึงบรรทัดนี้ แปลว่าข้อมูลผ่านการตรวจสอบจาก UpdatePostRequest แล้ว 100%
        // ใช้ $request->validated() เพื่อดึงเฉพาะข้อมูลที่อยู่ใน rules() มาอัปเดต
        $post->update($request->validated());

        return redirect()->route('posts.index')->with('success', 'อัปเดตโพสต์เรียบร้อยแล้ว');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'ลบโพสต์เรียบร้อยแล้ว');
    }
}
