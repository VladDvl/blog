<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tags;

class TagController extends Controller
{
    public function getIndex($slug = null)
    {
        $tag = Tags::where('status', 'PUBLISHED')->where('id', $slug)->first();

        $objs = Post::with('userss','comms')
            ->where('tag_id', 'LIKE', '%,'.$slug.',%')
            ->orWhere('tag_id', 'LIKE', $slug.',%')
            ->orWhere('tag_id', 'LIKE', '%,'.$slug)
            ->orWhere('tag_id', 'LIKE', $slug)
            ->orderBy('id','DESC')->paginate(20);

        return view('tag', compact('objs','tag'));
    }
}
