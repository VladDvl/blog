<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
use App\User;
use App\Messages;
use App\partitipants;

class groups extends Model
{
    protected $fillable = ['user_id','name','status'];

    public function group_creator()
    {
        return $this->belongsTo(Voyager::modelClass('User'), 'user_id');
    }

    public function partitipantss()
    {
        return $this->hasMany('App\partitipants', 'group_id');
    }

    public function messagee()
    {
        return $this->hasMany('App\Messages', 'group_id');
    }
}
