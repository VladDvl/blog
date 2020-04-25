@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/chat.css')}}" rel="stylesheet"/>
  <link href="{{asset('public/css/group.css')}}" rel="stylesheet"/>
@endsection

@section('scripts')
  @parent
  <script src="{{asset('public/js/chat.js')}}"></script>
  <script src="{{asset('public/js/group.js')}}"></script>
  <!--<script src="{{asset('public/js/private-chat.js')}}"></script>-->
@endsection

@section('content')

  @if( $obj->user_id == Auth::user()->id )
    <div class="card bg-light rounded">
      <div class="card-header text-muted">Добавить участников</div>

      <div class="border-bottom">
        <form method="post" action="{{asset('group/add')}}" enctype="multipart/form-data">
          {!!csrf_field()!!}
          @if(count($errors)>0)
            @foreach($errors->all() as $ers)
              <div class="red">
                {{$ers}}
              </div>
            @endforeach
          @endif

          <select class="form-group" name="user_id">
            @foreach($users as $user)
              <option class="form-control" value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
          </select>

          <input type="hidden" name="group_id" value="{{$slug}}">
          <button type="submit" name="submit">{{__('menu.Add')}}</button>
        </form>
      </div>

      <div class="card-body justify-content-start col">
        <p class="text-muted">Заявки на добавление:</p>

      </div>
    </div><!--partitipants-->

    <div class="card">
      <div class="card-header text-muted">{{__('menu.GroupAvatar')}}</div>
      <div class="card-body justify-content-start row">
        @if( $obj->avatar != '' )
          <img src="{{asset('public/uploads/group-avatars/' . $obj->avatar)}}" width="100" height="100" alt="avatar">
        @else
          <img src="{{asset('public/img/default-group.png')}}" width="100" height="100" alt="avatar">
        @endif

        <form class="col" method="post" action="{{asset('group/group-avatar')}}" enctype="multipart/form-data">
          {!!csrf_field()!!}
          @if(count($errors)>0)
            @foreach($errors->all() as $ers)
              <div class="red">
                {{$ers}}
              </div>
            @endforeach
          @endif
          <input type="hidden" name="group_id" value="{{$slug}}">
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
  @endif

  <div class="card bg-light rounded messages-block">

    <div class="card-header group-header">
      @if($obj->avatar != '')
        <img class="group-avatar" src="{{asset('public/uploads/group-avatars/' . $obj->avatar)}}" width="52" height="52" alt="avatar">
      @else
        <img class="group-avatar" src="{{asset('public/img/default-group.png')}}" width="52" height="52" alt="avatar">
      @endif
      <span class="text-muted">{{__('menu.Group')}}:</span> {{$obj->name}}
    </div>

    <div id="display-private" class="card-body justify-content-start col messages-field">
      @if( count($messages) > 0 )
        @foreach($messages as $msg)
          <div class="message">
            
            @if( $msg->sender->avatar != 'users/default.png' and $msg->sender->avatar != '' )
              <img class="message-avatar" src="{{asset('public/uploads/avatars/' . $msg->sender->avatar)}}" width="36" height="36" alt="avatar">
            @else
              <img class="message-avatar" src="{{asset('public/img/default-avatar.png')}}" width="36" height="36" alt="avatar">
            @endif

            <div class="mssg">

            <div class="justify-content-between message-info">
              <div class="message-author"><a href="{{asset('user/' . $msg->sender->id)}}">{{$msg->sender->name}}:</a></div>
              <div class="text-muted message-time">{{$msg->created_at}}</div>
            </div>

            <p class="message-body">{{$msg->body}}</p>

            </div>

          </div><!--message-->
        @endforeach
      @else
        <div>
          {{__('menu.NoMessages')}}.
        </div>
      @endif
    </div><!--chat-->

    <div class="messages-form-block border">
      <form class="messages-form" method="post" action="{{asset('group/send')}}" enctype="multipart/form-data">
        {!!csrf_field()!!}
        @if(count($errors)>0)
          @foreach($errors->all() as $ers)
            <div class="red">
              {{$ers}}
            </div>
          @endforeach
        @endif
        <div>
          <textarea name="body" placeholder="{{__('menu.WriteMessage')}}"></textarea>
          <input id="sender" type="hidden" name="sender_id" value="{{(isset(Auth::user()->id)) ? Auth::user()->id : ''}}">
          <input id="group" type="hidden" name="group_id" value="{{(isset($slug)) ? $slug : ''}}">
          <button type="submit" name="submit">{{__('menu.Send')}}</button>
        </div>
      </form>
    </div><!--chat-form-->

  </div><!--chat-block-->
@endsection