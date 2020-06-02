@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/category.css')}}" rel="stylesheet"/>
@endsection

@section('header')
  <div id="block-header" class="{{$cat->slug}} jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="">
      @if( App::getLocale() == 'en')
        <h1 class="col-md-6 font-italic">{{isset($cat->name) ? ucfirst($cat->slug) : ''}}</h1>
      @else
        <h1 class="col-md-6 font-italic">{{isset($cat->name) ? $cat->name : ''}}</h1>
      @endif
    </div>
  </div>
@endsection

@section('content')
  <div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic justify-content-between align-items-center row">
    <h3>
      {{__('menu.Articles')}}
    </h3>
  </div>

      <div class="blog-post body-maintext">
        <div class="row justify-content-between container">
          <h2 class="blog-post-title col-md-7">{{__('menu.NoArticles')}}</h2>
          <div class="post-actions col-md-5">
            <a class="p-2 text-muted" href="{{asset('home')}}">{{__('menu.Add')}}</a>
          </div>
        </div>
      </div><!-- /.blog-post -->
@endsection