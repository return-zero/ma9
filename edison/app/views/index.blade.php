@extends('layouts.base')
@section('header')
  <title>welcome</title>
@stop
@section('content')
<div class="container hero-unit">
  <h1>Hello World!</h1>
  <p>これはapp/views/hello.blade.phpファイルです</p>
</div>

 @if (Auth::check())
  {{ Auth::user()->screen_name }}ログイン中
  <a href="/logout">ログアウト</a>
  <a href="/{{ Auth::user()->screen_name }}">マイページやで</a>
@else
  ログインしてまへん
  <a href="/login">ログイン</a>
@endif
  
@stop
