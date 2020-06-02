@extends('layouts.base')

@section('scripts')
  @parent
  <script src="{{asset('public/js/modal.js')}}"></script>
@endsection

@section('styles')
  @parent
  <link href="{{asset('public/css/search.css')}}" rel="stylesheet"/>
  <link href="{{asset('public/css/modal.css')}}" rel="stylesheet"/>
@endsection

@section('content')

@if($objs)

<div>
  @if(count($objs['objs_posts'])>0)
  <div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic align-items-center col">
    <h3>
      {{__('menu.Articles')}}: {{count($objs['objs_posts'])}}.
    </h3>
    @foreach($objs['objs_posts'] as $one)
    
      <div class="blog-post body-maintext">
        <div class="row justify-content-between container">
          <h2 class="blog-post-title col-md-7">{{(isset($one->title)) ? $one->title : ''}}</h2>
          <div class="post-actions col-md-5">
            <a class="p-2 text-muted" href="{{asset('post/' . $one->slug)}}">{{__('menu.Open')}}</a>
            <a class="p-2 text-muted my-link" data-id="{{$one->id}}" href="{{asset('#')}}">{{__('menu.Show')}}</a>
          </div>
        </div>
        @include('templates.links')
      </div>

    @endforeach
    <div>{!!$objs['objs_posts']->links()!!}</div>
  </div>
  @endif
</div><!--posts-->

<div>
  @if(count($objs['objs_users'])>0)
  <div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic align-items-center col">
    <h3>
      {{__('menu.Users')}}: {{count($objs['objs_users'])}}.
    </h3>
      @foreach($objs['objs_users'] as $user)
        <div class="blog-post body-maintext">
          <div class="row justify-content-between container">
            <h2 class="blog-post-title col-md-7">
              <a href="{{asset('user/' . $user->id)}}">{{$user->name}}</a>
            </h2>
          </div>

          <div id="template-post-meta" class="row justify-content-between pb-4 mb-4 border-bottom container">
            <p class="blog-post-meta">{{__('menu.AllArticles')}}: {{(isset($user->user_posts)) ? count($user->user_posts) : ''}}</p>
            <p class="blog-post-meta">{{__('menu.Comments')}}: {{(isset($user->commss)) ? count($user->commss) : ''}}</p>
            <p class="blog-post-meta">{{__('menu.Registered')}}: {{(isset($user->created_at)) ? $user->created_at : ''}}</p>
          </div>
        </div>
      @endforeach
    </ol>
  </div>
  @endif
</div><!--users-->

<div>
  @if(count($objs['objs_categories'])>0)
  <div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic align-items-center col">
    <h3>
      {{__('menu.Categories')}}: {{count($objs['objs_categories'])}}.
    </h3>
    @foreach($objs['objs_categories'] as $category)
      <div class="blog-post body-maintext">
        <div class="row justify-content-between container">
          <h2 class="blog-post-title col-md-7">
            @if( App::getLocale() == 'en')
              <a href="{{asset('cat/' . $category->slug)}}">{{ucfirst($category->slug)}}</a>
            @else
              <a href="{{asset('cat/' . $category->slug)}}">{{$category->name}}</a>
            @endif
          </h2>
          <p class="blog-post-meta">{{__('menu.AllArticles')}}: {{(isset($category->posts)) ? count($category->posts) : ''}}</p>
        </div>
      </div>
    @endforeach
  </div>
  @endif
</div><!--categories-->

<div>
  @if(count($objs['objs_comments'])>0)
  <div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic align-items-center col">
    <h3>
      {{__('menu.Comms')}}: {{count($objs['objs_comments'])}}.
    </h3>
    @foreach($objs['objs_comments'] as $comment)
      <div class="blog-post body-maintext">
        <div class="row justify-content-between container">
          <a href="{{asset('post/' . $comment->postss->slug)}}">{!!mb_substr($comment->body, 0, 95)!!}</a>
          <p class="blog-post-meta">
            {{__('menu.Author')}}: <a href="{{asset('user/' . $comment->usersss->id)}}">{{(isset($comment->usersss->name)) ? $comment->usersss->name : ''}}</a>
          </p>
        </div>
      </div>
    @endforeach
  </div>
  @endif
</div><!--comments-->

<div>
  @if(count($objs['objs_groups'])>0)
    <div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic align-items-center col">
      <h3>
        {{__('menu.Groups')}}: {{count($objs['objs_groups'])}}.
      </h3>
      @foreach($objs['objs_groups'] as $group)
        <div class="blog-post body-maintext col">
          <div class="row justify-content-between container">
            <a href="{{asset('group/' . $group->id)}}">{!!mb_substr($group->name, 0, 95)!!}</a>
            <p class="blog-post-meta">
              {{__('menu.Author')}}: <a href="{{asset('user/' . $group->user_id)}}">{{(isset($group->group_creator->name)) ? $group->group_creator->name : ''}}</a>
              {{__('menu.Type')}}: {{$group->type}}
              {{__('menu.Created')}}: {{$group->created_at}}
            </p>
          </div>
          <p class="blog-post-meta row justify-content-end container">
              {{__('menu.Partitipants')}}: {{count($group->partitipantss)}}
              {{__('menu.Messagess')}}: {{count($group->messagee)}}
          </p>
        </div>
      @endforeach
    </div>
  @endif
</div><!--groups-->

<div>
  @if(count($objs['objs_tags'])>0)
    <div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic align-items-center col">
      <h3>
        {{__('menu.Tags')}}: {{count($objs['objs_tags'])}}.
      </h3>
      @foreach($objs['objs_tags'] as $tag)
        <div class="blog-post body-maintext col">
          <div class="row justify-content-between container">
            <a href="{{asset('tag/' . $tag->id)}}">{!!mb_substr($tag->name, 0, 95)!!}</a>
            <p class="blog-post-meta">
              {{__('menu.AllArticles')}}: {{(isset($tag->post_id)) ? count( explode(',', $tag->post_id) ) : ''}}
            </p>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div><!--tags-->

  @if(count($objs['objs_posts'])==0 and count($objs['objs_users'])==0 and count($objs['objs_comments'])==0 and count($objs['objs_categories'])==0 and count($objs['objs_groups'])==0 and count($objs['objs_tags'])==0)
  <div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic align-items-center col">
    <p>
      {{__('menu.NothingFind')}}.
    </p>
  </div>
  @endif

@else
<div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic align-items-center col">
  <p>
    {{__('menu.EnterAtLeast')}}.
  </p>
</div>
@endif

@endsection