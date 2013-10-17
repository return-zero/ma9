@extends('layouts.base')
@section('header')
@parent
@stop
@section('content')
@foreach ($ids as $id)
  {{ $id }}
@endforeach
@stop
