<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;

class BlogController extends Controller
{
    public function index()
    {
        // Load categories with count of their posts to display in the sidebar
        $categories = Category::withCount('posts')->get();

        // Eager load category relation to prevent N+1 queries when rendering the category name badge
        $posts = Post::with('category')
            ->when(request('category_id'), function ($query) {
                $query->where('category_id', request('category_id'));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('blog', compact('categories', 'posts'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Load categories with count of their posts to keep sidebar counters consistent
        $categories = Category::withCount('posts')->get();

        $post->load('category');

        return view('blog.show', compact('categories', 'post'));
    }
}
