<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
use App\User;
use App\groups;

class Messages extends Model
{
    protected $fillable = ['sender_id', 'resiver_id', 'group_id', 'body', 'status'];

    public function sender()
    {
        return $this->belongsTo(Voyager::modelClass('User'));
    }

    public function grouppp()
    {
        return $this->belongsTo('App\groups', 'group_id');
    }
}
