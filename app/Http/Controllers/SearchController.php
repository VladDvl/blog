<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Comments;
use App\Categories;

class SearchController extends Controller
{
    public function getIndex()
    {
        $data = $_GET['search'];
        //dd($data);

        $objs_posts = Post::where('title', 'LIKE', '%'.$_GET['search'].'%')->orWhere('body', 'LIKE', '%'.$_GET['search'].'%')->get();
        $objs_users = User::where('name', 'LIKE', '%'.$_GET['search'].'%')->get();
        $objs_comments = Comments::where('body', 'LIKE', '%'.$_GET['search'].'%')->get();
        $objs_categories = Categories::where('name', 'LIKE', '%'.$_GET['search'].'%')->orWhere('slug', 'LIKE', '%'.$_GET['search'].'%')->get();

        $objs = compact('objs_posts','objs_users','objs_comments','objs_categories');
        dd($objs);

        return redirect()->back();
    }
}
