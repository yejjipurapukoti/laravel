<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\SliderImage;
use App\Models\Institute;
use Illuminate\Support\Facades\Storage;
use App\Http\Models\StudentCourse;
use App\Models\Course;
use App\Models\CollegeLog;
use App\Models\StudyMaterial;



class UserController extends Controller
{
   
  public function Slider()
    {
        $sliders = SliderImage::active()
            ->orderBy('order_index', 'asc')
            ->get(['id', 'title', 'image_path', 'order_index', 'status']);

        
        $sliders->transform(function ($slider) {
            $slider->image_url = asset('storage/' . $slider->image_path);
            return $slider;
        });

        return response()->json([
            'status' => true,
            'message' => 'Slider images fetched successfully.',
            'data' => $sliders
        ]);
    }


    public function InstituteDetails()
    {
        $institute = Institute::all(['description', 'number_of_students']);

        if (!$institute) {
            return response()->json([
                'status' => false,
                'message' => 'Institute details not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Institute details fetched successfully.',
            'data' => $institute
        ]);
    }



  public function getAllCoursesWithStudents()
{
    $courses = Course::with([
        'students:id,name,image' 
    ])->get(['id', 'name', 'short_course']); 

   
    $courses->each(function ($course) {
        $course->students->each(function ($student) {
            $student->image_url = $student->image
                ? asset('storage/' . $student->image)
                : asset('images/default.png'); 
        });
    });

    return response()->json([
        'status' => true,
        'message' => 'All courses with their students fetched successfully.',
        'data' => $courses
    ]);
}


// public function Courses()
// {
//     $courses = Course::all();
//     return response()->json($courses);

// }



public function Courses()
{
    $courses = Course::select('id', 'name', 'short_course', 'image')->get();

    $courses->transform(function ($course) {
        $course->image_url = $course->image
            ? asset('storage/' . $course->image)   
            : asset('images/default-course.png');   
        return $course;
    });

    return response()->json([
        'status' => true,
        'message' => 'Courses fetched successfully.',
        'data' => $courses
    ]);
}




public function collegeLogos()
{
    $logos = CollegeLog::select('id', 'name', 'image', 'description')->get();

    // Generate full image URL for each logo
    $logos->transform(function ($logo) {
        $logo->image_url = $logo->image
            ? asset('storage/' . $logo->image)  // assuming stored in storage/app/public
            : asset('images/default-college.png'); // fallback image
        return $logo;
    });

    return response()->json([
        'status' => true,
        'message' => 'College logos fetched successfully.',
        'data' => $logos
    ]);
}



public function getStudyMaterials()
{
    $materials = StudyMaterial::select('id', 'title', 'exam_type', 'file_path', 'link', 'status')
        ->where('status', 'active') 
        ->get();

   
    $materials->transform(function ($item) {
        $item->file_url = $item->file_path
            ? asset('storage/' . $item->file_path)
            : null;

        $item->external_link = $item->link ?? null;

        return $item;
    });

    return response()->json([
        'status' => true,
        'message' => 'Study materials fetched successfully.',
        'data' => $materials
    ]);
}



}
