@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/welcome.css')}}" rel="stylesheet"/>
@endsection

@section('header')

  @guest
  <div id="block-header" class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="col-md-10 px-0">
      @if( App::getLocale() == 'en')
        <h1 class="display-4 font-italic">Welcome</h1>
        <p class="lead my-3">This is a blog with articles on various topics. It is about programming, games, etc. Articles are discussed in the comments bellow. To comment, you neen to register.</p>
      @else
        <h1 class="display-4 font-italic">Приветствуем вас</h1>
        <p class="lead my-3">Это блог со статьями на различные тематики. Здесь пишут о программировании, играх и др. Статьи обсуждают в комментариях под ними. Для комментирования нужно зарегистрироваться.</p>
      @endif
    </div>
  </div><!--welcome-->
  @endguest

  <div class="row mb-2">
    @foreach($things as $thing)
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          @if( App::getLocale() == 'en')
            <strong class="d-inline-block mb-2 text-success">{{ucfirst($thing->category->slug)}}</strong>
          @else
            <strong class="d-inline-block mb-2 text-success">{{$thing->category->name}}</strong>
          @endif
          <h3 class="mb-0">
            {{mb_substr($thing->title,0,15)}}
            @if( iconv_strlen($thing->title) > 15 )
              ...
            @endif
          </h3>
          <div class="mb-1 text-muted">{{$thing->created_at}}</div>
          <p class="mb-auto head-article-body">
            {!!mb_substr(strip_tags($thing->body),0,100)!!}
            @if( iconv_strlen($thing->body) > 100 )
              ...
            @endif
          </p>
          <a href="{{asset('post/' . $thing->slug)}}" class="stretched-link">{{__('menu.Continue')}}</a>
        </div>
        <div class="col-auto d-none d-lg-block header-img">
          @if($thing->image)
            <img src="{{asset('public/uploads/posts/'.$thing->image)}}"/>
          @else
            <img src="{{asset('public/img/LightBulb.jpg')}}"/>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div><!--head-articles-->

  <div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic justify-content-between align-items-center row">
    <h3>
      {{__('menu.Articles')}}
    </h3>
  </div>

@endsection

@section('content')

  @foreach($objs as $one)
  <div class="blog-post container">
    <h2 class="blog-post-title"><a href="{{asset('post/' . $one -> slug)}}">{{$one -> title}}</a></h2>
    @include('templates.links')
    @if($one->image)
      <img widtg="200" height="250" src="{{asset('public/uploads/posts/'.$one->image)}}"/>
    @endif
    <p class="postBody">
      {!!mb_substr($one -> body,0,1500)!!}
      @if( iconv_strlen($one->body) > 1500 )
        ...
      @endif
    </p>
    <a class="readWhole" href="{{asset('post/' . $one -> slug)}}">{{__('menu.Continue')}}</a>
  </div><!-- /.blog-post -->
  @endforeach
  <div>{!!$objs->links()!!}</div>
	  
@endsection