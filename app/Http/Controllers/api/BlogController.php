<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BlogResource::collection(Blog::all());
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
    public function store(BlogRequest $request)
    {
        $blog = new Blog();

        $blog->title = $request->title;
        $blog->description = $request->description ?? null;
        $blog->category_id = $request->category_id;
        $blog->duration = $request->duration;


        if($request->hasFile('image')){
            $image = $request->image;
            $filename = $image->hashName();
            $image->storeAs('images',$filename);
        }

        $blog->image = $filename ?? null;

        $blog->save();

        return new BlogResource($blog);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new BlogResource(Blog::findOrFail($id));
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
        $blog = Blog::findorFail($id);

        $blog->title = $request->title ?? $blog->title;
        $blog->description = $request->description ?? $blog->description;
        $blog->category_id = $request->category_id ?? $blog->category_id;
        $blog->duration = $request->duration ?? $blog->duration;

        if($request->hasFile('image')){

            if(file_exists(public_path('images/'.$blog->image))){
                if($blog->image){
                    unlink(public_path('images/'.$blog->image));
                }
            }

            $image = $request->image;
            $filename = $image->hashName();
            $image->storeAs('images',$filename);
        }

        $blog->image = $filename ?? $blog->image;

        $blog->save();

        return new BlogResource($blog);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);


        if(file_exists(public_path('images/'.$blog->image))){
            if($blog->image){
                unlink(public_path('images/'.$blog->image));
            }
        }

        $blog->delete();

        return response()->json([
            'message' => 'Deleted Successfully',
        ]);
    }
}
