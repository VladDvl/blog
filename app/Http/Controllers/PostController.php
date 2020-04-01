<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Post;
use App\Comments;
use Auth;

class PostController extends Controller
{
    protected function postLoads($id)
    {
        $obj = Post::find($id);
        $obj->loads = $obj->loads + 1;
        $obj->save();
    }

    protected function showPost($slug)
    {
        $one = Post::with('userss','category','comms')->where('slug',$slug)->first();
        return $one;
    }

    public function getIndex($slug = null)
    {
        $one = $this->showPost($slug);

        $howmany = count( $one->comms );
        $comments = 'comments';
        $one->$comments = $howmany;

        $status1 = 'PUBLISHED';
        $status2 = 'PENDING';
        $objs = Comments::with('postss','usersss')->where('slug',$slug)->where('status', $status1)->orWhere('status', $status2)->orderBy('id','DESC')->paginate(20);

        $id = $one->id;
        $postLoads = $this->postLoads($id);

        return view('post',compact('one','objs'));
    }

    public function postIndex(CommentRequest $r, $slug = null)
    {
        $one = $this->showPost($slug);

        $r['slug'] = $slug;
        $r['status'] = 'PUBLISHED';
        $r['post_id']= $one->id;
        
        $pic = \App::make('\App\Libs\Img')->url('comment',$_FILES['picture1']['tmp_name']);
        if($pic) {
            $r['image'] = $pic;
        } else {
            $r['image'] = '';
        }

        $r['author_id']=Auth::user()->id;

        //dd($r->all());
        Comments::create($r->all());
        return redirect()->back();
    }
}