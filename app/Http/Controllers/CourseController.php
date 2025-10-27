<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;
use App\Models\User;
use App\Models\StudentCourse;

class CourseController extends Controller
{
    public function __construct()
    {
        // Manual auth check
        $this->middleware(function ($request, $next) {
            if (!Auth::check()) {
                abort(403, 'Unauthorized access.');
            }
            return $next($request);
        });
    }

    /**
     * Display a listing of the courses.
     */
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_course' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/courses', 'public');
        }

        Course::create([
            'name' => $request->name,
            'short_course' => $request->short_course,
            'image' => $imagePath,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course added successfully.');
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'short_course' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = $course->image; // keep existing image

        // Replace image if a new one is uploaded
        if ($request->hasFile('image')) {
            if ($course->image && Storage::disk('public')->exists($course->image)) {
                Storage::disk('public')->delete($course->image);
            }
            $imagePath = $request->file('image')->store('images/courses', 'public');
        }

        $course->update([
            'name' => $request->name,
            'short_course' => $request->short_course,
            'image' => $imagePath,
        ]);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {
        if ($course->image && Storage::disk('public')->exists($course->image)) {
            Storage::disk('public')->delete($course->image);
        }

        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }


    public function assignForm()
{
    $students = User::all();
    $courses = Course::all();

    return view('courses.assign_course', compact('students', 'courses'));
}

public function assignCourses(Request $request)
{
    $request->validate([
        'student_id' => 'required|exists:users,id',
        'course_ids' => 'required|array',
        'course_ids.*' => 'exists:courses,id',
    ]);

    $student = User::findOrFail($request->student_id);

    // ✅ Sync multiple courses correctly
    $student->courses()->sync($request->course_ids);

    return back()->with('success', 'Courses assigned successfully!');
}


}
