<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'caption' => 'required|string|max:255',
            'hashtags' => 'nullable|array',
            'media' => 'nullable|array|max:3', // Max 3 images or 1 video
            'media.*' => 'url',
            'scheduled_at' => 'nullable|date',
        ]);


        $post = Post::create([
            'user_id' => Auth::id(),
            'caption' => $request->caption,
            'hashtags' => $request->hashtags,
            'media' => $request->media,
            'scheduled_at' => $request->scheduled_at,
        ]);

        return response()->json(['message' => 'Post created successfully!', 'post' => $post], 201);
    }

    public function index()
    {
        $posts = Post::with('polls' ,  'user')->latest()->get();

        return response()->json(['message' => 'All posts retrieved successfully!', 'posts' => $posts], 200);
    }

    // public function show($slug)
    // {
    //     $post = Post::with('polls')->where('slug', $slug)->first();

    //     if (!$post) {
    //         return response()->json(['message' => 'Post not found!'], 404);
    //     }

    //     return response()->json(['message' => 'Post retrieved successfully!', 'post' => $post], 200);
    // }


    public function show($slug)
    {
        $post = Post::with('polls', 'user')->where('slug', $slug)->firstOrFail();
        if (!$post) {
                    return response()->json(['message' => 'Post not found!'], 404);
                }
        
                return response()->json(['message' => 'Post retrieved successfully!', 'post' => $post], 200);
            }

    public function myPosts()
    {
        $posts = auth()->user()->posts()->with('polls')->get();
        return response()->json(['posts' => $posts], 200);
    }
}
