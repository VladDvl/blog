@extends('layouts.base')

@section('scripts')
  @parent
@endsection

@section('styles')
  @parent
  <link href="{{asset('public/css/chat.css')}}" rel="stylesheet"/>
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
      <form class="chat-form">
        <div>
          <textarea></textarea>
          <input type="hidden" value="{{(isset(Auth::user()->id)) ? Auth::user()->id : ''}}">
          <button type="submit" name="submit">{{__('menu.Send')}}</button>
        </div>
      </form>
    </div><!--chat-form-->

  </div><!--chat-block-->
@endsection