@extends('layouts.base')
@section('header')
@parent
@stop
@section('content')
@for ($i=0, $k=0; $i < count($users)/4; $i++)
  <div class="row">
    @for ($j=$k; $j < ($i+1)*4; $j++,$k=$j)
      @if (isset($users[$j][0]))
        <div class="col-lg-3">
          <div class="content-wrapper">
            <img src="{{ $users[$j][0]->profile_image_url }}">
            <a href="/{{ $users[$j][0]->screen_name }}">{{ $users[$j][0]->screen_name }}</a>
          </div>
        </div>
      @endif
    @endfor
  </div>
@endfor
@stop
