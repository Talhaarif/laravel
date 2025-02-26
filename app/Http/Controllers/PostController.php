<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Comment;

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
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = 'uploads/posts/' . $filename;
    
            $moved = $file->move(public_path('uploads/posts'), $filename);
    
            if (!$moved) {
                return response()->json(['message' => 'File move failed!'], 500);
            }
    
            $mediaPaths[] = $path;
        }
    }
    


        $post = Post::create([
            'user_id' => Auth::id(),
            'caption' => $request->caption,
            'hashtags' => $request->hashtags,
            'media' => $mediaPaths,
            'scheduled_at' => $request->scheduled_at,
        ]);

        return response()->json(['message' => 'Post created successfully!', 'post' => $post], 201);
    }

    public function index()
    {

        $user = auth()->user();
        $posts = Post::with('polls.votes.user' ,  'user', 'comments')->withCount('likes')->latest()->get()->map(function ($post) use ($user) {
            if ($post->polls) {
                $post->polls->vote_counts = $post->polls->vote_counts;
                $post->polls->total_votes = $post->polls->total_votes;
                $post->polls->vote_percentages = $post->polls->vote_percentages;
            }
            $post->is_liked = $user ? $post->likes()->where('user_id', $user->id)->exists() : false;
            return $post;
        });



        return response()->json(['message' => 'All posts retrieved successfully!', 'posts' => $posts ], 200);
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
        $post = Post::with(['polls.votes.user', 'user', 'comments'])->where('slug', $slug)->firstOrFail();

        if ($post->polls) {
            $post->polls->vote_counts = $post->polls->vote_counts;
            $post->polls->total_votes = $post->polls->total_votes;
            $post->polls->vote_percentages = $post->polls->vote_percentages;
        }
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
        $posts = Post::with('user', 'polls')->orderBy('created_at', 'desc')->take(5)->get();
        return response()->json(['recent_posts' => $posts], 200);
    }

    // Fetch trending posts

    public function trending()
    {
       
        $user = auth()->user();

        $posts = Post::with('polls.votes.user' ,  'user', 'comments')->withCount('likes')->orderBy('likes_count', 'desc')->take(5)->get()->map(function ($post) use ($user) {
            if ($post->polls) {
                $post->polls->vote_counts = $post->polls->vote_counts;
                $post->polls->total_votes = $post->polls->total_votes;
                $post->polls->vote_percentages = $post->polls->vote_percentages;
            }
            $post->is_liked = $user ? $post->likes()->where('user_id', $user->id)->exists() : false;
            return $post;
        });

        
        if ($posts->isEmpty()) {
            return response()->json(['message' => 'No trending posts found'], 404);
        }
    
        return response()->json(['message' => 'All trending posts retrieved successfully!', 'posts' => $posts ], 200);
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
