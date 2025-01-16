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
        'admin_name' => 'required|string|max:255',
        'admin_role' => 'required|string|max:255',
        'admin_image' => 'nullable|url',
    ]);

    $article = Article::create($validatedData);

    return response()->json(['message' => 'Article added successfully', 'article' => $article], 201);
}


    public function index(Request $request)
    {
        $sortOrder = $request->query('sort', 'desc'); // Default to descending order (newest first)
        $articles = Article::orderBy('created_at', $sortOrder)->paginate(10);

        return response()->json(['articles' => $articles], 200);
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        $article->increment('views'); // Increment views on article click

        return response()->json(['article' => $article], 200);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required',
            'image' => 'nullable|url',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        $article = Article::findOrFail($id);
        $article->update($validatedData);

        return response()->json(['message' => 'Article updated successfully', 'article' => $article], 200);
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
