<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App\Post;
use App\Comments;
use App\groups;
use Auth;

class profileController extends Controller
{
    public function getIndex($slug = null)
    {
        $thing = User::with('user_posts', 'commss')->where('id',$slug)->first();

        if( $thing != null ) {

            $objs = $thing->user_posts()->paginate(5);

            $groups = groups::with('group_creator')->with('partitipantss')->with('messagee')->where('status', 'PUBLISHED')->where('type', 'public')
                ->whereHas('partitipantss', function (Builder $query) use ($slug) {
                    $query->where('user_id', '=', $slug)->where('status', 'active');
                })->get();

        } else {

            return view('maintext');

        }
        
        //dd($objs);
        return view('profile',compact('thing','objs','groups'));
    }
}