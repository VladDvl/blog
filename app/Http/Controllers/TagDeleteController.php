<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tags;

class TagDeleteController extends Controller
{
    public function deleteTag()
    {
        $tag_id = $_POST['delete'];
        $post_id = $_POST['post_id'];

        $tag = Tags::where('id', $tag_id)->first();
        $arr_post_id = explode(',', $tag->post_id);
        
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
