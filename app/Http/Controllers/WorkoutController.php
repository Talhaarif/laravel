<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    // Fetch all workouts with sorting
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'desc'); // Sort by new to old
        $workouts = Workout::orderBy('created_at', $sort)->get();
        return response()->json($workouts);
    }

    // Fetch recent workouts
    public function recent()
    {
        $recentWorkouts = Workout::orderBy('created_at', 'desc')->take(5)->get();
        return response()->json($recentWorkouts);
    }

    // Fetch trending workouts
    public function trending()
    {
        $trendingWorkouts = Workout::orderBy('views_count', 'desc')->take(3)->get();
        return response()->json($trendingWorkouts);
    
    }


    public function store(Request $request)
{
    $validatedData = $request->validate([
        'category' => 'required|string|max:255',
        'title' => 'required|string|max:255',
        'image' => 'nullable|url',
        'video' => 'nullable|url',
        'rating' => 'nullable|numeric|min:0|max:5',
        'duration' => 'required|string',
        'description' => 'required|string',
        'overview' => 'required|string',
        'language' => 'required|string|max:255',
        'cal' => 'required|integer',
        'kcal' => 'required|integer',
    ]);

    $workout = Workout::create($validatedData);

    return response()->json(['message' => 'Workout added successfully!', 'workout' => $workout], 201);
}

    // Fetch a single workout

    public function show($slug)
    {
    $workout = Workout::where('slug', $slug)->firstOrFail();
    return response()->json($workout, 200);
    }

    // Update a workout
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'image' => 'nullable|url',
            'video' => 'nullable|url',
            'rating' => 'nullable|numeric|min:0|max:5',
            'duration' => 'required|string',
            'description' => 'required|string',
            'overview' => 'required|string',
            'language' => 'required|string|max:255',
            'cal' => 'required|integer',
            'kcal' => 'required|integer',
        ]);
    
        $workout = Workout::findOrFail($id);
        $workout->update($validatedData);
    
        return response()->json(['message' => 'Workout updated successfully!', 'workout' => $workout], 200);
    }

    // Delete a workout
    public function destroy($id)
    {
        $workout = Workout::findOrFail($id);
        $workout->delete();
        return response()->json(['message' => 'Workout deleted successfully']);
    }
}
