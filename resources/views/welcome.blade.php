@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/welcome.css')}}" rel="stylesheet"/>
@endsection

@section('header')
  <div id="block-header" class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="col-md-6 px-0">
      <h1 class="display-4 font-italic">Приветствуем вас</h1>
      <p class="lead my-3">Это блог со статьями на различные тематики. Здесь пишут о программировании, играх и др. Статьи обсуждают в комментариях под ними. Для комментирования нужно зарегистрироваться.</p>
      <!--<p class="lead mb-0"><a href="{{asset('#')}}" class="text-white font-weight-bold">Continue reading...</a></p>-->
    </div>
  </div>
  <div class="row mb-2">
    <!--<div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h3 class="mb-0">Featured post</h3>
          <div class="mb-1 text-muted">Nov 12</div>
          <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="{{asset('#')}}" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">-->
          <!--<svg class="bd-placeholder-img" width="200" height="250" xmlns="{{asset('http://www.w3.org/2000/svg')}}" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>-->
          <!--<img widtg="200" height="250" src="{{asset('public/img/World.jpg')}}">
        </div>
      </div>
    </div>-->
    @foreach($things as $thing)
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">{{$thing->category->name}}</strong>
          <h3 class="mb-0">{{mb_substr($thing->title,0,15)}}</h3>
          <div class="mb-1 text-muted">{{$thing->created_at}}</div>
          <p class="mb-auto">{{mb_substr($thing->body,0,100)}} ...</p>
          <a href="{{asset('post/' . $thing->slug)}}" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block header-img">
          <!--<svg class="bd-placeholder-img" width="200" height="250" xmlns="{{asset('http://www.w3.org/2000/svg')}}" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>-->
          @if($thing->image)
            <img src="{{asset('public/uploads/'.$thing->image)}}"/>
          @else
            <img src="{{asset('public/img/LightBulb.jpg')}}"/>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>

@endsection

@section('content')

  @foreach($objs as $one)
  <div class="blog-post">
    <h2 class="blog-post-title"><a href="{{asset('post/' . $one -> slug)}}">{{$one -> title}}</a></h2>
    @include('templates.links')
    <hr>
    @if($one->image)
      <img widtg="200" height="250" src="{{asset('public/uploads/'.$one->image)}}"/>
    @endif
    <p class="postBody">{!!mb_substr($one -> body,0,1500)!!}...</p>
    <a class="readWhole" href="{{asset('post/' . $one -> slug)}}">Читать полностью</a>
  </div><!-- /.blog-post -->
  @endforeach
  <div>{!!$objs->links()!!}</div>
	  
@endsection