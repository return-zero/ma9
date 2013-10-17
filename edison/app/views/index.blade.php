@extends('layouts.base')
@section('header')
@parent
@stop
@section('content')
<div class="col-lg-9">
  <h3>ほしいものをお願いしてみよう。</h3>
  <a class="btn btn-primary" href="new">アイデアを投稿する</a>
  <ul class="nav nav-tabs">
    <li class="active"><a href="#">すべての投稿</a></li>
    <li><a href="#">最近の作品</a></li>
  </ul>
</div>
<div class="col-lg-3">
  <img src="{{ Auth::user()->profile_image_url }}" />
  {{ Auth::user()->screen_name }}
  <p><a href="stars">stared</a></p>
</div>
@stop
