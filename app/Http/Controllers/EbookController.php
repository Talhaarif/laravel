<?php

namespace App\Http\Controllers;

use App\Models\Ebook;
use Illuminate\Http\Request;

class EbookController extends Controller
{



    public function index()
{
    // Fetch all eBooks
    $ebooks = Ebook::all();

    // Return response
    return response()->json([
        'message' => 'Ebooks retrieved successfully!',
        'ebooks' => $ebooks,
    ], 200);
}


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|url',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'release_date' => 'required|date',
            'categories' => 'required|array',
            'number_of_pages' => 'required|integer',
            'language' => 'required|string|max:50',
            'rating' => 'nullable|numeric|min:0|max:5',
            'overview' => 'required|string',
            'instructor_name' => 'required|string|max:255',
            'instructor_bio' => 'required|string',
            'instructor_profile_image' => 'nullable|url',
        ]);

        $ebook = Ebook::create($validatedData);

        return response()->json([
            'message' => 'Ebook added successfully',
            'ebook' => $ebook,
        ], 201);
    }


    public function update(Request $request, $id)
{
    // Validate the request
    $validatedData = $request->validate([
        'image' => 'nullable|url',
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'release_date' => 'required|date',
        'categories' => 'required|array',
        'number_of_pages' => 'required|integer',
        'language' => 'required|string|max:50',
        'rating' => 'nullable|numeric|min:0|max:5',
        'overview' => 'required|string',
        'instructor_name' => 'required|string|max:255',
        'instructor_bio' => 'required|string',
        'instructor_profile_image' => 'nullable|url',
    ]);

    // Find the ebook by ID
    $ebook = Ebook::find($id);
    if (!$ebook) {
        return response()->json(['message' => 'Ebook not found'], 404);
    }

    // Update the ebook
    $ebook->update($validatedData);

    return response()->json([
        'message' => 'Ebook updated successfully',
        'ebook' => $ebook,
    ], 200);
}


public function destroy($id)
{
    // Find the ebook by ID
    $ebook = Ebook::find($id);
    if (!$ebook) {
        return response()->json(['message' => 'Ebook not found'], 404);
    }

    // Delete the ebook
    $ebook->delete();

    return response()->json([
        'message' => 'Ebook deleted successfully',
    ], 200);
}


public function show($slug)
{
    $ebook = Ebook::where('slug', $slug)->firstOrFail();
    $ebook->increment('views_count');
    return response()->json([
        'message' => 'Ebook retrieved successfully!',
        'ebook' => $ebook,
    ], 200);
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



public function trending()
{
    $trendingEbooks = Ebook::orderBy('views_count', 'desc')->take(3)->get();

    return response()->json($trendingEbooks, 200);
}


}
