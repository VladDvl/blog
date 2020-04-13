<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChatRequest;
use App\Messages;
use Auth;

class ChatController extends Controller
{
    public function getIndex($slug = null)
    {
        $objs = Messages::with('sender')->where([
            ['resiver_id', '=', $slug],
            ['sender_id', '=', Auth::user()->id],
            ['status', '=', 'PUBLISHED'],
        ])->orWhere([
            ['resiver_id', '=', Auth::user()->id],
            ['sender_id', '=', $slug],
            ['status', '=', 'PUBLISHED'],
        ])->orderBy('id', 'ASC')->get();
        
        return view('chat', compact('objs', 'slug'));
    }

    public function postIndex(ChatRequest $r)
    {
        $r['status'] = 'PUBLISHED';
        $r['sender_id'] = Auth::user()->id;

        if( array_key_exists('resiver_id', $r->input()) and intval($r->input('resiver_id')) != 0 ) {
            $r['resiver_id'] = intval($r->input('resiver_id'));
        } else {
            $r['resiver_id'] = null;
        }
        
        //dd($r);
        Messages::create($r->all());

        return redirect()->back();
    }
}
