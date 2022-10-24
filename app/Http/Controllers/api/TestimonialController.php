<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialResource;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TestimonialResource::collection(Testimonial::all());
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
        $testimonial = new Testimonial();

        $testimonial->name = $request->name;
        $testimonial->field = $request->field;
        $testimonial->comment = $request->comment;
        $testimonial->rate = $request->rate;


        if($request->hasFile('image')){
            $image = $request->image;
            $filename = $image->hashName();
            $image->storeAs('images',$filename);
        }

        $testimonial->image = $filename ?? null;

        $testimonial->save();

        return new TestimonialResource($testimonial);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new TestimonialResource(Testimonial::findOrFail($id));

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
        $testimonial = Testimonial::find($id);

        $testimonial->name = $request->name ?? $testimonial->name;
        $testimonial->field = $request->field ?? $testimonial->field;
        $testimonial->comment = $request->comment ?? $testimonial->comment;
        $testimonial->rate = $request->rate ?? $testimonial->rate;

        if($request->hasFile('image')){

            if(file_exists(public_path('images/'.$testimonial->image))){
                if($testimonial->image){
                    unlink(public_path('images/'.$testimonial->image));
                }
            }

            $image = $request->image;
            $filename = $image->hashName();
            $image->storeAs('images',$filename);
        }

        $testimonial->image = $filename ?? $testimonial->image;

        $testimonial->save();

        return new TestimonialResource($testimonial);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);


        if(file_exists(public_path('images/'.$testimonial->image))){
            if($testimonial->image){
                unlink(public_path('images/'.$testimonial->image));
            }
        }

        $testimonial->delete();

        return response()->json([
            'message' => 'Deleted Successfully',
        ]);
    }
}
