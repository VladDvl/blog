<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tags;
use App\Subscriptions;
use Auth;

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

        foreach($objs as $one)
        {
            $howmany = count( $one->comms );
            $comments = 'comments';
            $one->$comments = $howmany;
        }

        if( Auth::check() ) {

            $subscription = Subscriptions::where('user_id', Auth::user()->id)->first();
            
            if( isset($subscription) ) {

                $tags_arr = explode(',', $subscription->tag_id);

            } else {

                $tags_arr = [];

            }

            if( in_array($slug, $tags_arr) ) {

                $sub_bool = true;

            } else {

                $sub_bool = false;

            }

        } else {
            
            $sub_bool = false;

        }

        return view('tag', compact('objs','tag','sub_bool'));
    }
}
