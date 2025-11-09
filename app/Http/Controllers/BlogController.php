<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $posts = Post::when(request('category'), function ($query) {
            $query->where('category_id', request('category'));
        })
        ->latest('id')
        ->get();
        
        return view('blog', compact('categories', 'posts'));
    }
}
