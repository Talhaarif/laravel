<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{



public function store(Request $request)
{
    $validatedData = $request->validate([
        'category' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'image' => 'nullable|url',
        'rating' => 'nullable|numeric|min:0|max:5',
        'duration' => 'nullable|string',
        'description' => 'required|string',
        'overview' => 'required|string',
        'language' => 'required|string|max:255',
        'modules' => 'nullable|integer',
        'admin_name' => 'required|string|max:255',
        'admin_role' => 'required|string|max:255',
        'admin_image' => 'nullable|url',
    ]);

    $article = Article::create($validatedData);

    return response()->json(['message' => 'Article added successfully!', 'article' => $article], 201);
}


public function index()
{
    // Fetch all Articles
    $articles = Article::all();

    // Return response
    return response()->json([
        'message' => 'Articles retrieved successfully!',
        'articles' => $articles,
    ], 200);
}


    public function show($slug)
    {
    $article = Article::where('slug', $slug)->firstOrFail();
    return response()->json($article, 200);
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'category' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'image' => 'nullable|url',
        'rating' => 'nullable|numeric|min:0|max:5',
        'duration' => 'nullable|string',
        'description' => 'required|string',
        'overview' => 'required|string',
        'language' => 'required|string|max:255',
        'admin_name' => 'required|string|max:255',
        'admin_role' => 'required|string|max:255',
        'admin_image' => 'nullable|url',
    ]);

    $article = Article::findOrFail($id);
    $article->update($validatedData);

    return response()->json(['message' => 'Article updated successfully!', 'article' => $article], 200);
}

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json(['message' => 'Article deleted successfully'], 200);
    }

    public function trending()
    {
        $trendingArticles = Article::orderBy('views', 'desc')->take(3)->get();

        return response()->json(['trending_articles' => $trendingArticles], 200);
    }

    public function best()
    {
        $bestArticles = Article::orderBy('rating', 'desc')->take(3)->get();

        return response()->json(['best_articles' => $bestArticles], 200);
    }

    public function recent()
    {
        $recentArticles = Article::orderBy('created_at', 'desc')->take(3)->get();

        return response()->json(['recent_articles' => $recentArticles], 200);
    }
}
