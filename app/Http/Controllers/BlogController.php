<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $posts = Post::when(request('category_id'), function ($query) {
            $query->where('category_id', request('category_id'));
        })->latest()->get();

        return view('blog', compact('categories', 'posts'));
    }
}
