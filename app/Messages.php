<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
use App\User;

class Messages extends Model
{
    protected $fillable = ['sender_id', 'resiver_id', 'group_id', 'body', 'status'];

    public function sender()
    {
        return $this->belongsTo(Voyager::modelClass('User'));
    }
}
