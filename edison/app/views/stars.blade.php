@extends('layouts.base')
@section('header')
  <title>{{ Auth::user()->screen_name }}'s Stars</title>
@stop
@section('content')

@foreach ($star_items as $star_item)
-----------------<br>
  Item title: {{ $star_item['title'] }}<br>
  Content: {{ $star_item["content"] }}<br>
  Category: {{ $star_item["category"] }}<br>
  Type: {{ $star_item["type"] }}<br>
<br>
@endforeach
@stop