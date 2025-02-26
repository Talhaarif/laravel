<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'question', 'options', 'anonymous'];

    protected $casts = [
        'options' => 'array', // Automatically casts options to/from JSON
    ];

    public function post()
    {
        return $this->belongsTo(Post::class); // Belongs to one post
    }


    
    public function votes()
    {
        return $this->hasMany(PollVote::class);
    }

    // Get vote counts per option
    public function getVoteCountsAttribute()
    {
        return $this->votes()
            ->selectRaw('option, COUNT(*) as count')
            ->groupBy('option')
            ->pluck('count', 'option');
    }

    // Total votes in the poll
    public function getTotalVotesAttribute()
    {
        return $this->votes()->count();
    }

    public function getVotePercentagesAttribute()
    {
        $totalVotes = $this->votes()->count();
        $voteCounts = $this->votes()
            ->selectRaw('option, COUNT(*) as count')
            ->groupBy('option')
            ->pluck('count', 'option')
            ->toArray();

        $percentages = [];
        foreach ($this->options as $option) {
            $count = $voteCounts[$option] ?? 0;
            $percentages[$option] = $totalVotes > 0 ? round(($count / $totalVotes) * 100, 2) : 0;
        }

        return $percentages;
    }


    public function voters()
{
    return $this->hasManyThrough(User::class, PollVote::class, 'poll_id', 'id', 'id', 'user_id');
}

// Get random profile images of voters (e.g., 10 random images)
public function getRandomVotersProfileImagesAttribute()
{
    return $this->voters()
                ->whereNotNull('profile_image')
                ->inRandomOrder()
                ->take(10)
                ->pluck('profile_image')
                ->toArray();
}


}
