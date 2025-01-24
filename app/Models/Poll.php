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
}
