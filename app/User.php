<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use TCG\Voyager\Facades\Voyager;
use App\Comments;
use App\Messages;
use App\groups;
use Auth;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_posts()
    {
        return $this->hasMany(Voyager::modelClass('Post'), 'author_id');
    }

    public function commss()
    {
        $status = 'PUBLISHED';
        return $this->hasMany('App\Comments', 'author_id')->where('status', $status);
    }

    public function messagess()
    {
        return $this->hasMany('App\Messages', 'sender_id')->where('status', 'PUBLISHED')->where('resiver_id', '=', Auth::user()->id)->orWhere('sender_id', '=', Auth::user()->id);
    }

    public function groupss()
    {
        return $this->hasMany('App\groups', 'user_id');
    }

    public function last_message_sender()
    {
        return $this->hasOne('App\Messages', 'sender_id')->where('status', 'PUBLISHED')->where('resiver_id', '=', Auth::user()->id)->orWhere('sender_id', '=', Auth::user()->id)->latest();
    }

    public function last_message_resiver()
    {
        return $this->hasOne('App\Messages', 'resiver_id')->where('status', 'PUBLISHED')->where('resiver_id', '=', Auth::user()->id)->orWhere('sender_id', '=', Auth::user()->id)->latest();
    }
}
