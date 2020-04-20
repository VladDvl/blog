@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/chat.css')}}" rel="stylesheet"/>
@endsection

@section('scripts')
  @parent
  <script src="{{asset('public/js/chat.js')}}"></script>
  <script src="{{asset('public/js/private-chat.js')}}"></script>
@endsection

@section('content')
  <div class="card bg-light rounded messages-block">
    <div class="card-header">{{__('menu.Messages')}}</div>

    <div id="display-private" class="card-body justify-content-start col messages-field">
      @if(count($objs) > 0)
        @foreach($objs as $one)
          <div class="message">

            @if( $one->sender->avatar != 'users/default.png' and $one->sender->avatar != '' )
              <img class="message-avatar" src="{{asset('public/uploads/avatars/' . $one->sender->avatar)}}" width="36" height="36" alt="avatar">
            @else
              <img class="message-avatar" src="{{asset('public/img/default-avatar.png')}}" width="36" height="36" alt="avatar">
            @endif

            <div class="mssg">
              
            <div class="justify-content-between message-info">
              <div class="message-author"><a href="{{asset('user/' . $one->sender->id)}}">{{$one->sender->name}}:</a></div>
              <div class="text-muted message-time">{{$one->created_at}}</div>
            </div>

            <p class="message-body">{{$one->body}}</p>

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
      <form class="messages-form" method="post" action="{{asset('chat/send')}}" enctype="multipart/form-data">
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
          <input id="resiver" type="hidden" name="resiver_id" value="{{(isset($slug)) ? $slug : ''}}">
          <button type="submit" name="submit">{{__('menu.Send')}}</button>
        </div>
      </form>
    </div><!--chat-form-->

  </div><!--chat-block-->
@endsection