<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comments;
use App\Categories;

class SearchController extends Controller
{
    public function getIndex($objs = null)
    {
        $data = $_GET['search'];
        //dd($data);

        if($_GET['search'] != '' and iconv_strlen($_GET['search'])>2) {

            $objs_posts = Post::where('title', 'LIKE', '%'.$_GET['search'].'%')->orWhere('body', 'LIKE', '%'.$_GET['search'].'%')->paginate(10);
            $objs_users = User::where('name', 'LIKE', '%'.$_GET['search'].'%')->paginate(10);
            $objs_comments = Comments::where('body', 'LIKE', '%'.$_GET['search'].'%')->paginate(10);
            $objs_categories = Categories::where('name', 'LIKE', '%'.$_GET['search'].'%')->orWhere('slug', 'LIKE', '%'.$_GET['search'].'%')->paginate(10);

            $objs = compact('objs_posts','objs_users','objs_comments','objs_categories');
            //dd($objs['objs']);
            
        }

        return view('search',compact('objs'));
    }
}
