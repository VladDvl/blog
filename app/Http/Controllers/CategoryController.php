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
        //$objs = $cat->posts()->orderBy('id','DESC')->paginate(15);

        $objs = Post::with('userss','comms')->where('category_id', $cat->id)->orderBy('id','DESC')->paginate(15);

        foreach($objs as $one)
        {
            $howmany = count( $one->comms );
            $comments = 'comments';
            $one->$comments = $howmany;
        }

        if( count($objs) != 0 ) {
            return view('category',compact('cat','objs'));
        } else {
            return view('no-category',compact('cat'));
        }
    }
}