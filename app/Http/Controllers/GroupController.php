<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GroupRequest;
use App\groups;
use Auth;

class GroupController extends Controller
{
    public function createGroup(GroupRequest $r)
    {
        $r['user_id'] = Auth::user()->id;
        $r['status'] = 'PUBLISHED';

        //dd($r);
        groups::create($r->all());

        return redirect()->back();
    }
}
