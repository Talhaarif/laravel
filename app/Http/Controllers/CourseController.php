<?php
namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRating;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json(['message' => 'Courses retrieved successfully!', 'courses' => $courses], 200);
    }

    public function show($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $course->increment('views_count');
        return response()->json(['message' => 'Course retrieved successfully!', 'course' => $course], 200);
    }

    public function edit($id)
{
    $course = Course::findOrFail($id);
    return response()->json(['message' => 'Course retrieved successfully!', 'course' => $course], 200);
}

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'image' => 'required|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'duration' => 'required|string',
            'description' => 'required|string',
            'overview' => 'required|string',
            'admin_name' => 'required|string|max:255',
            'admin_role' => 'required|string|max:255',
            'admin_image' => 'required|string',
            'language' => 'required|string|max:255',
            'modules' => 'required|integer',
        ]);

        $course = Course::create($validated);

        return response()->json(['message' => 'Course added successfully!', 'course' => $course], 201);
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $validated = $request->validate([
            'category' => 'sometimes|string|max:255',
            'title' => 'sometimes|string|max:255',
            'image' => 'sometimes|string',
            'rating' => 'nullable|numeric|min:0|max:5',
            'duration' => 'sometimes|string',
            'description' => 'sometimes|string',
            'overview' => 'sometimes|string',
            'admin_name' => 'sometimes|string|max:255',
            'admin_role' => 'sometimes|string|max:255',
            'admin_image' => 'sometimes|string',
            'language' => 'sometimes|string|max:255',
            'modules' => 'sometimes|integer',
        ]);

        $course->update($validated);

        return response()->json(['message' => 'Course updated successfully!', 'course' => $course], 200);
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();

        return response()->json(['message' => 'Course deleted successfully!'], 200);
    }

    public function recent()
    {
        $recentCourses = Course::orderBy('created_at', 'desc')->take(10)->get();
        return response()->json(['message' => 'Recent courses retrieved successfully!', 'courses' => $recentCourses], 200);
    }

    public function popular()
    {
        $popularCourses = Course::withCount('ratings')
            ->orderBy('ratings_count', 'desc')
            ->take(10)
            ->get();
        return response()->json(['message' => 'Popular courses retrieved successfully!', 'courses' => $popularCourses], 200);
    }

    public function rate(Request $request, $id)
    {
        $validated = $request->validate(['rating' => 'required|integer|min:1|max:5']);

        $rating = CourseRating::updateOrCreate(
            ['course_id' => $id, 'user_id' => auth()->id()],
            ['rating' => $validated['rating']]
        );

        return response()->json(['message' => 'Rating submitted successfully!', 'rating' => $rating], 201);
    }


    public function trending()
{
    $trendingCourses = Course::orderBy('views_count', 'desc')->take(3)->get();

    return response()->json($trendingCourses, 200);
}

}
