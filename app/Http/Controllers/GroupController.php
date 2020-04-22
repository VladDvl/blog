<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GroupRequest;
use App\groups;
use App\partitipants;
use Auth;

class GroupController extends Controller
{
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

    public function addPartitipant()
    {
        //
    }
}
