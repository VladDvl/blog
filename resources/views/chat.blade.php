@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/chat.css')}}" rel="stylesheet"/>
@endsection

@section('scripts')
  @parent
  <script src="{{asset('public/js/chat.js')}}"></script>
@endsection

@section('content')
  <div class="card bg-light rounded chat-block">
    <div class="card-header">{{__('menu.Messages')}}</div>

    <div class="card-body justify-content-start col chat-field">
      @if(count($objs) > 0)
        @foreach($objs as $one)
          <div class="chat-message border rounded">
            <div class="justify-content-between">
              <div class="chat-message-author">{{$one->sender->name}}:</div>
              <div class="text-muted">{{$one->created_at}}</div>
            </div>
            <p>{{$one->body}}</p>
          </div>
        @endforeach
      @else
        <div>
          {{__('menu.NoMessages')}}.
        </div>
      @endif
    </div><!--chat-->

    <div class="chat-form-block border">
      <form class="chat-form" method="post" action="{{asset('chat/send')}}" enctype="multipart/form-data">
        {!!csrf_field()!!}
        @if(count($errors)>0)
          @foreach($errors->all() as $ers)
            <div class="red">
              {{$ers}}
            </div>
          @endforeach
        @endif
        <div>
          <textarea name="body"></textarea>
          <input type="hidden" name="resiver_id" value="{{(isset($slug)) ? $slug : ''}}">
          <button type="submit" name="submit">{{__('menu.Send')}}</button>
        </div>
      </form>
    </div><!--chat-form-->

  </div><!--chat-block-->
@endsection