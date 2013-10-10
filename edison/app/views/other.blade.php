@extends('layouts.base')
@section('header')
  <title></title>
@stop
@section('content')
<div class="container hero-unit">
  <h1>My Page</h1>
  <p>screen_name: {{ $screen_name }}</p>
  <p>name: {{ $name }}</p>
  <p>description: {{ $desc }}</p>
</div>
@stop
