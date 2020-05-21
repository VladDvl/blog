<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tags;
use App\Subscriptions;
use Auth;

class FeedController extends Controller
{
    public function getIndex()
    {
        $subscription = Subscriptions::where('user_id', Auth::user()->id)->where('status', 'PUBLISHED')->first();
        $posts = null;

        if( isset($subscription) ) {

            $sub_authors_arr = explode(',', $subscription->author_id);
            $sub_tags_arr = explode(',', $subscription->tag_id);

            $all_posts = Post::with('comms')->where('status', 'PUBLISHED')->orderBy('created_at', 'desc')->get();
            foreach($all_posts as $one)
            {
                $howmany = count( $one->comms );
                $comments = 'comments';
                $one->$comments = $howmany;
            }

            if( !($subscription->author_id == null and $subscription->tag_id == null) ) {

                $post_ids = [];

                foreach( $all_posts as $post )
                {

                    if( in_array($post->author_id, $sub_authors_arr) ) {

                        $post_ids[] = $post->id;

                    }

                    $post_tags = explode(',', $post->tag_id);

                    $result = array_intersect($sub_tags_arr, $post_tags);

                    if( !empty($result) ) {

                        $post_ids[] = $post->id;

                    }

                }

                $new_post_ids = array_unique($post_ids);

                $posts = $all_posts->whereIn('id', $new_post_ids)->paginate(10);

                return view('feed', compact('posts'));

            } else {

                return view('feed', compact('posts'));

            }

        } else {

            return view('feed', compact('posts'));

        }

    }
}
