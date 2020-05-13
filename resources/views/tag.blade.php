@extends('layouts.base')

@section('scripts')
  @parent
@endsection

@section('styles')
  @parent
@endsection

@section('content')

@if(count($objs) > 0)
    <p>{{$tag->name}}</p>
    @foreach($objs as $obj)
    <p>{{$obj->title}}</p>
    @endforeach
    <div>{!! $objs->links() !!}</div>
@else
    <p>{{__('menu.NothingFind')}}.</p>
@endif

@endsection