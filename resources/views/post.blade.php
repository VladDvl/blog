@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/maintext.css')}}" rel="stylesheet"/>
@endsection

@section('header')
  <div id="block-header" class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="">
      <h1 class="col-md-6 font-italic">{{isset($one->category_id) ? $one->category_id : ''}}</h1>
      <p class="col-md-6 font-italic"><a href="{{isset($one->category_id) ? $one->category_id : ''}}">К другим постам в категории</a></p>
      <!--<p class="lead my-3">Это блог со статьями на различные тематики. Здесь пишут о программировании, играх и др. Статьи обсуждают в комментариях под ними. Для комментирования нужно зарегистрироваться.</p>-->
      <!--<p class="lead mb-0"><a href="{{asset('#')}}" class="text-white font-weight-bold">Continue reading...</a></p>-->
    </div>
  </div>
@endsection

@section('content')
      
      <div class="blog-post body-maintext">
        <h2 class="blog-post-title">{{(isset($one->title)) ? $one->title : ''}}</h2>
        <div class="row justify-content-between pb-4 mb-4 border-bottom container">
        <p class="blog-post-meta">Автор: <a href="{{(isset($one->author_id)) ? $one->author_id : ''}}">user_name</a></p>
        <p class="blog-post-meta">Опубликовано: {{(isset($one->creted_at)) ? $one->craated_at : ''}}</p>
        </div>

        <p>{!!isset($one->body) ? $one->body : ''!!}</p>
      </div><!-- /.blog-post -->
	  
@endsection