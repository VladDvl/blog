<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
use App\User;

class groups extends Model
{
    protected $fillable = ['user_id','name','status'];

    public function group_creator()
    {
        return $this->belongsTo(Voyager::modelClass('User'), 'user_id');
    }
}
