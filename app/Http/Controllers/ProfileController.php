<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use App\User;
use App\Post;
use App\Comments;
use App\groups;
use App\Tags;
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

                    $authors_arr = explode(',', $subscription->author_id);

                } else {

                    $authors_arr = [];

                }

                if( in_array($slug, $authors_arr) ) {

                    $sub_bool = true;
    
                } else {
    
                    $sub_bool = false;
    
                }

            } else {

                $sub_bool = false;

            }

            $user_subs = Subscriptions::where('user_id', $slug)->where('status', 'PUBLISHED')->first();
            if( isset($user_subs) ) {

                $subs_tags_arr = explode(',', $user_subs->tag_id);
                $subs_authors_arr = explode(',', $user_subs->author_id);

                if( $user_subs->tag_id != null ) {

                    $sub_tags = Tags::where('status', 'PUBLISHED')->whereIn('id', $subs_tags_arr)->get();
    
                } else {
    
                    $sub_tags = null;
    
                }
    
                if( $user_subs->author_id != null ) {
    
                    $sub_authors = User::whereIn('id', $subs_authors_arr)->get();
    
                } else {
    
                    $sub_authors = null;
    
                }

            } else {

                $sub_tags = null;
                $sub_authors = null;
            }

            //dd($objs);
            return view('profile',compact('thing','objs','groups','sub_bool','sub_tags','sub_authors'));

        } else {

            return view('profile',compact('thing'));

        }
        
    }
}