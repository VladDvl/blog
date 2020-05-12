<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Tags;
use App\Post;

class TagCreateController extends Controller
{
    public function createTag(TagRequest $r)
    {
        $tags = Tags::get();
        $post = Post::where('id', $r["post_id"])->first();
        
        if( isset($tags) ) {

            $tag_names = $tags->pluck('name')->all();

        } else {
            
            $tag_names = [];

        }

        if( in_array($r['name'], $tag_names) ) {

            $tag = $tags->where('name', $r['name'])->first();

            $arr_post_id = explode(',', $tag->post_id);

            if( !in_array($r['post_id'], $arr_post_id) ) {

                $tag->post_id .= ',' . $r['post_id'];

                $tag->save();

                $tag_id = $tag->id;

                if($post->tag_id == null) {
                    $post->tag_id = $tag_id;
                } else {
                    $post->tag_id .= ',' . $tag_id;
                }
    
                $post->save();

            } else {

                return redirect()->back();

            }

        } else {

            $r['status'] = 'PUBLISHED';

            //dd($r);
            $tag = Tags::create($r->all());

            $tag_id = $tag->id;

            if($post->tag_id == null) {
                $post->tag_id = $tag_id;
            } else {
                $post->tag_id .= ',' . $tag_id;
            }

            $post->save();

        }

        return redirect()->back();
    }
}
