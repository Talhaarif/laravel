<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use App\Models\PollVote;

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


    public function vote(Request $request, $pollId)
    {
        $request->validate([
            'option' => 'required|string',
        ]);

        $poll = Poll::findOrFail($pollId);

        // Prevent user from voting multiple times
        $existingVote = PollVote::where('user_id', Auth::id())->where('poll_id', $pollId)->first();
        if ($existingVote) {
            return response()->json(['message' => 'You have already voted in this poll!'], 400);
        }

        // Store the vote
        $vote = PollVote::create([
            'user_id' => Auth::id(),
            'poll_id' => $pollId,
            'option' => $request->option,
        ]);

        return response()->json(['message' => 'Vote submitted successfully!', 'vote' => $vote], 201);
    }

}
