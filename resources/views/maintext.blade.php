@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/maintext.css')}}" rel="stylesheet"/>
@endsection

@section('header')
  <nav>
    <ul>
      <li>
        <a href="{{asset('category_id')}}">category_name</a>
      </li>
    </ul>
  </nav>
  @endsection

@section('content')
      
      <div class="blog-post body-maintext">
        <h2 class="blog-post-title">{{(isset($one->name)) ? $one->name : ''}}</h2>
        <p class="blog-post-meta">created_at by <a href="{{asset('user_id')}}">user_name</a></p>

        <p>{!!isset($one->body) ? $one->body : ''!!}</p>
      </div><!-- /.blog-post -->
	  
@endsection