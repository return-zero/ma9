@extends('layouts.base')
@section('header')
  <title>
    @if ( Auth::user()->screen_name === $screen_name )
      My Page
    @else
      About {{ $screen_name }}
    @endif
  </title>
@stop
@section('content')
<div class="container hero-unit">
  <h1>My Page</h1>
  <p>screen_name: {{ $screen_name }}</p>
  <p>name: {{ $name }}</p>
  <p>description: {{ $desc }}</p>
  <img src="{{ $icon }}">
  @foreach ($items as $item)
    <p>items: {{ $item['title'] }}</p>
  @endforeach
</div>
@stop