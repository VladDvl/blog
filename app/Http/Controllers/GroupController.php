<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use App\Http\Requests\GroupRequest;
use App\Http\Requests\ChatRequest;
use App\Http\Requests\PartitipantRequest;
use App\Http\Requests\AvatarRequest;
use App\User;
use App\Messages;
use App\groups;
use App\partitipants;
use Auth;

class GroupController extends Controller
{
    public function getIndex($slug = null)
    {
        $obj = groups::with('messagee')->with('group_creator')->with('partitipantss')
            ->where('id', $slug)->where('status', 'PUBLISHED')
            ->where(function($query) {
                $query->where('type', 'public')
                    ->orWhere(function($query) {
                        $query->where('type', 'private')
                            ->whereHas('partitipantss', function (Builder $query) {
                                $query->where('user_id', '=', Auth::user()->id)->where('status', 'active');
                            });
                    });
            })->first();
        //dd($obj);
        
        if(isset($obj)) {
            $arr_partitipants_pending = Arr::pluck( $obj->partitipantss->where('status', 'pending')->all(), 'user_id' );
            $arr_partitipants_all = Arr::pluck( $obj->partitipantss->all(), 'user_id' );
            $arr_partitipants = Arr::pluck( $obj->partitipantss->where('status', 'active')->all(), 'user_id' );
            //dd($arr_partitipants);

            $messages = Messages::with('sender')->where('status', 'PUBLISHED')->where('resiver_id', null)->where('group_id', $slug)->whereIn('sender_id', $arr_partitipants)->get();

            $users = User::where('id', '<>', Auth::user()->id)->whereNotIn('id', $arr_partitipants_all)->get();

            $partitipants = User::where(function($query) use ($arr_partitipants) {
                $query->whereIn('id', $arr_partitipants);
            })->get();

            $pending_users = User::where(function($query) use ($arr_partitipants_pending) {
                $query->whereIn('id', $arr_partitipants_pending);
            })->get();
            //dd($pending_users);

            return view('group', compact('obj','messages','slug','users','pending_users','partitipants','arr_partitipants','arr_partitipants_all'));

        } else {

            return view('group-not-found');

        }
    }

    public function postIndex(ChatRequest $r)
    {
        $r['status'] = 'PUBLISHED';
        $r['sender_id'] = Auth::user()->id;
        $r['resiver_id'] = null;

        $partitipants = partitipants::where('group_id', $r->input('group_id'))->where('status', 'active')->get();
        $arr_users = Arr::pluck( $partitipants->all(), 'user_id' );

        if( !in_array(Auth::user()->id, $arr_users)  ) {
            return redirect()->back();
        }

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
            'status' => 'active',
        ]);

        return redirect()->back();
    }

    public function addPartitipant(PartitipantRequest $r)
    {
        if($r['action'] == 'add') {

            $r['status'] = 'active';
            //dd($r);
            partitipants::create($r->all());
    
            return redirect()->back();

        } elseif ($r['action'] == 'add-update') {

            $status = 'active';
            $user_id = $r['user_id'];
            $group_id = $r['group_id'];

            $partitipant = partitipants::where('group_id', $group_id)->where('user_id', $user_id)->first();

            //dd($r);
            $partitipant->update(['status' => $status]);

            return redirect()->back();

        } elseif ($r['action'] == 'delete') {

            $user_id = $r['user_id'];
            $group_id = $r['group_id'];

            $partitipant = partitipants::where('group_id', $group_id)->where('user_id', $user_id)->first();

            $partitipant->delete();

            return redirect()->back();

        }
    }

    public function enterPartitipant(PartitipantRequest $r)
    {
        $r['status'] = 'pending';
        //dd($r);
        partitipants::create($r->all());

        return redirect()->back();
    }

    public function avatarChange(AvatarRequest $r)
    {
        $input = $r->input();
        $group_id = $input['group_id'];
        //dd($r);

        if( $r->input('action') == 'change' ) {

            $pic = \App::make('\App\Libs\Img')->url('group-avatar',$_FILES['avatar1']['tmp_name']);

            if($pic) {
                $r['avatar'] = $pic;
            } else {
                $r['avatar'] = '';
            }

            $groupp = groups::where('id', $group_id)->update(['avatar' => $r['avatar']]);
            return redirect()->back();

        } elseif ( $r->input('action') == 'delete' ) {

            $r['avatar'] = '';

            $groupp = groups::where('id', $group_id)->update(['avatar' => null]);
            return redirect()->back();

        }
    }
}
