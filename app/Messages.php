<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Facades\Voyager;
use App\User;

class Messages extends Model
{
    public function sender()
    {
        return $this->belongsTo(Voyager::modelClass('User'));
    }
}
