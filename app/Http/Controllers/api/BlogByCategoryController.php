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

        $categoryId = $request->categoryId;
        $blogs = Blog::where('category_id',$categoryId)->with('category')->get();
        return BlogResource::collection($blogs);
    }

}
