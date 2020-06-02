@extends('layouts.base')

@section('scripts')
  @parent
@endsection

@section('styles')
  @parent
  <link href="{{asset('public/css/tags.css')}}" rel="stylesheet"/>
@endsection

@section('content')

<div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic justify-content-between align-items-center row">
    <h3>
        {{__('menu.Tags')}}
    </h3>
</div>

@if( isset($all_tags) )

<div class="card">
<div class="card-body all-tags-list justify-content-start col">
    @foreach($all_tags as $tag)
        <a class="tag-link" href="{{asset('tag/' . $tag->id)}}">
            <div class="tag">
                <p class="tag-name">{{mb_substr($tag->name, 0, 30)}}</p>
                <p class="tag-info">{{(isset($tag->post_id)) ? count( explode(',', $tag->post_id) ) : ''}}</p>
            </div>
        </a>
    @endforeach
</div><!--tags list-->
</div>

<div>{!!$all_tags->links()!!}</div>

@else
<p>{{__('menu.NoTags')}}.</p>
@endif

@endsection