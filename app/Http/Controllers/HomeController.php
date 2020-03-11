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
    protected function getPostId($req = null)
    {
        $post_id = null;
        if ( $req != null ) {

            $input = $req->input();
            if( (array_key_exists('delete', $input) == true) ) {
                $post_id = $input['delete'];
            } else if(array_key_exists('edit', $input) == true) {
                $post_id = $input['edit'];
            } else {
                $post_id = null;
            }
        }
        return $post_id;
    }

    protected function homeObjs()
    {
        $cats = Categories::orderBy('id','DESC')->get();

        $objs = Post::with('category','comms')->where('author_id', Auth::user()->id)->orderBy('id','DESC')->paginate(6);

        foreach($objs as $one)
        {
            $howmany = count( $one->comms );
            $comments = 'comments';
            $one->$comments = $howmany;
        }

        $objects = compact('objs','cats');
        return $objects;
    }

    public function index()
    {
        $objects = $this->homeObjs();
        $objs = $objects['objs'];
        $cats = $objects['cats'];

        return view('home', compact('objs','cats'));
    }

    public function postIndex(PostRequest $r)
    {
        $input = $r->input();

        if( (array_key_exists('create', $input) == true) ) {

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

        } else if( (array_key_exists('update', $input) == true) ) {

            //dd($r->all());
            $post_id = $input['update'];

            $pic = \App::make('\App\Libs\Img')->url('post',$_FILES['picture1']['tmp_name']);
            //dd($pic);
            if($pic) {
                $r['image'] = $pic;
            } else {
                $r['image'] = '';
            }
            
            $title = $r['title'];
            $body = $r['body'];
            $category_id = $r['category_id'];
            $image = $r['image'];
            $update_objs = compact('title','body','category_id','image');

            Post::where('id', $post_id)->update($update_objs);

        }

        return redirect()->route('home');
    }

    public function homeTable(HomeTableRequest $req)
    {
        if( $req->input('delete') ) {

            $post_id = $this->getPostId($req);
            $query = Post::where('id', $post_id)->delete();

            return redirect()->back();

        } else if ( $req->input('edit') ) {

            $post_id = $this->getPostId($req);
            $query = Post::where('id', $post_id)->first();
            $slug = $query->slug;

            return redirect()->route('edit_post', ['slug' => $slug]);

        } else {

            return redirect()->back();

        }
    }

    public function editPost($slug = null)
    {
        $objects = $this->homeObjs();
        $objs = $objects['objs'];
        $cats = $objects['cats'];

        $edit_post = Post::where('slug', $slug)->first();
        $post_id = $edit_post->id;

        return view('home', compact('objs','cats','post_id','edit_post'));
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
