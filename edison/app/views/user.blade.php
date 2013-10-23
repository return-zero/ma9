@extends('layouts.base')
@section('header')
@parent
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
		<div class="row">
			<div class="col-lg-6" style="background:yellow;">
				<p><a href="/{{ $screen_name }}/stars">スター数：{{ $star_num }}</a></p>
			</div>
			<div class="col-lg-6" style="background:orange;">
				hoge
			</div>
		</div>
		
	</div>
</div>
<!-- /.row -->
<hr>
<p>star_num: {{ $star_num }}</p>
<p>screen_name: {{ $screen_name }}</p>
<p>name: {{ $name }}</p>
<p>description: {{ $desc }}</p>
<img src="{{ $icon }}">
@foreach ($items as $item)
	<p>items: {{ $item['item_id'] }}</p>
  <p>items: {{ $item['title'] }}</p>
  @if ($screen_name == Auth::user()->screen_name)
    <div>
      {{ Form::open(array('url' => "/{$screen_name}/items/{$item['item_id']}/delete", 'method' => 'post')) }}
        <button type="submit">delete</buton>
      {{ Form::close() }}
    </div>
  @endif
@endforeach

@stop
