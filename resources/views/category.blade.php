@extends('layouts.base')

@section('scripts')
  @parent
  <script src="{{asset('public/js/modal.js')}}"></script>
@endsection

@section('styles')
  @parent
  <link href="{{asset('public/css/category.css')}}" rel="stylesheet"/>
  <link href="{{asset('public/css/modal.css')}}" rel="stylesheet"/>
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
      @foreach($objs as $one)
      <div class="blog-post body-maintext">
        <div class="row justify-content-between container">
          <h2 class="blog-post-title col-md-7">{{(isset($one->title)) ? $one->title : ''}}</h2>
          <div class="post-actions col-md-5">
            <a class="p-2 text-muted" href="{{asset('post/' . $one->slug)}}">{{__('menu.Open')}}</a>
            <a class="p-2 text-muted my-link" data-id="{{$one->id}}" href="{{asset('#')}}">{{__('menu.Show')}}</a>
          </div>
        </div>
        @include('templates.links')
      </div><!-- /.blog-post -->
      @endforeach

      <div>{!!$objs->links()!!}</div>
@endsection