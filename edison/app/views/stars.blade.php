@extends('layouts.base')
@section('header')
  <title>stars</title>
@stop
@section('content')
@foreach ($star_items as $star_item)
  {{ $star_item }}
@endforeach
@stop