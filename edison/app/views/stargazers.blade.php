@extends('layouts.base')
@section('header')
  <title>startgazers</title>
@stop
@section('content')
@foreach ($ids as $id)
  {{ $id }}
@endforeach
@stop
