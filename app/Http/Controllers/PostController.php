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
            'media.*' => 'file|mimes:jpeg,jpg,png,gif,mp4,mov,avi|max:10240',
            'scheduled_at' => 'nullable|date',
        ]);


        $mediaPaths = [];
    if ($request->hasFile('media')) {
        foreach ($request->file('media') as $file) {
            $path = $file->store('uploads/posts', 'public'); // Store in 'storage/app/public/uploads/posts'
            $mediaPaths[] = asset('storage/' . $path); // Generate a URL to access the file
        }
    }

        $post = Post::create([
            'user_id' => Auth::id(),
            'caption' => $request->caption,
            'hashtags' => $request->hashtags,
            'media' => json_encode($mediaPaths),
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


    public function recent()
    {
        $posts = Post::orderBy('created_at', 'desc')->take(5)->get();
        return response()->json(['recent_posts' => $posts], 200);
    }

    // Fetch trending posts
    public function trending()
    {
        $posts = Post::withCount('likes')->orderBy('likes_count', 'desc')->take(5)->get();
        return response()->json(['trending_posts' => $posts], 200);
    }

    // Like or unlike a post
    public function like(Request $request, $postId)
    {
        $user = auth()->user();

        $post = Post::findOrFail($postId);

        $like = Like::where('post_id', $post->id)->where('user_id', $user->id)->first();

        if ($like) {
            // Unlike the post
            $like->delete();
            return response()->json(['message' => 'Post unliked successfully.'], 200);
        } else {
            // Like the post
            Like::create([
                'post_id' => $post->id,
                'user_id' => $user->id,
            ]);

            return response()->json(['message' => 'Post liked successfully.'], 201);
        }
    }
}
