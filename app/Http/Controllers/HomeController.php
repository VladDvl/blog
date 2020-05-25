<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use App\Http\Requests\PostRequest;
use App\Http\Requests\AvatarRequest;
use App\Http\Requests\HomeTableRequest;
use App\Notifications\InvoicePaid;
use App\Post;// или App\Libs\Img и \App::make('Img')
use App\Comments;
use App\Categories;
use App\User;
use App\Messages;
use App\groups;
use App\Tags;
use App\Subscriptions;
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

        $msgs = Messages::with('sender')->where([
            ['sender_id', '=', Auth::user()->id],
            ['resiver_id', '<>', null],
            ['status', '=', 'PUBLISHED'],
        ])->orWhere([
            ['resiver_id', '=', Auth::user()->id],
            ['status', '=', 'PUBLISHED'],
        ])->orderBy('id', 'DESC')->get();

        $messagess_array = $msgs->all();
        $userss1 = collect( Arr::pluck( $messagess_array, 'sender_id' ) );
        $userss2 = collect( Arr::pluck( $messagess_array, 'resiver_id' ) );
        $userss = $userss1->merge($userss2)->all();
        $friends_id = array_filter( $userss, function($one) {
            return $one != Auth::user()->id;
        } );
        $friends_id_unique = array_unique( $friends_id );
        $friends_id_string = "'" . implode("','", $friends_id_unique) . "'";

        $friends = User::with('last_message_sender')->with('last_message_resiver')->whereIn('id', $friends_id_unique)->orderByRaw( "FIELD(id, $friends_id_string)" )->get();
        //dd($friends);

        $groups = groups::with('group_creator')->with('partitipantss')->with('messagee')->whereHas('partitipantss', function (Builder $query) {
            $query->where('user_id', '=', Auth::user()->id)->where('status', 'active');
        })->where('status', 'PUBLISHED')->withCount(['partitipantss' => function(Builder $query) {
            $query->where('status', 'active');
        }])->get();
        //dd($groups);

        $subscription = Subscriptions::where('user_id', Auth::user()->id)->where('status', 'PUBLISHED')->first();
        if( isset($subscription) ) {

            $arr_tags_id = explode(',', $subscription->tag_id);
            $arr_authors_id = explode(',', $subscription->author_id);

            if( $subscription->tag_id != null ) {

                $sub_tags = Tags::where('status', 'PUBLISHED')->whereIn('id', $arr_tags_id)->get();

            } else {

                $sub_tags = null;

            }

            if( $subscription->author_id != null ) {

                $sub_authors = User::whereIn('id', $arr_authors_id)->get();

            } else {

                $sub_authors = null;

            }

        } else {

            $sub_tags = null;
            $sub_authors = null;

        }

        $objects = compact('objs','cats','msgs','friends','groups','sub_tags','sub_authors');
        return $objects;
    }

    public function index()
    {
        $objects = $this->homeObjs();
        $objs = $objects['objs'];
        $cats = $objects['cats'];
        $msgs = $objects['msgs'];
        $friends = $objects['friends'];
        $groups = $objects['groups'];
        $sub_tags = $objects['sub_tags'];
        $sub_authors = $objects['sub_authors'];

        return view('home', compact('objs','cats','msgs','friends','groups','sub_tags','sub_authors'));
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

            $post = Post::create($r->all());

            $subscriptions = Subscriptions::where('status', 'PUBLISHED')->where('user_id', '<>', Auth::user()->id)->get();
            $subscribers_id =[];
            foreach($subscriptions as $sub)
            {
                $arr_authors_id = explode(',', $sub->author_id);
                if( in_array(Auth::user()->id, $arr_authors_id) ) {
                    $subscribers_id[] = $sub->user_id;
                }
            }
            $subscribers_id = array_unique( $subscribers_id );
            if( !empty($subscribers_id) ) {

                $subscribers = User::whereIn('id', $subscribers_id)->get();

                $author_id = Auth::user()->id;
                $author_name = Auth::user()->name;
                $post_id = $post->id;
                $post_title = $post->title;

                foreach($subscribers as $subscriber)
                {
                    $subscriber->notify(new InvoicePaid($author_id, $author_name, $post_id, $post_title));
                }

            }

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
            $query2 = Comments::where('post_id', $post_id)->delete();

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
        $msgs = $objects['msgs'];
        $friends = $objects['friends'];
        $groups = $objects['groups'];
        $sub_tags = $objects['sub_tags'];
        $sub_authors = $objects['sub_authors'];

        $edit_post = Post::where('slug', $slug)->first();
        $post_id = $edit_post->id;

        return view('home', compact('objs','cats','msgs','friends','groups','post_id','edit_post','sub_tags','sub_authors'));
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
