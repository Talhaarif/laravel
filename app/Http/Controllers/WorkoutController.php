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

    // Store a new workout
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|url',
            'video' => 'nullable|url',
            'category' => 'required|string|max:255',
            'cal' => 'required|string',
            'duration' => 'required|string',
            'overview' => 'required|string',
            'kcal' => 'required|string',
        ]);

        $workout = Workout::create($validatedData);
        return response()->json(['message' => 'Workout added successfully', 'workout' => $workout], 201);
    }

    // Show workout details and increment views count
    public function show($id)
    {
        $workout = Workout::findOrFail($id);
        $workout->increment('views_count'); // Increment views count
        return response()->json($workout);
    }

    // Update a workout
    public function update(Request $request, $id)
    {
        $workout = Workout::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|url',
            'video' => 'nullable|url',
            'category' => 'required|string|max:255',
            'cal' => 'required|string',
            'duration' => 'required|string',
            'overview' => 'required|string',
            'kcal' => 'required|string',
        ]);

        $workout->update($validatedData);
        return response()->json(['message' => 'Workout updated successfully', 'workout' => $workout]);
    }

    // Delete a workout
    public function destroy($id)
    {
        $workout = Workout::findOrFail($id);
        $workout->delete();
        return response()->json(['message' => 'Workout deleted successfully']);
    }
}
