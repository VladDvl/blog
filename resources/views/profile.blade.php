@extends('layouts.base')

@section('scripts')
  @parent
  <script src="{{asset('public/js/modal.js')}}"></script>
@endsection

@section('styles')
  @parent
  <link href="{{asset('public/css/home.css')}}" rel="stylesheet"/>
  <link href="{{asset('public/css/category.css')}}" rel="stylesheet"/>
  <link href="{{asset('public/css/modal.css')}}" rel="stylesheet"/>
@endsection

@section('content')

<div class="col-md-14">

    <div class="card-header">
    @guest
        @if(Route::has('register'))
            <a class="text-muted" href="{{asset('login')}}">{{__('menu.ToWriteLogIn')}}.</a>
        @endif
        @else
            @if(Auth::user()->id != $thing->id)
                <a class="text-muted" href="{{asset('chat/' . $thing->id)}}">{{__('menu.WriteMessage')}}.</a>
            @endif
    @endguest
    </div>

<div class="card">
    <div class="card-header">{{(isset($thing->name)) ? $thing->name : ''}}</div>
    <div class="card-body justify-content-start row">
        @if( $thing->avatar != '' and $thing->avatar != 'users/default.png' )
            <img src="{{asset('public/uploads/avatars/' . $thing->avatar)}}" alt="avatar">
        @else
            <img src="{{asset('public/img/default-avatar.png')}}" alt="avatar">
        @endif
        <div class="card-body">
            <div class="row">{{__('menu.Registered')}}: {{(isset($thing->created_at)) ? $thing->created_at : ''}}</div>
            <div class="row">{{__('menu.AllArticles')}}: {{count($thing->user_posts)}}</div>
            <div class="row">{{__('menu.AllComments')}}: {{count($thing->commss)}}</div>
        </div>
    </div>
</div><!--user_info-->

<div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic justify-content-between align-items-center row">
    <h3>
        {{__('menu.Articles')}}
    </h3>
    <!--<b><a id="artdate" href="{{asset('#')}}">Выбрать дату</a></b>-->
</div>

@if( count($objs) != 0 )
@foreach($objs as $one)
    <div class="blog-post body-maintext">
        <div class="row justify-content-between container">
            <h2 class="blog-post-title col-md-7">{{(isset($one->title)) ? $one->title : ''}}</h2>
            <div class="post-actions col-md-5">
                <a class="p-2 text-muted" href="{{asset('post/' . $one->slug)}}">{{__('menu.Open')}}</a>
                <a class="p-2 text-muted my-link" data-id="{{$one->id}}" href="{{asset('#')}}">{{__('menu.Show')}}</a>
            </div>
        </div>
        @include('templates.userposts')
    </div><!-- /.blog-post -->
@endforeach
@else
<p>{{__('menu.User_no_posts')}}.</p>
@endif

<div>{!!$objs->links()!!}</div>

</div>

@endsection