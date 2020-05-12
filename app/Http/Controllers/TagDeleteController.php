<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tags;
use App\Post;

class TagDeleteController extends Controller
{
    public function deleteTag()
    {
        $tag_id = $_POST['delete'];
        $post_id = $_POST['post_id'];

        $tag = Tags::where('id', $tag_id)->first();
        $arr_post_id = explode(',', $tag->post_id);

        $post = Post::where('id', $post_id)->first();
        $arr_tag_id = explode(',', $post->tag_id);
        unset($arr_tag_id[array_search($tag_id, $arr_tag_id)]);
        $str_tag_id = implode(',', $arr_tag_id);

        if(count($arr_tag_id) == 0) {

            $post->tag_id = null;

        } else {

            $post->tag_id = $str_tag_id;

        }
        
        $post->save();
        
        if( count($arr_post_id) == 1 ) {

            $tag->delete();

        } else {

            $new_arr_post_id = array_diff($arr_post_id, [$post_id]);
            $post_id_str = implode(',', $new_arr_post_id);

            $tag->post_id = $post_id_str;

            $tag->save();

        }

        return redirect()->back();
    }
}
