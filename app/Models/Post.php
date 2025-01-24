<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'caption', 'hashtags', 'media', 'scheduled_at', 'slug'
    ];

    protected $casts = [
        'hashtags' => 'array', // Automatically casts hashtags to/from JSON
        'media' => 'array',    // Automatically casts media to/from JSON
    ];

    public function polls()
    {
        return $this->hasOne(Poll::class); // One-to-one relationship
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->slug = Str::slug($post->caption, '-') . '-' . uniqid();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
