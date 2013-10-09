<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    @section('css')
    {{ HTML::style('http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css') }}
    {{ HTML::style('css\base.css') }}
    @show
    @section('header')
    <title>edison</title>
    @show
  </head>
  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
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
          <ul class="nav navbar-nav">
            <li class="active">{{ HTML::link('#', 'Home') }}</li>
            <li>{{ HTML::link('#about', 'About') }}</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="container">
      @yield('content')
    </div>
    <footer>
      <h4>ma9</h4>
    </footer>
    @section('js')
    {{ HTML::script('http://code.jquery.com/jquery-1.9.1.min.js') }}
    {{ HTML::script('http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js') }}
    @show
  </body>
</html>
