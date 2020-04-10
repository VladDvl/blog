<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Messages;
use Auth;

class ChatController extends Controller
{
    public function getIndex($slug = null)
    {
        $objs = Messages::with('sender')->where([
            ['resiver_id', '=', $slug],
            ['sender_id', '=', Auth::user()->id],
        ])->orWhere([
            ['resiver_id', '=', Auth::user()->id],
            ['sender_id', '=', $slug],
        ])->orderBy('id', 'ASC')->get();
        
        return view('chat', compact('objs'));
    }

    public function postMessage()
    {
        //
    }
}
