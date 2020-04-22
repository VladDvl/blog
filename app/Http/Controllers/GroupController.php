<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use App\Http\Requests\GroupRequest;
use App\Http\Requests\ChatRequest;
use App\Http\Requests\PartitipantRequest;
use App\Messages;
use App\groups;
use App\partitipants;
use Auth;

class GroupController extends Controller
{
    public function getIndex($slug = null)
    {
        $obj = groups::with('messagee')->with('group_creator')->with('partitipantss')->whereHas('partitipantss', function (Builder $query) {
            $query->where('user_id', '=', Auth::user()->id);
        })->where('status', 'PUBLISHED')->where('id', $slug)->first();
        //dd($obj);

        if(isset($obj)) {

            $arr_partitipants = Arr::pluck( $obj->partitipantss->all(), 'user_id' );
            //dd($arr_partitipants);

            $messages = Messages::with('sender')->where('status', 'PUBLISHED')->where('resiver_id', null)->where('group_id', $slug)->whereIn('sender_id', $arr_partitipants)->get();

            return view('group', compact('obj','messages','slug'));

        } else {

            return view('group-not-found');

        }
    }

    public function postIndex(ChatRequest $r)
    {
        $r['status'] = 'PUBLISHED';
        $r['sender_id'] = Auth::user()->id;
        $r['resiver_id'] = null;

        if( array_key_exists('group_id', $r->input()) and intval($r->input('group_id')) != 0 ) {
            $r['group_id'] = intval($r->input('group_id'));
        } else {
            abort(403);
        }

        //dd($r);
        Messages::create($r->all());

        return redirect()->back();
    }

    public function createGroup(GroupRequest $r)
    {
        $r['user_id'] = Auth::user()->id;
        $r['status'] = 'PUBLISHED';

        //dd($r);
        $group = groups::create($r->all());

        /*
        $add_creator['group_id'] = $group->id;
        $add_creator['user_id'] = $r['user_id'];
        dd($add_creator);
        */

        partitipants::insert([
            'group_id' => $group->id,
            'user_id' => $r['user_id'],
        ]);

        return redirect()->back();
    }

    public function addPartitipant(PartitipantRequest $r)
    {
        return redirect()->back();
    }
}
