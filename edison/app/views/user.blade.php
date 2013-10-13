@extends('layouts.base')
@section('header')
  <title>
    {{--@if ( Auth::user()->screen_name === $screen_name )
      My Page
    @else
      About {{ $screen_name }}
    @endif
    --}}
  </title>
@stop
@section('content')
<h1>{{ $screen_name }} さんのページ</h1>
<div class="row">
	<div class="col-lg-9" style="background:skyblue;">
	  @foreach ($items as $item)
	    <h3><a href="/{{ $screen_name }}/items/{{ $item['item_id'] }}">{{ $item['title'] }}</a></h3>
	  @endforeach
	</div>
	<div class="col-lg-3" style="background:blue;">
		<img src="{{ $icon }}">
		<div class="row">
			<div class="col-lg-3" style="background:yellow;">
				<p>NAME:</p>
			</div>
			<div class="col-lg-9" style="background:orange;">
				<p>{{ $name }}</p>
			</div>
		</div>
		
	</div>
</div>
<!-- /.row -->
<hr>
<p>screen_name: {{ $screen_name }}</p>
<p>name: {{ $name }}</p>
<p>description: {{ $desc }}</p>
<img src="{{ $icon }}">
@foreach ($items as $item)
	<p>items: {{ $item['item_id'] }}</p>
  <p>items: {{ $item['title'] }}</p>
@endforeach

@stop