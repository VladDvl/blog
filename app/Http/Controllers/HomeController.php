<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Post;// или App\Libs\Img и \App::make('Img')
use Auth;

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
        $objs = Post::where('author_id', Auth::user()->id)->orderBy('id','DESC')->paginate(10);

        return view('home', compact('objs'));
    }

    public function postIndex(PostRequest $r)
    {
        /*dd($r->all());*/
        $r['status'] = 'PUBLISHED';
        $r['slug'] = date('y_m_d_h_i_s');

        $pic = \App::make('\App\Libs\Img')->url($_FILES['picture1']['tmp_name']);
        //dd($pic);
        if($pic) {
            $r['image'] = $pic;
        } else {
            $r['image'] = '';
        }

        $r['author_id']=Auth::user()->id;

        Post::create($r->all());
        return redirect()->back();
    }
}
