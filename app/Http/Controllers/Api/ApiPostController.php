<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;

class ApiPostController extends Controller
{
    // GET: /api/post
    public function index()
    {
        $posts = Post::with(['category', 'author'])->latest()->get();
        return response()->json($posts);
    }

    // GET: /api/post/{slug}
    public function show($slug)
    {
        $post = Post::with(['category', 'author'])->where('slug', $slug)->firstOrFail();
        return response()->json($post);
    }
}
