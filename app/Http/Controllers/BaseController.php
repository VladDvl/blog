<?php

namespace App\Http\Controllers;

use App\Post;

class BaseController extends Controller
{
	public function getIndex()
    {
        $objs = Post::orderBy('id','DESC')->paginate(6);
        $things = Post::orderBy('id','DESC')->limit(2)->get();
        return view('welcome',compact('objs','things'));
    }
}
