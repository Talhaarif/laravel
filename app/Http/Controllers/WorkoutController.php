<?php

namespace App\Http\Controllers;

use App\Models\Workout;
use Illuminate\Http\Request;

class WorkoutController extends Controller
{
    // Fetch all workouts with sorting
    public function index()
    {
        // Fetch all workouts
        $workouts = Workout::all();
    
        // Return response
        return response()->json([
            'message' => 'Workouts retrieved successfully!',
            'workouts' => $workouts,
        ], 200);
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

    // Fetch a single workout
    public function edit($id)
    {
        $workout = Workout::where('id', $id)->firstOrFail();
        return response()->json(['message' => 'Workout retrieved successfully!', 'workout' => $workout], 200);
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
