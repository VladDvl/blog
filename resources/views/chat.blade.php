@extends('layouts.base')

@section('scripts')
  @parent
@endsection

@section('styles')
  @parent
  <link href="{{asset('public/css/home.css')}}" rel="stylesheet"/>
@endsection

@section('content')
  <div class="card bg-light rounded chat-block">
    <div class="card-header">{{__('menu.Messages')}}</div>

    <div class="card-body justify-content-start col chat-field">
      <div>
        hello {{$slug}}
      </div>
      <div>
        {{__('menu.NoMessages')}}.
      </div>
    </div>

    <div class="chat-form-block border">
      <form class="chat-form">
        <div>
          <textarea></textarea>
          <input type="hidden" value="{{(isset(Auth::user()->id)) ? Auth::user()->id : ''}}">
          <button type="submit" name="submit">{{__('menu.Send')}}</button>
        </div>
      </form>
    </div>

  </div>
@endsection