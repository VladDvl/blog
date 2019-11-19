<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{
    protected function postLoads($id)
    {
        $obj = Post::find($id);
        $obj->loads = $obj->loads+1;
        $obj->save();
    }

    public function getIndex($slug = null)
    {
        $one = Post::with('userss','category')->where('slug',$slug)->first();

        $id = $one->id;
        $postLoads = $this->postLoads($id);
        
        return view('post',compact('one'));
    }
}