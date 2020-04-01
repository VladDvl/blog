@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/maintext.css')}}" rel="stylesheet"/>
@endsection

@section('scripts')
  @parent
  <script src="{{asset('public/src/ckeditor5-build-classic/ckeditor.js')}}"></script>
  <script src="{{asset('public/js/ckcreate.js')}}"></script>
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
      <!--<p class="lead my-3">Это блог со статьями на различные тематики. Здесь пишут о программировании, играх и др. Статьи обсуждают в комментариях под ними. Для комментирования нужно зарегистрироваться.</p>-->
      <!--<p class="lead mb-0"><a href="{{asset('#')}}" class="text-white font-weight-bold">Continue reading...</a></p>-->
    </div>
  </div>
@endsection

@section('content')
      
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
      @if($obj['status'] == 'PUBLISHED' or $obj['status'] == 'PENDING')
      <div id="comment" class="blog-post body-maintext">

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
            @if( Auth::user()->id == $obj->author_id and Auth::user()->role_id != 1 )
              <a class="text-muted hide-action" href="{{asset('#')}}">{{__('menu.Hide')}}</a>
            @elseif( Auth::user()->role_id == 1 and Auth::user()->id != $obj->author_id )
              <a class="text-muted hide-action" href="{{asset('#')}}">{{__('menu.Hide')}}(admin)</a>
            @elseif( Auth::user()->role_id == 1 and Auth::user()->id == $obj->author_id )
              <div>
                <a class="text-muted hide-action" href="{{asset('#')}}">{{__('menu.Hide')}}</a><br>
                <a class="text-muted hide-action" href="{{asset('#')}}">{{__('menu.Hide')}}(admin)</a>
              </div>
            @endif
          @endif
        </div>

      </div><!-- post-comment -->
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
      </div>

	  
@endsection