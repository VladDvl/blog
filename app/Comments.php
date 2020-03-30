<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;

class Comments extends Model
{
    protected $fillable = ['author_id', 'post_id', 'body', 'image', 'slug', 'status'];
    
    public function postss()
    {
        return $this->belongsTo(Voyager::modelClass('Post'),'post_id');
    }

    public function usersss()
    {
        return $this->belongsTo(Voyager::modelClass('User'),'author_id');
    }
}
