<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\MealRating;
use Illuminate\Http\Request;

class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::all();
        return response()->json(['message' => 'Meals retrieved successfully!', 'meals' => $meals], 200);
    }

    public function show($slug)
    {
        $meal = Meal::where('slug', $slug)->firstOrFail();
        // Increment views_count
        $meal->increment('views_count');
        return response()->json(['message' => 'Meal retrieved successfully!', 'meal' => $meal], 200);
    }

    public function edit($id)
{
    $meal = Meal::findOrFail($id);
    return response()->json(['message' => 'Meal retrieved successfully!', 'meal' => $meal], 200);
}


    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string',
            'title' => 'required|string|max:255',
            'image' => 'required|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'duration' => 'required|string',
            'description' => 'required|string',
            'overview' => 'required|string',
            'language' => 'required|string',
            'modules' => 'required|integer',
            'admin_name' => 'required|string',
            'admin_role' => 'required|string',
            'admin_image' => 'required|string',
        ]);

        $meal = Meal::create($validated);

        return response()->json(['message' => 'Meal added successfully!', 'meal' => $meal], 201);
    }

    public function update(Request $request, $id)
    {
        $meal = Meal::findOrFail($id);

        $validated = $request->validate([
            'category' => 'sometimes|string',
            'title' => 'sometimes|string|max:255',
            'image' => 'sometimes|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'duration' => 'sometimes|string',
            'description' => 'sometimes|string',
            'overview' => 'sometimes|string',
            'language' => 'sometimes|string',
            'modules' => 'sometimes|integer',
            'admin_name' => 'sometimes|string',
            'admin_role' => 'sometimes|string',
            'admin_image' => 'sometimes|string',
        ]);

        $meal->update($validated);

        return response()->json(['message' => 'Meal updated successfully!', 'meal' => $meal], 200);
    }

    public function destroy($id)
    {
        $meal = Meal::findOrFail($id);
        $meal->delete();

        return response()->json(['message' => 'Meal deleted successfully!'], 200);
    }

    public function recent()
    {
        $recentMeals = Meal::orderBy('created_at', 'desc')->take(10)->get();
        return response()->json(['message' => 'Recent meals retrieved successfully!', 'meals' => $recentMeals], 200);
    }

    public function popular()
    {
        $popularMeals = Meal::withCount('ratings')
            ->orderBy('ratings_count', 'desc')
            ->take(10)
            ->get();

        return response()->json(['message' => 'Popular meals retrieved successfully!', 'meals' => $popularMeals], 200);
    }

    public function rate(Request $request, $id)
    {
        $validated = $request->validate(['rating' => 'required|integer|min:1|max:5']);

        $rating = MealRating::updateOrCreate(
            ['meal_id' => $id, 'user_id' => auth()->id()],
            ['rating' => $validated['rating']]
        );

        return response()->json(['message' => 'Rating submitted successfully!', 'rating' => $rating], 201);
    }

    public function trending()
{
    $trendingMeals = Meal::orderBy('views_count', 'desc')
        ->take(3)
        ->get();

    return response()->json($trendingMeals, 200);
}

}

