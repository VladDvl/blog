<?php

namespace App\Providers\ViewComposers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Arr;
use App\Categories;
use App\User;
use App\Post;
use App\Comments;
use App\Messages;
use App\groups;
use App\Tags;

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
        
        $status = 'PUBLISHED';
        $comment = Comments::with('postss')->where('status', $status)->orderBy('id','DESC')->first();

        $all_users = User::get();
        $all_userss = count( $all_users );

        $all_posts = Post::get();
        $all_postss = count( $all_posts );

        $all_comments = Comments::where('status', $status)->get();
        $all_commentss = count( $all_comments );

        $common_msgs = Messages::with('sender')->where([
            ['resiver_id', '=', null],
            ['group_id', '=', null],
        ])->orderBy('id', 'ASC')->get();

        $msg_array = $common_msgs->all();
        $senders = array_unique( Arr::pluck($msg_array, 'sender_id') );
        $color = 'color';
        $arr_colors = ['red','blue','yellow','green','pink','aqua','blueviolet','chartreuse','chocolate','crimson','darkcyan','darkred','darkslategray','goldenrod','limegreen','navy','yellowgreen'];
        foreach($senders as $sender)
        {
            $rand_color = array_rand($arr_colors);
            foreach($common_msgs as $msg)
            {
                if($msg->sender_id == $sender) {

                    $msg->$color = $arr_colors[$rand_color];

                }
            }
        }

        $groups = groups::with('partitipantss')->where('status', 'PUBLISHED')->where('type', 'public')->limit(4)->inRandomOrder()->get();
        
        $tags = Tags::where('status', 'PUBLISHED')->limit(6)->inRandomOrder()->get();

        /*foreach($top_users as $one) {
            $one->user_posts->
        }*/
        //dd($top_users);
        //dd($top_users->name);

        $test = Categories::orderBy('id')->limit(12)->get();
        $view->with('test',$test)->with('usrs',$usrs)->with('posts',$posts)->with('comment',$comment)
            ->with('all_userss',$all_userss)->with('all_postss',$all_postss)->with('all_commentss',$all_commentss)
            ->with('common_msgs', $common_msgs)->with('groups', $groups)->with('tags', $tags);
    }
}