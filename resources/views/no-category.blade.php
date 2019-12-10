@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/category.css')}}" rel="stylesheet"/>
@endsection

@section('header')
  <div id="block-header" class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="">
      <h1 class="col-md-6 font-italic">{{isset($cat->name) ? $cat->name : ''}}</h1>
    </div>
  </div>
@endsection

@section('content')
      <div class="blog-post body-maintext">
        <div class="row justify-content-between container">
          <h2 class="blog-post-title col-md-7">Нет постов в данной категории</h2>
          <div class="post-actions col-md-5">
            <a class="p-2 text-muted" href="{{asset('home')}}">Добавить</a>
          </div>
        </div>
      </div><!-- /.blog-post -->
@endsection