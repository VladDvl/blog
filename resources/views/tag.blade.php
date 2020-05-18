@extends('layouts.base')

@section('scripts')
  @parent
  <script src="{{asset('public/js/modal.js')}}"></script>
@endsection

@section('styles')
  @parent
  <link href="{{asset('public/css/tag.css')}}" rel="stylesheet"/>
  <link href="{{asset('public/css/modal.css')}}" rel="stylesheet"/>
@endsection

@section('content')

@if(count($objs) > 0)
  <div class="card bg-light rounded">
    <div class="card-header tag-header">
      <p><span class="text-muted">{{__('menu.Tag')}}:</span> {{mb_substr($tag->name, 0, 50)}}</p>
      @guest
        @else
          @if( $sub_bool == false )
            <form method="post" action="{{asset('tag/subscribe')}}">
              {!!csrf_field()!!}
              @if(count($errors)>0)
                @foreach($errors->all() as $ers)
                  <div class="red">
                    {{$ers}}
                  </div>
                @endforeach
              @endif
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
              <button class="btn btn-primary" type="submit" name="tag_id" value="{{$tag->id}}">
                {{__('menu.Subscribe')}}
              </button>
            </form><!--subscribe-->
          @else
            <form method="post" action="{{asset('tag/unsubscribe')}}">
              {!!csrf_field()!!}
              @if(count($errors)>0)
                @foreach($errors->all() as $ers)
                  <div class="red">
                    {{$ers}}
                  </div>
                @endforeach
              @endif
              <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
              <button class="btn btn-primary" type="submit" name="tag_id" value="{{$tag->id}}">
                {{__('menu.UnSubscribe')}}
              </button>
            </form><!--unsubscribe-->
          @endif
      @endguest
    </div>
  </div>

  <div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic justify-content-between align-items-center row">
    <h3>
      {{__('menu.AllArticles')}}: <span id="articles-count">{{(isset($tag->post_id)) ? count( explode(',', $tag->post_id) ) : ''}}</span>
    </h3>
  </div>

  @foreach($objs as $one)
    <div class="blog-post body-maintext">
      <div class="row justify-content-between container">
        <h2 class="blog-post-title col-md-7">{{(isset($one->title)) ? mb_substr($one->title, 0, 100) : ''}}</h2>
        <div class="post-actions col-md-5">
          <a class="p-2 text-muted" href="{{asset('post/' . $one->slug)}}">{{__('menu.Open')}}</a>
          <a class="p-2 text-muted my-link" data-id="{{$one->id}}" href="{{asset('#')}}">{{__('menu.Show')}}</a>
        </div>
      </div>
      @include('templates.links')
    </div><!-- /.blog-post -->
  @endforeach

  <div>{!! $objs->links() !!}</div>

@else
  <p>{{__('menu.NothingFind')}}.</p>
@endif

@endsection