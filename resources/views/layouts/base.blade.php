
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="It blog">

    <title>Blog Template · Bootstrap</title>

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
        <!--<a class="text-muted" href="{{asset('#')}}">Subscribe</a>-->
      </div>
      <div id="site-logo" class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="{{asset('/')}}">Blog</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <!--<a class="text-muted" href="{{asset('#')}}">
          <svg xmlns="{{asset('http://www.w3.org/2000/svg')}}" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
        </a>--><!--Search-->
		    @guest
          <a class="btn btn-sm btn-outline-secondary" href="{{asset('login')}}">Sign in</a>
          @if (Route::has('register'))
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          @endif
          @else
            <a class="text-muted" href="{{asset('home')}}">
              <img id="avatarka" src="{{asset('public/img/raccoon.svg')}}" width="30" height="30" alt="avatar">
            </a><!--avatarka-->
            <a class="nav-link dropdown-toggle" href="{{asset('home')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
              {{ Auth::user()->name }}
            </a>
            <a class="dropdown-item" href="{{ route('logout') }}"
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
      <div class="container pb-4 mb-4 border-bottom font-italic justify-content-between align-items-center row">
        <h3>
          Публикации
        </h3>
        <b><a id="artdate" href="{{asset('#')}}">Выбрать дату</a></b>
      </div>

@yield('content')

      <!--<nav class="blog-pagination">
        <a id="tuda" class="btn btn-outline-primary" href="{{asset('#')}}"><- Сюда</a>
        <a id="suda" class="btn btn-outline-secondary" href="{{asset('#')}}" tabindex="-1" aria-disabled="true">Туда -></a>
      </nav>-->

    </div><!-- /.blog-main -->

    <aside class="col-md-4 blog-sidebar">
      <div class="p-4">
        <h4 class="font-italic">Топ теги</h4>
        <a href="{{asset('#')}}">тег</a>,
        <a href="{{asset('#')}}">тег</a>,
        <a href="{{asset('#')}}">тег</a>,
        <a href="{{asset('#')}}">тег</a>,
        <a href="{{asset('#')}}">тег</a>,
        <a href="{{asset('#')}}">тег</a>,
        <a href="{{asset('#')}}">тег</a>,
        <a href="{{asset('#')}}">тег</a>,
        <a href="{{asset('#')}}">тег</a>,
        <a href="{{asset('#')}}">тег</a><br>
        <a href="{{asset('#')}}">Все теги</a>
      </div><!--tags-->

      <div class="p-4 mb-3 bg-light rounded">
        <h4 class="font-italic">Топ пользователи</h4>
        <p> за месяц | за все время</p>
        <ol class="list-unstyled mb-0">
        <li><a href="{{asset('#')}}">Вася</a></li>
        <li><a href="{{asset('#')}}">Петя</a></li>
        <li><a href="{{asset('#')}}">Енот</a></li>
        </ol>
      </div><!--top users-->

      <div class="p-4">
        <h4 class="font-italic">Лучшее</h4>
        <p> за месяц | за все время</p>
        <ol class="list-unstyled mb-0">
          <li><a href="{{asset('#')}}">Статья</a></li>
          <li><a href="{{asset('#')}}">Статья</a></li>
          <li><a href="{{asset('#')}}">Статья</a></li>
          <li><a href="{{asset('#')}}">Статья</a></li>
          <li><a href="{{asset('#')}}">Статья</a></li>
          <li><a href="{{asset('#')}}">Статья</a></li>
          <li><a href="{{asset('#')}}">Статья</a></li>
          <li><a href="{{asset('#')}}">Статья</a></li>
          <li><a href="{{asset('#')}}">Статья</a></li>
          <li><a href="{{asset('#')}}">Статья</a></li>
          <li><a href="{{asset('#')}}">Статья</a></li>
          <li><a href="{{asset('#')}}">Статья</a></li>
        </ol>
      </div><!--best articles-->

      <div class="p-4">
        <h4 class="font-italic">Комментарий дня</h4>
        <a href="{{asset('#')}}">Коммент</a>
      </div><!--daily comment-->

      <div class="p-4">
        <h4 class="font-italic">Посетители</h4>
        <p>Авторизованных: </p>
        <p>Неавторизованных: </p>
      </div><!--visitiors-->

      <div class="p-4">
        <h4 class="font-italic">Информация</h4>
        <ol class="list-unstyled">
          <li><a href="{{asset('#')}}">О сайте</a></li>
          <li><a href="{{asset('#')}}">Пользователи</a></li>
          <li><a href="{{asset('#')}}">Правила</a></li>
          <li><a href="{{asset('#')}}">Конфиденциальность</a></li>
          <li><a href="{{asset('#')}}">Контакты</a></li>
          <li><a href="{{asset('#')}}">Услуги</a></li>
        </ol>
      </div><!--info-->
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
