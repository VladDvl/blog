<?php

namespace App\Providers\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Categories;
use App\User;

class BaseComposer
{
    public function compose(View $view)
    {
        $top_users = User::with('user_posts')->get();

        /*foreach($top_users as $one) {
            $one->user_posts->
        }*/
        //dd($top_users);
        //dd($top_users->name);

        $test = Categories::orderBy('id')->limit(12)->get();
        $view->with('test',$test);
    }
}