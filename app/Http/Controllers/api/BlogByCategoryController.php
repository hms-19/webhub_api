<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BlogResource;
use App\Http\Resources\CategoryResource;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;

class BlogByCategoryController extends Controller
{
    public function index(Request $request){

        $categorySlug = $request->categorySlug;

        $blogs = Blog::whereHas('category', function ($query) use ($categorySlug){
            $query->where('slug',$categorySlug);
        })->with('category')->get();

        return BlogResource::collection($blogs);
    }

}
