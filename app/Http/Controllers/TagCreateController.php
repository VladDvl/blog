<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TagRequest;
use App\Tags;

class TagCreateController extends Controller
{
    public function createTag(TagRequest $r)
    {
        $tags = Tags::get();
        
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

            } else {

                return redirect()->back();

            }

        } else {

            $r['status'] = 'PUBLISHED';

            //dd($r);
            Tags::insert([
                'name' => $r['name'],
                'post_id' => $r['post_id'],
                'status' => $r['status'],
            ]);

        }

        return redirect()->back();
    }
}
