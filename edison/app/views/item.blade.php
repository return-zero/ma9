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
  @foreach ($tags as $tag)
    <p>tags: {{ $tag }}</p>
  @endforeach
</div>
{{ Form::open(array('url' => "$screen_name/items/$id/favorite", 'method' => 'POST')) }}
  {{ Form::hidden('id', $id) }}
  <button type="submit" class="btn btn-default">Fav</button>
{{ Form::close() }}
@stop
