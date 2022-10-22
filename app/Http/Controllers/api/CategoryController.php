<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return CategoryResource::collection($categories);
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
    public function store(CategoryRequest $request)
    {


        $category = new Category;

        $category->name = $request->name;
        $category->parent_id = $request->parent_id ?? null;

        if($request->hasFile('logo')){
            $logo = $request->logo;
            $name = $logo->hashName();
            $logo->storeAs('images',$name);
        }

        $category->logo = $name ?? null;

        $category->save();

        return new CategoryResource($category);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new CategoryResource(Category::findOrFail($id));
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
        $category = Category::findOrFail($id);

        $category->name = $request->name ?? $category->name;
        $category->parent_id = $request->parent_id ?? null;

        if($request->hasFile('logo')){
            if(file_exists(public_path('images/'.$category->logo))){
                unlink(public_path('images/'.$category->logo));
            }

            $logo = $request->logo;
            $name = $logo->hashName();
            $logo->storeAs('images',$name);
        }
        $category->logo = $name ?? null;

        $category->save();

        return new CategoryResource($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if(file_exists(public_path('images/'.$category->logo))){
            unlink(public_path('images/'.$category->logo));
        }

        $category->delete();

        return response()->json([
            'message' => 'Deleted Successfully',
        ]);
    }
}
