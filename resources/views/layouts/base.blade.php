<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="It blog">

    <title>Blog</title>

    <link href="{{asset('public/img/favicon.png')}}" rel="shortcut icon" type="image/png">
	  <link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
	  <link href="{{asset('public/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/fonts.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/blog.css')}}" rel="stylesheet">
    @section('styles')
    @show
  </head>
  <body>
    <div class="container">
  <header id="header" class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <p class="text-muted">
          <?php
            echo date('l, F jS Y');
          ?>
        </p>
      </div>
      <div id="site-logo" class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="{{asset('/')}}">Blog</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
		    @guest
          <a class="btn btn-sm btn-outline-secondary" href="{{asset('login')}}">Sign in</a>
          @if (Route::has('register'))
            <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">{{ __('Register') }}</a>
          @endif
          @else
            <a class="text-muted" href="{{asset('home')}}">
            @if( Auth::user()->avatar != 'users/default.png' and Auth::user()->avatar != '' )
              <img id="avatarka" src="{{asset('public/uploads/avatars/' . Auth::user()->avatar)}}" width="36" height="36" alt="avatar">
            @else
              <img id="avatarka" src="{{asset('public/img/default-avatar.png')}}" width="36" height="36" alt="avatar">
            @endif
            </a><!--avatarka-->
            <a class="btn btn-sm btn-outline-secondary user" href="{{asset('home')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>
            <a class="btn-outline-secondary logout" href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
        @endguest
      </div>
    </div>
  </header>

  <div id="nav-category" class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      @foreach($test as $cat)
        <a class="p-2 text-muted" href="{{asset('cat/' . $cat->slug)}}">{{$cat->name}}</a>
      @endforeach
    </nav>
  </div>

@yield('header')

    </div>

<main role="main" class="container">
  <div class="row">
    <div class="col-md-8 blog-main">
      <div id="block-article-head" class="container pb-4 mb-4 border-bottom font-italic justify-content-between align-items-center row">
        <h3>
          Публикации
        </h3>
        <!--<b><a id="artdate" href="{{asset('#')}}">Выбрать дату</a></b>-->
      </div>

@yield('content')

      <!--<nav class="blog-pagination">
        <a id="tuda" class="btn btn-outline-primary" href="{{asset('#')}}"><- Сюда</a>
        <a id="suda" class="btn btn-outline-secondary" href="{{asset('#')}}" tabindex="-1" aria-disabled="true">Туда -></a>
      </nav>-->

    </div><!-- /.blog-main -->

    <aside class="col-md-4 blog-sidebar">

      <div class="p-4 mb-3 bg-light rounded">
        <h4 class="font-italic">Новые пользователи</h4>
        <ol class="list-unstyled mb-0">
        @foreach($usrs as $user)
          <li><a href="{{(isset($user->id)) ? $user->id : ''}}">{{$user->name}}</a></li>
        @endforeach
        </ol>
      </div><!--top users-->

      <div class="p-4">
        <h4 class="font-italic">Самое просматриваемое</h4>
        <ol class="mb-0">
        @foreach($posts as $post)
          <li><a href="{{asset('post/' . $post->slug)}}">{{mb_substr($post->title, 0, 50)}}..</a></li>
        @endforeach
        </ol>
      </div><!--best articles-->

      <div class="p-4">
        <h4 class="font-italic">Последний комментарий</h4>
        <a href="{{asset('post/' . $comment->postss->slug)}}">{!!mb_substr($comment->body, 0, 95)!!}</a>
      </div><!--daily comment-->

      <div class="p-4">
        <h4 class="font-italic">Информация</h4>
        <p>Пользователей: {{$all_userss}}</p>
        <p>Статей: {{$all_postss}}</p>
        <p>Комментариев: {{$all_commentss}}</p>
      </div><!--visitiors-->

    </aside><!-- /.blog-sidebar -->

  </div><!-- /.row -->

</main><!-- /.container -->

<footer class="blog-footer">
  <p>Blog built by <a href="{{asset('https://github.com/VladDvl')}}">VladDvl</a>.</p>
  <p>
    <a href="{{asset('#')}}">Back to top</a>
  </p>
  <!--<p>
    <a href="{{asset('#')}}">Настройки языка</a>
  </p>-->
</footer>
@section('scripts')
  <script src="{{asset('public/src/jquery-3.4.1.min.js')}}"></script>
@show
</body>
</html>
