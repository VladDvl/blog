<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Comments;
use Auth;

class profileController extends Controller
{
    public function getIndex($slug = null)
    {
        $thing = User::with('user_posts', 'commss')->where('id',$slug)->first();

        if( $thing != null ) {
            $objs = $thing->user_posts()->paginate(5);
        } else {
            return view('maintext');
        }
        
        //dd($objs);
        return view('profile',compact('thing','objs'));
    }
}