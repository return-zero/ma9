@extends('layouts.base')
@section('header')
  <title>item</title>
@stop
@section('content')
<div class="container hero-unit">
  <h1>Item</h1>
  <p>title: {{ $title }}</p>
  <p>content: {{ $content }}</p>
  <p>created_at: {{ $created_at }}</p>
  <p>updated_at: {{ $updated_at }}</p>
</div>
@stop
