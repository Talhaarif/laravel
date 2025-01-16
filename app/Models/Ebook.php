<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'title',
        'slug',
        'author',
        'release_date',
        'categories',
        'number_of_pages',
        'language',
        'rating',
        'overview',
        'instructor_name',
        'instructor_bio',
        'instructor_profile_image',
    ];

    protected $casts = [
        'categories' => 'array', // Cast categories JSON to array
    ];


    public static function boot()
    {
        parent::boot();

        static::creating(function ($ebook) {
            $ebook->slug = Str::slug($ebook->title);
        });

        static::updating(function ($ebook) {
            $ebook->slug = Str::slug($ebook->title);
        });
    }



    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }


    public function recent()
{
    $recentEbooks = Ebook::orderBy('created_at', 'desc')->take(10)->get();
    return response()->json([
        'message' => 'Recent ebooks retrieved successfully!',
        'ebooks' => $recentEbooks,
    ], 200);
}


public function popular()
{
    $popularEbooks = Ebook::withCount('ratings')
        ->orderBy('ratings_count', 'desc')
        ->take(10)
        ->get();
    return response()->json([
        'message' => 'Popular ebooks retrieved successfully!',
        'ebooks' => $popularEbooks,
    ], 200);
}

public function rate(Request $request, $id)
{
    $validated = $request->validate([
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $rating = Rating::updateOrCreate(
        ['ebook_id' => $id, 'user_id' => auth()->id()],
        ['rating' => $validated['rating']]
    );

    return response()->json([
        'message' => 'Rating submitted successfully!',
        'rating' => $rating,
    ], 201);
}


}
