<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // Store a Comment
    public function store(Request $request, $postId)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $post = Post::findOrFail($postId);

        $comment = $post->comments()->create([
            'user_id' => Auth::id(),
            'comment' => $request->comment,
        ]);

        return response()->json(['message' => 'Comment added successfully!', 'comment' => $comment], 201);
    }

    // Fetch Comments for a Post
    public function index($postId)
    {
        $post = Post::with('comments.user')->findOrFail($postId);

        return response()->json(['message' => 'Comments retrieved successfully!', 'comments' => $post->comments], 200);
    }

    // Delete a Comment
    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if ($comment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully'], 200);
    }
}
