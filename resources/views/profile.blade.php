@extends('layouts.base')

@section('scripts')
  @parent
  <script src="{{asset('public/js/modal.js')}}"></script>
@endsection

@section('styles')
  @parent
  <link href="{{asset('public/css/home.css')}}" rel="stylesheet"/>
  <link href="{{asset('public/css/category.css')}}" rel="stylesheet"/>
  <link href="{{asset('public/css/profile.css')}}" rel="stylesheet"/>
  <link href="{{asset('public/css/modal.css')}}" rel="stylesheet"/>
@endsection

@section('content')

@if( $thing != null )

    @guest
        @if(Route::has('register'))
            <div class="card-header">
                <a class="text-muted" href="{{asset('login')}}">{{__('menu.ToWriteLogIn')}}.</a>
            </div>
        @endif
        @else
            @if(Auth::user()->id != $thing->id)
                <div class="card-header">
                    <a class="text-muted" href="{{asset('chat/' . $thing->id)}}">{{__('menu.WriteMessage')}}.</a>
                </div>
            @endif
    @endguest

<div class="card">
    <div class="card-header profile-header">
        <p>{{(isset($thing->name)) ? mb_substr($thing->name, 0, 50) : ''}}</p>
        @guest
            @else
                @if(Auth::user()->id != $thing->id)
                    @if( $sub_bool == false )
                        <form method="post" action="{{asset('user/subscribe')}}">
                            {!!csrf_field()!!}
                            @if(count($errors)>0)
                                @foreach($errors->all() as $ers)
                                    <div class="red">
                                        {{$ers}}
                                    </div>
                                @endforeach
                            @endif
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <button class="btn btn-primary" type="submit" name="author_id" value="{{$thing->id}}">
                                {{__('menu.Subscribe')}}
                            </button>
                        </form><!--subscribe-->
                    @else
                        <form method="post" action="{{asset('user/unsubscribe')}}">
                            {!!csrf_field()!!}
                            @if(count($errors)>0)
                                @foreach($errors->all() as $ers)
                                    <div class="red">
                                        {{$ers}}
                                    </div>
                                @endforeach
                            @endif
                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                            <button class="btn btn-primary" type="submit" name="author_id" value="{{$thing->id}}">
                                {{__('menu.UnSubscribe')}}
                            </button>
                        </form><!--unsubscribe-->
                    @endif
                @endif
        @endguest
    </div>
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

<div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic justify-content-between align-items-center row">
    <h3>
        {{__('menu.Groups')}}
    </h3>
</div>

@if( count($groups) != 0 )

<div class="card">
<div class="card-body groups-list justify-content-start col">
    @foreach($groups as $group)
        <a class="group-link" href="{{asset('group/' . $group->id)}}">
        <div class="group">

            @if($group->avatar != '')
                <img class="group-small-avatar" src="{{asset('public/uploads/group-avatars/' . $group->avatar)}}" alt="avatar" width="24" height="24">
            @else
                <img class="group-small-avatar" src="{{asset('public/img/default-group.png')}}" alt="avatar" width="24" height="24">
            @endif

            <div class="group-info">
                <div class="group-info1">
                    <p class="group-name">{{$group->name}}</p>
                    <p class="text-muted">{{__('menu.Author')}}: {{$group->group_creator->name}}</p>
                    <p class="text-muted">{{__('menu.Type')}}: {{$group->type}}</p>
                    <p class="text-muted">{{__('menu.Created')}}: {{$group->created_at}}</p>
                </div>
                <div class="group-info2">
                    <p class="text-muted">{{__('menu.Partitipants')}}: {{count($group->partitipantss)}}</p>
                    <p class="text-muted">{{__('menu.Messagess')}}: {{count($group->messagee)}}</p>
                </div>
            </div>
        </div>
        </a>
    @endforeach
</div><!--groups list-->
</div>

@else
<p>{{__('menu.User_no_groups')}}.</p>
@endif

<div class="card subscriptions-list">
    <div class="card-header">{{__('menu.Subscriptions')}}</div>
    <div class="card-body justify-content-start col border-bottom">
        <p class="subs-title">{{__('menu.Tags')}}:</p>
        @if( $sub_tags != null and count($sub_tags) > 0 )
            <div class="subs border">
                @foreach( $sub_tags as $tag )
                <div class="sub-tag border-bottom">
                    <p>
                        <a href="{{asset('tag/' . $tag->id)}}">
                        {{(isset($tag->name)) ? mb_substr($tag->name, 0, 50) : ''}}
                        </a>
                    </p>
                </div>
                @endforeach
            </div>
        @else
            {{__('menu.NoSubscriptions')}}.
        @endif
    </div><!--tags-->

    <div class="card-body justify-content-start col">
        <p class="subs-title">{{__('menu.Authors')}}:</p>
        @if( $sub_authors != null and count($sub_authors) > 0 )
            <div class="subs border">
                @foreach( $sub_authors as $author )
                <div class="sub-author border-bottom">
                    <p>
                        <a href="{{asset('user/' . $author->id)}}">
                        {{(isset($author->name)) ? mb_substr($author->name, 0, 50) : ''}}
                        </a>
                    </p>
                </div>
                @endforeach
            </div>
        @else
            {{__('menu.NoSubscriptions')}}.
        @endif
    </div><!--authors-->
</div><!--suscriptions-->

@else
  <p>{{__('menu.NothingFind')}}.</p>
@endif

@endsection