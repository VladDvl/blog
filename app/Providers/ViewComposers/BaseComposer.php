<?php

namespace App\Providers\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Categories;
use App\User;
use App\Post;
use App\Comments;

class BaseComposer
{
    public function compose(View $view)
    {
        /*$top_users = User::with('user_posts')->get();
        foreach($top_users as $top_user)
        {
            $howmany = count( $top_user->user_posts );
            $posts = 'posts';
            $top_user->$posts = $howmany;
        }   ...->with('top_users',$top_users)*/
        $usrs = User::with('user_posts')->orderBy('id','DESC')->limit(5)->get();
        
        $posts = Post::orderBy('loads','DESC')->limit(10)->get();
        
        $comment = Comments::with('postss')->orderBy('id','DESC')->first();

        $all_users = User::get();
        $all_userss = count( $all_users );

        $all_posts = Post::get();
        $all_postss = count( $all_posts );

        $all_comments = Comments::get();
        $all_commentss = count( $all_comments );

        /*foreach($top_users as $one) {
            $one->user_posts->
        }*/
        //dd($top_users);
        //dd($top_users->name);

        $test = Categories::orderBy('id')->limit(12)->get();
        $view->with('test',$test)->with('usrs',$usrs)->with('posts',$posts)->with('comment',$comment)->with('all_userss',$all_userss)->with('all_postss',$all_postss)->with('all_commentss',$all_commentss);
    }
}