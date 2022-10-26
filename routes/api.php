<?php

use App\Http\Controllers\api\BlogByCategoryController;
use App\Http\Controllers\api\BlogController;
use App\Http\Controllers\api\CategoryController;
use App\Http\Controllers\api\ContactController;
use App\Http\Controllers\api\CourseController;
use App\Http\Controllers\api\ServiceController;
use App\Http\Controllers\api\TestimonialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('categories', CategoryController::class);
Route::apiResource('services', ServiceController::class);
Route::apiResource('blogs', BlogController::class);
Route::apiResource('testimonials', TestimonialController::class);
Route::apiResource('courses', CourseController::class);
Route::post('/contactus',[ContactController::class,'contactMessage']);
Route::get('/blogsbycategory',[BlogByCategoryController::class,'index']);
Route::get('/categories',[CategoryController::class,'categoriesList']);
