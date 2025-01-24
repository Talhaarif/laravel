<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;

class PollController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'question' => 'required|string|max:255',
            'options' => 'required|array|min:2|max:5', // 2-5 poll options
            'options.*' => 'string|max:255',
            'anonymous' => 'boolean',
        ]);

        $poll = Poll::create([
            'post_id' => $request->post_id,
            'question' => $request->question,
            'options' => $request->options,
            'anonymous' => $request->anonymous ?? false,
        ]);

        return response()->json(['message' => 'Poll created successfully!', 'poll' => $poll], 201);
    }
}
