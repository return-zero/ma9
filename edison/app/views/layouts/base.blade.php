<!DOCTYPE HTML>
<html ng-app>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    @section('css')
    {{ HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css') }}
    {{ HTML::style('http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css') }}
    <!--{{ HTML::style('css/edison-bootstrap-min.css') }}-->
    {{ HTML::style('http://getbootstrap.com/examples/sticky-footer-navbar/sticky-footer-navbar.css') }}
    {{ HTML::style('css\base.css') }}
    <link href='http://fonts.googleapis.com/css?family=Joti+One' rel='stylesheet' type='text/css'>
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
            {{ HTML::link('/', 'edison (α)', array('class'=>'navbar-brand', 'id'=>'title-font')) }}
          </div>
          <div class="collapse navbar-collapse">
            @if (Auth::check())
              <ul class="nav navbar-nav navbar-right">
                <li class="active" id="js-notice" data-toggle="dropdown"><a href=""></a></li>
                <ul class="dropdown-menu" role="menu" aria-labelledby="js-drop">
                  <li role="presentation" class="notice-content"></li>
                </ul>
                <li><a href="/item/new">投稿する</a></li>
                <li id="fat-menu" class="dropdown">
                  <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->screen_name }}<b class="caret"></b></a>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="drop">
                    <li role="presenattion"><a role="menuitem" tabindex="-1" href="/{{ Auth::user()->screen_name }}">マイページ</a></li>
                    <li role="presentation"><a role="menuitem" tabindex="-1" href="/logout">ログアウト</a></li>
                  </ul>
                </li>
              </ul>
              @else
                {{ Form::open(array('url' => '/login', 'method' => 'POST', 'class' => 'navbar-form navbar-right')) }}
                  <button type="submit" class="btn btn-success">ログイン</button>
                {{ Form::close() }}
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
    {{ HTML::script('bower_components/angular/angular.js') }}
    
    @show
  </body>
</html>
