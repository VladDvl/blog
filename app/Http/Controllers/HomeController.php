<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function postIndex(PostRequest $r)
    {
        /*dd($r->all());*/
        $r['status'] = 'PUBLISHED';
        $r['slug'] = 'url';
        Post::create($r->all());
        return redirect()->back();
    }
}
