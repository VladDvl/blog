@extends('layouts.base')

@section('styles')
  @parent
@endsection

@section('scripts')
  @parent
@endsection

@section('content')
  <div class="card bg-light rounded container">
    <p>{{__('menu.NoGroups')}}.</p>
  </div>
@endsection