<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Tags;

class TagsShowController extends Controller
{
    public function getIndex()
    {
        $tags = Tags::where('status', 'PUBLISHED')->get();

        if( count($tags) != 0 ) {

            foreach( $tags as $tag )
            {
                $howmany = "posts";
                $num_posts = count( explode(',', $tag->post_id) );
                $tag->$howmany = $num_posts;
            }
    
            $tags_ids = $tags->sortByDesc('posts')->pluck('id')->all();
    
            $all_tags = Tags::orderByRaw( "FIELD(id, " . implode(',', $tags_ids) . " )" )->paginate(100);

        } else {

            $all_tags = null;

        }

        return view('all-tags', compact('all_tags'));
    }
}
