<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
use App\groups;
use App\User;

class partitipants extends Model
{
    public function groupp()
    {
        return $this->belongsTo('App\groups', 'group_id');
    }

    public function userr()
    {
        return $this->belongsTo(Voyager::modelClass('User'), 'user_id');
    }
}
