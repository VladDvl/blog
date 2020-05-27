@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/maintext.css')}}" rel="stylesheet"/>
@endsection

@section('content')
<div class="blog-post body-maintext">
  <p>{{__('menu.NothingFind')}}.</p>
</div><!-- /.blog-post -->
@endsection