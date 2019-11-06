<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{
    public function getIndex($slug = null)
    {
        $one = Post::where('slug',$slug)->first();
        return view('post',compact('one'));
    }
}
