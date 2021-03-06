@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/home.css')}}" rel="stylesheet"/>
@endsection

@section('scripts')
  @parent
  <script src="{{asset('public/src/ckeditor5-build-classic/ckeditor.js')}}"></script>
  <script src="{{asset('public/js/ckcreate.js')}}"></script>
  <script src="{{asset('public/js/home.js')}}"></script>
@endsection

@section('content')

<div class="card">
    <div class="card-header">{{__('menu.Groups')}}</div>

    <div class="card-body create-group justify-content-start col border-bottom">
        <form method="post" action="{{asset('group/create')}}" enctype="multipart/form-data">
            {!!csrf_field()!!}
            @if(count($errors)>0)
                @foreach($errors->all() as $ers)
                    <div class="red">
                        {{$ers}}
                    </div>
                @endforeach
            @endif
            <div class="form-group">
                <label for="groupName">{{__('menu.CreateGroup')}}</label>
                <div class="row row-form">
                    <input type="text" class="form-control col-form" id="groupName" name="name" placeholder="{{__('menu.GroupName')}}">
                    <button type="submit" class="btn btn-primary col col-form" name="submit">{{__('menu.Create')}}</button>
                </div>
                <label for="pubcic">Public</label>
                <input type="radio" checked id="public" name="type" value="public">
                <label for="private">Private</label>
                <input type="radio" id="private" name="type" value="private">
            </div>
        </form>
    </div><!--create group form-->

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
                            <p class="text-muted">{{__('menu.Partitipants')}}: {{$group->partitipantss_count}}</p>
                            <p class="text-muted">{{__('menu.Messagess')}}: {{count($group->messagee)}}</p>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div><!--groups list-->          
</div><!--groups-->

<div class="card">
    <div class="card-header">{{__('menu.Messages')}}</div>
    <div class="card-body justify-content-start col friend-list">
        @if(count($friends) != 0)
            @foreach($friends as $friend)
                <a class="friend-link" href="{{asset('chat/' . $friend->id)}}">
                    <div class="msg-friend row">

                        @if( $friend->avatar != 'users/default.png' and $friend->avatar != '' )
                            <img class="friend-avatar" src="{{asset('public/uploads/avatars/' . $friend->avatar)}}" width="36" height="36" alt="avatar">
                        @else
                            <img class="friend-avatar" src="{{asset('public/img/default-avatar.png')}}" width="36" height="36" alt="avatar">
                        @endif

                        <div class="col msg-items">
                            <p class="friend-name">{{$friend->name}}</p>

                            <div class="msg row justify-content-between">
                                @if( isset($friend->last_message_sender) == true and isset($friend->last_message_resiver) == true )
                                    @if( $friend->last_message_sender->created_at > $friend->last_message_resiver->created_at )
                                        <div class="row msg-user">
                                            <p class="msg-body">{{mb_substr($friend->last_message_sender->body, 0, 55)}}..</p>
                                        </div>
                                        <p class="msg-date">{{$friend->last_message_sender->created_at}}</p>
                                    @else
                                        <div class="row msg-user">
                                            @if( Auth::user()->avatar != 'users/default.png' and Auth::user()->avatar != '' )
                                                <img class="small-avatar" src="{{asset('public/uploads/avatars/' . Auth::user()->avatar)}}" width="24" height="24">
                                            @else
                                                <img class="small-avatar" src="{{asset('public/img/default-avatar.png')}}" width="24" height="24">
                                            @endif
                                            <p class="msg-body">{{mb_substr($friend->last_message_resiver->body, 0, 55)}}..</p>
                                        </div>
                                        <p class="msg-date">{{$friend->last_message_resiver->created_at}}</p>
                                    @endif
                                @endif
                                @if( isset($friend->last_message_sender) == true and isset($friend->last_message_resiver) != true )
                                    <div class="row msg-user">
                                        <p class="msg-body">{{mb_substr($friend->last_message_sender->body, 0, 55)}}..</p>
                                    </div>
                                    <p class="msg-date">{{$friend->last_message_sender->created_at}}</p>
                                @endif
                                @if( isset($friend->last_message_sender) != true and isset($friend->last_message_resiver) == true )
                                    <div class="row msg-user">
                                        @if( Auth::user()->avatar != 'users/default.png' and Auth::user()->avatar != '' )
                                            <img class="small-avatar" src="{{asset('public/uploads/avatars/' . Auth::user()->avatar)}}" width="24" height="24">
                                        @else
                                            <img class="small-avatar" src="{{asset('public/img/default-avatar.png')}}" width="24" height="24">
                                        @endif
                                        <p class="msg-body">{{mb_substr($friend->last_message_resiver->body, 0, 55)}}..</p>
                                    </div>
                                    <p class="msg-date">{{$friend->last_message_resiver->created_at}}</p>
                                @endif
                            </div>
                        </div>

                    </div>
                </a>
            @endforeach
        @else
            <div>
                {{__('menu.NoMessages')}}.
            </div>
        @endif
    </div>
</div><!--chats-->

<div class="card notifications">
    <div class="card-header">
        <p>{{__('menu.Notifications')}}</p>
        @if( count($notifications) > 0 )
            <div>
                <form method="post" action="{{asset('notifications-delete')}}">
                    {!!csrf_field()!!}
                    @if(count($errors)>0)
                        @foreach($errors->all() as $ers)
                            <div class="red">
                                {{$ers}}
                            </div>
                        @endforeach
                    @endif
                    <button class="btn btn-primary" type="submit" name="user_id" value="{{Auth::user()->id}}">
                        {{__('menu.DeleteAll')}}
                    </button>
                </form>
            </div>
        @endif
    </div>
    <div class="card-body justify-content-start col">
        @if( count($notifications) > 0 )
            @foreach( $notifications as $notification )
                @if( $notification->read_at == null )
                    <div class="notification notification-unread">
                        <div class="notification-msg">
                            <p>{{$notification->data['message']}} <span class="text-muted">({{$notification->created_at}})</span></p>
                            <form method="post" action="{{asset('notification-read')}}">
                                {!!csrf_field()!!}
                                @if(count($errors)>0)
                                    @foreach($errors->all() as $ers)
                                        <div class="red">
                                            {{$ers}}
                                        </div>
                                    @endforeach
                                @endif
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <button class="btn notification-btn btn-primary" type="submit" name="notification_id" value="{{$notification->id}}">
                                    {{__('menu.MarkAsRead')}}
                                </button>
                            </form>
                        </div>
                        <div class="notification-info">
                            <p class="text-muted author-name">
                                {{__('menu.Author')}}: 
                                <a href="{{asset('user/' . $notification->data['author_id'])}}">
                                    {{mb_substr($notification->data['author_name'], 0, 20)}}
                                </a>
                            </p>
                            <p class="text-muted post-title">
                                {{__('menu.Title')}}: 
                                <a href="{{asset('post/' . $notification->data['post_slug'])}}">
                                    {{mb_substr($notification->data['post_title'], 0, 50)}}
                                </a>
                            </p>
                        </div>
                    </div><!--notification-unread-->
                @else
                    <div class="notification notification-read">
                        <div class="notification-msg">
                            <p>{{$notification->data['message']}} <span class="text-muted">{{$notification->created_at}}</span></p>
                            <form method="post" action="{{asset('notification-delete')}}">
                                {!!csrf_field()!!}
                                @if(count($errors)>0)
                                    @foreach($errors->all() as $ers)
                                        <div class="red">
                                            {{$ers}}
                                        </div>
                                    @endforeach
                                @endif
                                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                                <button class="btn notification-btn btn-primary" type="submit" name="notification_id" value="{{$notification->id}}">
                                    {{__('menu.Delete')}}
                                </button>
                            </form>
                        </div>
                        <div class="notification-info">
                            <p class="text-muted author-name">
                                {{__('menu.Author')}}: 
                                <a href="{{asset('user/' . $notification->data['author_id'])}}">
                                    {{mb_substr($notification->data['author_name'], 0, 20)}}
                                </a>
                            </p>
                            <p class="text-muted post-title">
                                {{__('menu.Title')}}: 
                                <a href="{{asset('post/' . $notification->data['post_slug'])}}">
                                    {{mb_substr($notification->data['post_title'], 0, 50)}}
                                </a>
                            </p>
                        </div>
                    </div><!--read-notification-->
                @endif
            @endforeach
        @else
            {{__('menu.NoNotifications')}}.
        @endif
    </div>
</div><!--notifications-->

<div class="card subscriptions-list">
    <div class="card-header subs-list-header">
        <p>{{__('menu.Subscriptions')}}</p>
        <p><a href="{{asset('feed')}}">{{__('menu.Feed')}}</a></p>
    </div>
    <div class="card-body justify-content-start col border-bottom">
        <p class="subs-title">{{__('menu.Tags')}}:</p>
        @if( $sub_tags != null and count($sub_tags) > 0 )
            <div class="subs border">
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
                    @foreach( $sub_tags as $tag )
                        <div class="sub-tag border-bottom">
                            <p>
                                <a href="{{asset('tag/' . $tag->id)}}">
                                    {{(isset($tag->name)) ? mb_substr($tag->name, 0, 50) : ''}}
                                </a>
                            </p>
                            <button class="unsub-button btn btn-primary" type="submit" name="tag_id" value="{{$tag->id}}">
                                {{__('menu.UnSubscribe')}}
                            </button>
                        </div>
                    @endforeach
                </form>
            </div>
        @else
            {{__('menu.NoSubscriptions')}}.
        @endif
    </div><!--tags-->

    <div class="card-body justify-content-start col">
        <p class="subs-title">{{__('menu.Authors')}}:</p>
        @if( $sub_authors != null and count($sub_authors) > 0 )
            <div class="subs border">
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
                    @foreach( $sub_authors as $author )
                        <div class="sub-author border-bottom">
                            <p>
                                <a href="{{asset('user/' . $author->id)}}">
                                    {{(isset($author->name)) ? mb_substr($author->name, 0, 50) : ''}}
                                </a>
                            </p>
                            <button class="unsub-button btn btn-primary" type="submit" name="author_id" value="{{$author->id}}">
                                {{__('menu.UnSubscribe')}}
                            </button>
                        </div>
                    @endforeach
                </form>
            </div>
        @else
            {{__('menu.NoSubscriptions')}}.
        @endif
    </div><!--authors-->
</div><!--suscriptions-->

<div class="card">
    <div class="card-header">{{__('menu.Avatar')}}</div>
    <div class="card-body justify-content-start row">
        @if( Auth::user()->avatar != 'users/default.png' and Auth::user()->avatar != '' )
            <img src="{{asset('public/uploads/avatars/' . Auth::user()->avatar)}}" alt="avatar">
        @else
            <img src="{{asset('public/img/default-avatar.png')}}" alt="avatar">
        @endif

        <form class="col" method="post" action="{{asset('home/avatar')}}" enctype="multipart/form-data">
            {!!csrf_field()!!}
            @if(count($errors)>0)
                @foreach($errors->all() as $ers)
                    <div class="red">
                        {{$ers}}
                    </div>
                @endforeach
            @endif
            <div id="input-avatar-div" class="form-group row">
                <button id="input-avatar-button" type="submit" class="btn btn-primary" name="action" value="change">{{__('menu.Change')}}</button>
                <input id="input-avatar-img" type="file" class="col form-control" id="avatarImage" name="avatar1" placeholder="Изображение">
            </div>
            <div id="delete-avatar-div" class="form-group">
                <button id="delete-avatar-button" type="submit" class="btn btn-primary" name="action" value="delete">{{__('menu.Delete')}}</button>
            </div>
        </form>
    </div>
</div><!--avatar-->

<div class="card">
    <div class="card-header">{{__('menu.AddPost')}}</div>

    <div class="card-body">
        <form method="post" action="{{asset('home')}}" enctype="multipart/form-data">
            {!!csrf_field()!!}
            @if(count($errors)>0)
                @foreach($errors->all() as $ers)
                    <div class="red">
                        {{$ers}}
                    </div>
                @endforeach
            @endif
            <div class="form-group">
                <label for="postName">{{__('menu.Title')}}</label>
                @if( !empty($post_id) )
                  <input type="text" class="form-control" id="postName" name="title" value="{{$edit_post->title}}">
                @else
                  <input type="text" class="form-control" id="postName" name="title" placeholder="{{__('menu.WriteTitle')}}">
                @endif
            </div>
            <div class="form-group">
                <label for="editor">{{__('menu.Description')}}</label>
                @if( !empty($post_id) )
                  <textarea class="form-control" id="editor" name="body">{!!$edit_post->body!!}</textarea>
                @else
                  <textarea class="form-control" id="editor" name="body"></textarea>
                @endif
            </div>
            <label for="Category">{{__('menu.Category')}}</label>
            <select class="form-group" id="Category" name="category_id">
                @if( !empty($post_id) )

                    @if( App::getLocale() == 'en')
                        <option selected value="{{$edit_post->category->id}}">{{ucfirst($edit_post->category->slug)}}</option>
                    @else
                        <option selected value="{{$edit_post->category->id}}">{{ucfirst($edit_post->category->name)}}</option>
                    @endif

                    @foreach($cats as $cat)
                        @if( App::getLocale() == 'en')
                            <option value="{{$cat->id}}">{{ucfirst($cat->slug)}}</option>
                        @else
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endif
                    @endforeach

                @else

                    @foreach($cats as $cat)
                        @if( App::getLocale() == 'en')
                            <option value="{{$cat->id}}">{{ucfirst($cat->slug)}}</option>
                        @else
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endif
                    @endforeach

                @endif
            </select>
            <div class="form-group">
                <label for="postImage">{{__('menu.Image')}}</label>
                <input type="file" class="form-control" id="postImage" name="picture1" placeholder="Изображение">
            </div>
            @if( !empty($post_id) )
                <button type="submit" class="btn btn-primary" name="update" value="{{$edit_post->id}}">{{__('menu.Save')}}</button>
            @else
                <button type="submit" class="btn btn-primary" name="create">{{__('menu.Save')}}</button>
            @endif
        </form>
    </div>
</div><!--post create-->

<form id="table-form" method="post" action="{{asset('home/table')}}" enctype="multipart/form-data">
    {!!csrf_field()!!}
    @if(count($errors)>0)
        @foreach($errors->all() as $ers)
            <div class="red">
                {{$ers}}
            </div>
        @endforeach
    @endif

    <table class="home-table">
        <tr>
            <th>{{__('menu.Title')}}</th>
            <th>{{__('menu.Category')}}</th>
            <th>{{__('menu.Short')}}</th>
            <th>{{__('menu.Comments')}}</th>
            <th>{{__('menu.Created')}}</th>
            <th>{{__('menu.Updated')}}</th>
            <th>{{__('menu.Actions')}}</th>
        </tr>
        @foreach($objs as $one)
        <tr>
            <td><a href="{{asset('post/' . $one -> slug)}}">{{isset($one->title) ? $one->title : ''}}</a></td>
            @if( App::getLocale() == 'en')
                <td><a href="{{asset('cat/' . $one->category->slug)}}">{{isset($one->category->slug) ? ucfirst($one->category->slug) : ''}}</a></td>
            @else
                <td><a href="{{asset('cat/' . $one->category->slug)}}">{{isset($one->category->name) ? $one->category->name : ''}}</a></td>
            @endif
            <td>{!!isset($one->body) ? mb_substr($one->body, 0, 95) : ''!!}</td>
            <td>{{__('menu.Comments')}}: {{isset($one->comments) ? $one->comments : ''}}</td>
            <td>{{isset($one->created_at) ? $one->created_at : ''}}</td>
            <td>{{isset($one->updated_at) ? $one->updated_at : ''}}</td>
            <td>
                <button class="edit-post-button btn btn-primary" type="sybmit" name="edit" value="{{$one->id}}">{{__('menu.Edit')}}</button><br>
                <button class="delete-post-button btn btn-primary" type="sybmit" name="delete" value="{{$one->id}}">{{__('menu.Delete')}}</button>
            </td>
        </tr>
        @endforeach
    </table>
    <div>{!!$objs->links()!!}</div>
</form><!--table posts-->

@endsection
