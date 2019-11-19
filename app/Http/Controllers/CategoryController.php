<?php

namespace App\Http\Controllers;
use App\Categories;
use App\Post;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getIndex($slug = null)
    {
        $cat = Categories::with('posts')->where('slug', $slug)->first();

        $objs = $cat->posts()->orderBy('id','DESC')->paginate(15);

        //dd($objs);
        return view('category',compact('cat','objs'));
    }
}