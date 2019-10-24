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
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-primary">World</strong>
          <h3 class="mb-0">Featured post</h3>
          <div class="mb-1 text-muted">Nov 12</div>
          <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="{{asset('#')}}" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <!--<svg class="bd-placeholder-img" width="200" height="250" xmlns="{{asset('http://www.w3.org/2000/svg')}}" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>-->
          <img widtg="200" height="250" src="{{asset('public/img/World.jpg')}}">
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
          <strong class="d-inline-block mb-2 text-success">Design</strong>
          <h3 class="mb-0">Post title</h3>
          <div class="mb-1 text-muted">Nov 11</div>
          <p class="mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
          <a href="{{asset('#')}}" class="stretched-link">Continue reading</a>
        </div>
        <div class="col-auto d-none d-lg-block">
          <!--<svg class="bd-placeholder-img" width="200" height="250" xmlns="{{asset('http://www.w3.org/2000/svg')}}" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>-->
          <img widtg="200" height="250" src="{{asset('public/img/LightBulb.jpg')}}">
        </div>
      </div>
    </div>
  </div>

@endsection

@section('content')

  @foreach($objs as $object)
  <div class="blog-post">
    <h2 class="blog-post-title"><a href="{{$object -> url}}">{{$object -> name}}</a></h2>
    <p class="blog-post-meta">{{$object -> created_at}} by <a href="{{$object -> user_id}}">{{$object -> user_id}}</a></p>
    <hr>
    <p>{{$object -> short}}</p>
  </div><!-- /.blog-post -->
  @endforeach
	  
@endsection