@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/welcome.css')}}" rel="stylesheet"/>
@endsection

@section('content')

<div id="block-head" class="container pb-4 mb-4 border-bottom font-italic">
    <h3>
        {{__('menu.Feed')}}
    </h3>
</div>

@if( isset($posts) and count($posts) > 0 )

  @foreach($posts as $one)
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
  <div>{!!$posts->links()!!}</div>

@else
  <p>{{__('menu.NothingFind')}}.</p>
@endif

@endsection