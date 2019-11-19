@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/maintext.css')}}" rel="stylesheet"/>
@endsection

@section('header')
  <div id="block-header" class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="">
      <h1 class="col-md-6 font-italic">{{isset($one->category->name) ? $one->category->name : ''}}</h1>
      <p class="col-md-6 font-italic"><a href="{{asset('cat/' . $one->category->slug)}}">К другим постам в категории</a></p>
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
          <img src="{{asset('public/uploads/'.$one->image)}}"/>
        @endif
        <p>{!!isset($one->body) ? $one->body : ''!!}</p>
      </div><!-- /.blog-post -->
	  
@endsection