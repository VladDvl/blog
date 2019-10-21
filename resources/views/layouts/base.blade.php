
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">

    <title>Blog Template · Bootstrap</title>

	<link href="{{asset('public/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/fonts.css')}}" rel="stylesheet">
    <link href="{{asset('public/css/blog.css')}}" rel="stylesheet">
  </head>
  <body>
    <div class="container">
  <header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="text-muted" href="{{asset('#')}}">Subscribe</a>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="{{asset('home')}}">Large</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="text-muted" href="{{asset('#')}}">
          <svg xmlns="{{asset('http://www.w3.org/2000/svg')}}" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24" focusable="false"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
        </a>
        
		@guest
                            
                                <a class="btn btn-sm btn-outline-secondary" href="{{asset('login')}}">Sign in</a>
                            
                            @if (Route::has('register'))
                               
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                
                            @endif
                        @else
							
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

  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
      <a class="p-2 text-muted" href="{{asset('#')}}">World</a>
      <a class="p-2 text-muted" href="{{asset('#')}}">U.S.</a>
      <a class="p-2 text-muted" href="{{asset('#')}}">Technology</a>
      <a class="p-2 text-muted" href="{{asset('#')}}">Design</a>
      <a class="p-2 text-muted" href="{{asset('#')}}">Culture</a>
      <a class="p-2 text-muted" href="{{asset('#')}}">Business</a>
      <a class="p-2 text-muted" href="{{asset('#')}}">Politics</a>
      <a class="p-2 text-muted" href="{{asset('#')}}">Opinion</a>
      <a class="p-2 text-muted" href="{{asset('#')}}">Science</a>
      <a class="p-2 text-muted" href="{{asset('#')}}">Health</a>
      <a class="p-2 text-muted" href="{{asset('#')}}">Style</a>
      <a class="p-2 text-muted" href="{{asset('#')}}">Travel</a>
    </nav>
  </div>

@yield('header')

    </div>

<main role="main" class="container">
  <div class="row">
    <div class="col-md-8 blog-main">
      <h3 class="pb-4 mb-4 font-italic border-bottom">
        From the Firehose
      </h3>

@yield('content')
<!-- /.blog-post -->

      <nav class="blog-pagination">
        <a class="btn btn-outline-primary" href="{{asset('#')}}">Older</a>
        <a class="btn btn-outline-secondary disabled" href="{{asset('#')}}" tabindex="-1" aria-disabled="true">Newer</a>
      </nav>

    </div><!-- /.blog-main -->

    <aside class="col-md-4 blog-sidebar">
      <div class="p-4 mb-3 bg-light rounded">
        <h4 class="font-italic">About</h4>
        <p class="mb-0">Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
      </div>

      <div class="p-4">
        <h4 class="font-italic">Archives</h4>
        <ol class="list-unstyled mb-0">
          <li><a href="{{asset('#')}}">March 2014</a></li>
          <li><a href="{{asset('#')}}">February 2014</a></li>
          <li><a href="{{asset('#')}}">January 2014</a></li>
          <li><a href="{{asset('#')}}">December 2013</a></li>
          <li><a href="{{asset('#')}}">November 2013</a></li>
          <li><a href="{{asset('#')}}">October 2013</a></li>
          <li><a href="{{asset('#')}}">September 2013</a></li>
          <li><a href="{{asset('#')}}">August 2013</a></li>
          <li><a href="{{asset('#')}}">July 2013</a></li>
          <li><a href="{{asset('#')}}">June 2013</a></li>
          <li><a href="{{asset('#')}}">May 2013</a></li>
          <li><a href="{{asset('#')}}">April 2013</a></li>
        </ol>
      </div>

      <div class="p-4">
        <h4 class="font-italic">Elsewhere</h4>
        <ol class="list-unstyled">
          <li><a href="{{asset('#')}}">GitHub</a></li>
          <li><a href="{{asset('#')}}">Twitter</a></li>
          <li><a href="{{asset('#')}}">Facebook</a></li>
        </ol>
      </div>
    </aside><!-- /.blog-sidebar -->

  </div><!-- /.row -->

</main><!-- /.container -->

<footer class="blog-footer">
  <p>Blog template built for <a href="{{asset('https://getbootstrap.com/')}}">Bootstrap</a> by <a href="{{asset('https://twitter.com/mdo')}}">@mdo</a>.</p>
  <p>
    <a href="{{asset('#')}}">Back to top</a>
  </p>
</footer>
</body>
</html>
