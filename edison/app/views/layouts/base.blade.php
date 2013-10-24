<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    @section('css')
    <!-- {{ HTML::style('http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css') }} -->
    {{ HTML::style('css/edison-bootstrap-min.css') }}
    {{ HTML::style('http://getbootstrap.com/examples/sticky-footer-navbar/sticky-footer-navbar.css') }}
    {{ HTML::style('css\base.css') }}
    @show
    @section('header')
    <title>{{ $title }} - edison</title>
    @show
  </head>
  <body>
    <div id="wrap">
      <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            {{ HTML::link('/', 'えじそん', array('class'=>'navbar-brand')) }}
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
              @if (Auth::check())
              <li class="active" id="js-notice" data-toggle="dropdown"><a href=""></a></li>
              <ul class="dropdown-menu" role="menu" aria-labelledby="js-drop">
              <li role="presentation" class="notice-content"></li>
            
              </ul>
              <li><a href="/new">投稿する</a></li>
                <li id="fat-menu" class="dropdown">
                  <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->screen_name }}<b class="caret"></b></a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="drop">
                    <li role="presenattion"><a role="menuitem" tabindex="-1" href="/{{ Auth::user()->screen_name }}">マイページ</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="/logout">ログアウト</a></li>
                  </ul>
                </li>
              @else
                <li><a href="login">ログイン</a></li>
              @endif
            </ul>
          </div>
        </div>
      </div>
      <div class="container">
        @yield('content')
      </div>
    </div>
    
    <div id="footer">
    	<div class="container">
      	<p class="text-muted credit">WHC <a href="http://ma9.mashupaward.jp">Mashup Awards 9</a></p>
      </div>
		</div>
    @section('js')
    {{ HTML::script('http://code.jquery.com/jquery-1.10.1.min.js') }}
    {{ HTML::script('http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js') }}
    {{ HTML::script('js/app.min.js') }}
    
    @show
  </body>
</html>
