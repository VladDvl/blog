<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App\Post;
use App\Comments;
use App\groups;
use App\Subscriptions;
use Auth;

class profileController extends Controller
{
    public function getIndex( $slug = null )
    {
        ( is_numeric($slug) ) ? $slug : $slug = null;
        
        $thing = User::with('user_posts', 'commss')->where('id', $slug)->first();

        if( $thing != null ) {

            $objs = $thing->user_posts()->paginate(5);

            $groups = groups::with('group_creator')->with('partitipantss')->with('messagee')->where('status', 'PUBLISHED')->where('type', 'public')
                ->whereHas('partitipantss', function (Builder $query) use ($slug) {
                    $query->where('user_id', '=', $slug)->where('status', 'active');
                })->get();


            if( Auth::check() and Auth::user()->id != $slug ) {

                $subscription = Subscriptions::where('user_id', Auth::user()->id)->first();
                
                if( isset($subscription) ) {

                    $tags_arr = explode(',', $subscription->author_id);

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


            //dd($objs);
            return view('profile',compact('thing','objs','groups','sub_bool'));

        } else {

            return view('profile',compact('thing'));

        }
        
    }
}