<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


use App\Http\Controllers\Api\UserController;

Route::get('/sliders', [UserController::class, 'Slider']);
Route::get('/institute-details', [UserController::class, 'InstituteDetails']);
Route::get('/toppers', [UserController::class, 'getAllCoursesWithStudents']);
Route::get('/courses', [UserController::class, 'Courses']);
Route::get('/college-logos', [UserController::class, 'collegeLogos']);
Route::get('/study-materials', [UserController::class, 'getStudyMaterials']);



