<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CourseResource::collection(Course::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = new Course();

        $course->title = $request->title;
        $course->outline = $request->outline;
        $course->description = $request->description;
        $course->category_id = $request->category_id;
        $course->duration = $request->duration;
        $course->comment_count = $request->comment_count;
        $course->student = $request->student;


        if($request->hasFile('image')){
            $image = $request->image;
            $filename = $image->hashName();
            $image->storeAs('images',$filename);
        }

        $course->image = $filename ?? null;

        $course->save();

        return new CourseResource($course);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CourseResource(Course::findOrFail($id));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        $course->title = $request->title ?? $course->title;
        $course->outline = $request->outline ?? $course->outline;
        $course->description = $request->description ?? $course->description;
        $course->category_id = $request->category_id ?? $course->category_id;
        $course->duration = $request->duration ?? $course->duration;
        $course->student = $request->student ?? $course->student;
        $course->comment_count = $request->comment_count ?? $course->comment_count;

        if($request->hasFile('image')){

            if(file_exists(public_path('images/'.$course->image))){
                unlink(public_path('images/'.$course->image));
            }

            $image = $request->image;
            $filename = $image->hashName();
            $image->storeAs('images',$filename);
        }

        $course->image = $filename ?? $course->image;

        $course->save();

        return new CourseResource($course);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findOrFail($id);


        if(file_exists(public_path('images/'.$course->image))){
            unlink(public_path('images/'.$course->image));
        }

        $course->delete();

        return response()->json([
            'message' => 'Deleted Successfully',
        ]);
    }
}
