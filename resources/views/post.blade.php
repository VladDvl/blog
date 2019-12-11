@extends('layouts.base')

@section('styles')
  @parent
  <link href="{{asset('public/css/maintext.css')}}" rel="stylesheet"/>
@endsection

@section('scripts')
  @parent
  <script src="{{asset('public/src/ckeditor5-build-classic/ckeditor.js')}}"></script>
  <script src="{{asset('public/js/ckcreate.js')}}"></script>
@endsection

@section('header')
  <div id="block-header" class="jumbotron p-4 p-md-5 text-white rounded bg-dark">
    <div class="">
      <h1 class="col-md-6 font-italic">{{isset($one->category->name) ? $one->category->name : ''}}</h1>
      <p class="col-md-6 font-italic"><a href="{{asset('cat/' . $one->category->slug)}}">К другим постам в категории</a></p>
      <!--<p class="lead my-3">Это блог со статьями на различные тематики. Здесь пишут о программировании, играх и др. Статьи обсуждают в комментариях под ними. Для комментирования нужно зарегистрироваться.</p>-->
      <!--<p class="lead mb-0"><a href="{{asset('#')}}" class="text-white font-weight-bold">Continue reading...</a></p>-->
    </div>
  </div>
@endsection

@section('content')
      
      <div class="blog-post container">
        <h2 class="blog-post-title">{{(isset($one->title)) ? $one->title : ''}}</h2>
        @include('templates.links')
        @if($one->image)
          <img src="{{asset('public/uploads/'.$one->image)}}"/>
        @endif
        <p>{!!isset($one->body) ? $one->body : ''!!}</p>
      </div><!-- /.blog-post -->

      <h3 class="text-muted">Комментарии</h3>

      @foreach($objs as $obj)
      <div id="comment" class="blog-post body-maintext">
        <div class="row">
        @include('templates.coms')
        <div class="col justify-content-between container">
          @if($obj->image)
            <img src="{{asset('public/uploads/'.$obj->image)}}"/>
          @endif
          <div>{!!isset($obj->body) ? $obj->body : ''!!}</div>
        </div>
        </div>
        <p class="blog-post-meta">Опубликовано: {{(isset($obj->created_at)) ? $obj->created_at : ''}}</p>
      </div><!-- post-comment -->
      @endforeach

      <div class="card">
        <div class="card-header">Добавить Комментарий</div>
        <div class="card-body">
        @guest
          @if (Route::has('register'))
            <a href="{{asset('home')}}">Только авторизированные пользователи могут оставлять комментарии.</a>
          @endif
          @else
          <form method="post" action="{{asset('post/' . $one->slug)}}" enctype="multipart/form-data">
            {!!csrf_field()!!}
            @if(count($errors)>0)
              @foreach($errors->all() as $ers)
                <div class="red">
                  {{$ers}}
                </div>
              @endforeach
            @endif
            <div class="form-group">
              <label for="editor">Описание</label>
              <textarea class="form-control" id="editor" name="body"></textarea>
            </div>
            <div class="form-group">
              <label for="postImage">Изображение</label>
              <input type="file" class="form-control" id="postImage" name="picture1" placeholder="Изображение">
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
          </form>
        @endguest
        </div>
      </div>

	  
@endsection