@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/maintext.css')}}" rel="stylesheet"/>
@endsection

@section('scripts')
  @parent
  <script src="{{asset('public/src/ckeditor5-build-classic/ckeditor.js')}}"></script>
  <script src="{{asset('public/js/ckcreate.js')}}"></script>
  <script src="{{asset('public/js/post.js')}}"></script>
@endsection

@section('header')
  <div id="block-header" class="{{$one->category->slug}} jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="">
      @if( App::getLocale() == 'en')
        <h1 class="col-md-6 font-italic">{{isset($one->category->name) ? ucfirst($one->category->slug) : ''}}</h1>
        <p class="col-md-6 font-italic"><a href="{{asset('cat/' . $one->category->slug)}}">Return to other articles in category</a></p>
      @else
        <h1 class="col-md-6 font-italic">{{isset($one->category->name) ? $one->category->name : ''}}</h1>
        <p class="col-md-6 font-italic"><a href="{{asset('cat/' . $one->category->slug)}}">К другим постам в категории</a></p>
      @endif
    </div>
  </div>
@endsection

@section('content')
      
      @if( $one->author_id == Auth::user()->id )
        <div class="card bg-light rounded">
          <div class="card-header text-muted">{{__('menu.AddTag')}}</div>

          <div class="card-body justify-content-start border-bottom col">
            <form method="post" action="{{asset('tag/create')}}" enctype="multipart/form-data">
              {!!csrf_field()!!}
              @if(count($errors)>0)
                @foreach($errors->all() as $ers)
                  <div class="red">
                    {{$ers}}
                  </div>
                @endforeach
              @endif
              <input type="hidden" name="post_id" value="{{$one->id}}">
              <input class="input-tag" type="text" name="name" placeholder="{{__('menu.TagName')}}">
              <button class="btn btn-primary" type="submit" name="submit">{{__('menu.Add')}}</button>
            </form>
          </div>

          <div class="card-body justify-content-start col tag-list">
            <p class="text-muted">{{__('menu.TagsList')}}:</p>
            <form method="post" action="{{asset('tag/delete')}}" enctype="multipart/form-data">
              {!!csrf_field()!!}
              @if(count($errors)>0)
                @foreach($errors->all() as $ers)
                  <div class="red">
                    {{$ers}}
                  </div>
                @endforeach
              @endif
              <input type="hidden" name="post_id" value="{{$one->id}}">
              <div class="tags border">
              @if( count($tags) > 0 )
                @foreach($tags as $tag)
                  <div class="tag border-bottom">
                    <p class="tag-name"><a href="{{asset('#')}}">{{(isset($tag->name)) ? mb_substr($tag->name, 0 , 50) : ''}}</a></p>
                    <p class="tag-info text-muted">{{__('menu.AllArticles')}}: {{(isset($tag->post_id)) ? count( explode(',', $tag->post_id) ) : ''}}</p>
                    <p class="tag-info text-muted">{{__('menu.Subscriberss')}}: </p>
                    <button  class="btn btn-primary" type="submit" name="delete" value="{{$tag->id}}">{{__('menu.Delete')}}</button>
                  </div>
                @endforeach
              @endif
              </div>
            </form>
          </div>
        </div><!--add-tag-->
      @endif

      <div class="blog-post container">
        <h2 class="blog-post-title">{{(isset($one->title)) ? $one->title : ''}}</h2>
        @include('templates.links')
        @if($one->image)
          <img src="{{asset('public/uploads/posts/'.$one->image)}}"/>
        @endif
        <p>{!!isset($one->body) ? $one->body : ''!!}</p>
      </div><!-- /.blog-post -->

      <h3 class="text-muted">{{__('menu.Comms')}}</h3>

      @foreach($objs as $obj)
      @if($obj['status'] == 'PUBLISHED')
      <div class="blog-post body-maintext comments">

        <div class="row">
          @include('templates.coms')
          <div class="col justify-content-between container">
            @if($obj->image)
              <img id="comment-image" src="{{asset('public/uploads/comments/'.$obj->image)}}">
            @endif
            <div>{!!isset($obj->body) ? $obj->body : ''!!}</div>
          </div>
        </div>

        <div class="row justify-content-between container">
          <p class="blog-post-meta">{{__('menu.Published')}}: {{(isset($obj->created_at)) ? $obj->created_at : ''}}</p>
          @if( Route::has('register') and isset(Auth::user()->id) == true and isset($obj->author_id) == true )
            <form class="hide_comment_form" method="get" action="{{asset('hide-comment')}}">

              <input type="hidden" name="comment-id" value="{{$obj->id}}">
            @if( Auth::user()->id == $obj->author_id and Auth::user()->role_id != 1 )
              <button class="text-muted hide-action" name="submit" value="hide" type="submit">{{__('menu.Hide')}}</button>
            @elseif( Auth::user()->role_id == 1 and Auth::user()->id != $obj->author_id )
               <button class="text-muted hide-action" name="submit" value="hide-admin" type="submit">{{__('menu.Hide')}}(admin)</button>
            @elseif( Auth::user()->role_id == 1 and Auth::user()->id == $obj->author_id )
              <div>
                <button class="text-muted hide-action" name="submit" value="hide" type="submit">{{__('menu.Hide')}}</a><br>
                <button class="text-muted hide-action" name="submit" value="hide-admin" type="submit">{{__('menu.Hide')}}(admin)</a>
              </div>
            @endif
            
            </form>
          @endif
        </div>

      </div><!-- post-comment -->
      @elseif($obj['status'] == 'PENDING' and Route::has('register') and isset(Auth::user()->id) == true and isset($obj->author_id) == true)
        @if(Auth::user()->id == $obj->author_id)
        <div class="blog-post body-maintext comments hidden-comment">
          <div class="row">
            <div id="template-post-meta-com" class="comment-post col-md-2 justify-content-between pb-4 mb-4 border-bottom container">
              <p class="blog-post-meta">{{__('menu.Author')}}: <a href="{{asset('user/' . $obj->author_id)}}">{{isset($obj->usersss->name) ? $obj->usersss->name : ''}}</a></p>
            </div>
            <div class="col justify-content-between container">
              {{__('menu.HiddenComment')}}.
            </div>
          </div>
          <div class="row justify-content-between container">
            <p class="blog-post-meta">{{__('menu.Published')}}: {{(isset($obj->created_at)) ? $obj->created_at : ''}}</p>
            <form class="hide_comment_form" method="get" action="{{asset('hide-comment')}}">
              <input type="hidden" name="comment-id" value="{{$obj->id}}">
              <button class="text-muted show-action" name="submit" value="show" type="submit">{{__('menu.Display')}}</button>
            </form>
          </div>
        </div><!-- post-comment -->
        @endif
      @endif
      @endforeach

      <div class="card">
        <div class="card-header">{{__('menu.AddComment')}}</div>
        <div class="card-body">
        @guest
          @if (Route::has('register'))
            @if( App::getLocale() == 'en')
              <a href="{{asset('home')}}">Only authorized users cat leave comments.</a>
            @else
              <a href="{{asset('home')}}">Только авторизированные пользователи могут оставлять комментарии.</a>
            @endif
          @endif
          @else
          <form method="post" action="{{asset('post/' . $one->slug)}}" enctype="multipart/form-data">
            {!!csrf_field()!!}
            @if(count($errors)>0)
              @foreach($errors->all() as $ers)
                <div class="red">
                  {{$ers}}
                </div>
              @endforeach
            @endif
            <div class="form-group">
              <label for="editor">{{__('menu.Description')}}</label>
              <textarea class="form-control" id="editor" name="body"></textarea>
            </div>
            <div class="form-group">
              <label for="postImage">{{__('menu.Image')}}</label>
              <input type="file" class="form-control" id="postImage" name="picture1" placeholder="Изображение">
            </div>
            <button type="submit" class="btn btn-primary">{{__('menu.Send')}}</button>
          </form>
        @endguest
        </div>
      </div><!--add-comment-->

	  
@endsection