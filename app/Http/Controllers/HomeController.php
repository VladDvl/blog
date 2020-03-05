<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Requests\AvatarRequest;
use App\Http\Requests\HomeTableRequest;
use App\Post;// или App\Libs\Img и \App::make('Img')
use App\Categories;
use App\User;
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
        $cats = Categories::orderBy('id','DESC')->get();

        $objs = Post::with('category','comms')->where('author_id', Auth::user()->id)->orderBy('id','DESC')->paginate(6);

        foreach($objs as $one)
        {
            $howmany = count( $one->comms );
            $comments = 'comments';
            $one->$comments = $howmany;
        }

        return view('home', compact('objs','cats'));
    }

    public function postIndex(PostRequest $r)
    {
        /*dd($r->all());*/
        $r['status'] = 'PUBLISHED';
        $r['slug'] = date('y_m_d_h_i_s');

        $pic = \App::make('\App\Libs\Img')->url('post',$_FILES['picture1']['tmp_name']);
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

    public function homeTable(HomeTableRequest $req)
    {
        if( $req->input('delete') ) {

            $input = $req->input();
            $post_id = $input['delete'];
            //dd($post_id);
            $query = Post::where('id', $post_id)->delete();

            return redirect()->back();

        } else if ( $req->input('edit') ) {

            $input = $req->input();
            $post_id = $input['edit'];
            dd($post_id);
            //$query = Post::where('id', $post_id)->select();

            return redirect()->back();

        }
    }

    public function avatarChange(AvatarRequest $r)
    {
        if( $r->input('action') == 'change' ) {
            
            $pic = \App::make('\App\Libs\Img')->url('avatar',$_FILES['avatar1']['tmp_name']);

            if($pic) {
                $r['avatar'] = $pic;
            } else {
                $r['avatar'] = '';
            }

            $userr = User::find(Auth::user()->id);
            $userr->update($r->all());
            return redirect()->back();

        } elseif ( $r->input('action') == 'delete' ) {

            $r['avatar'] = '';

            $userr = User::find(Auth::user()->id);
            $userr->update($r->all());
            return redirect()->back();

        }

        
    }
}
