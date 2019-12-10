<?php

namespace App\Http\Controllers;

use App\Post;

class BaseController extends Controller
{
	public function getIndex()
    {
        $objs = Post::with('userss','category','comms')->orderBy('id','DESC')->paginate(6);

        foreach($objs as $one)
        {
            $howmany = count( $one->comms );
            $comments = 'comments';
            $one->$comments = $howmany;
        }

        $things = Post::orderBy('id','DESC')->limit(2)->get();
        return view('welcome',compact('objs','things'));
    }
}
