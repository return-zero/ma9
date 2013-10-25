@extends('layouts.base')
@section('css')
@parent
{{ HTML::style('css\user.css') }}
@stop
@section('header')
@parent
@stop
@section('content')
<div class="col-lg-9 content-wrapper">
	<h2>{{ $screen_name }} <a href="https://twitter.com/{{ $screen_name }}">twitter logo</a></h2>
	<hr>
	<div class="tab-wrapper">
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#items" data-toggle="tab">最近の投稿</a></li>
		  <li><a href="#works" data-toggle="tab">最近の作品</a></li>
		  <li><a href="#stars" data-toggle="tab">スターした投稿</a></li>
		</ul>
		<div id="stream-tab" class="streams tab-content">
		  <div class="tab-pane fade in active" id="items">
		    @foreach ($items as $item)
		      <div class="items">
		        <div class="item-inner">
		          <div class="item-content">
		            <div class="item-title">
		              <a href="{{ $screen_name }}/items/{{ $item->id }}">{{ $item->title }}</a><span class="catgory label label-default">{{ $categories["$item->category"]}}</span>
		            </div>
		          </div>
		        </div>
		      </div>
		    @endforeach
		  </div>
		  <div class="tab-pane fade" id="works">
		    @foreach ($works as $work)
		      <div class="items">
		        <div class="item-inner">
              <div class="item-content">
                <div class="action">
                  <a href="{{ $work->item_poster_screen_name }}/items/{{ $work->item_id }}">{{ $work->item_title }}</a> への投稿
                </div>
		            <div class="item-title">
		              <a href="{{ $work->url }}" target="_blank">{{ $work->url }}</a><span class="catgory label label-default">{{ $categories["$work->item_category"] }}</span>
		            </div>
		          </div>
		        </div>
		      </div>
		    @endforeach
		  </div>
		  <div class="tab-pane fade" id="stars">
		    @foreach ($stars as $star)
		      <div class="items">
		        <div class="item-inner">
		          <div class="item-content">
		            <div class="item-title">
		              <a href="{{ $star['poster_screen_name'] }}/items/{{ $star['item_id'] }}">{{ $star['title'] }}</a><span class="catgory label label-default">{{ $categories[$star['category']] }}</span>
		            </div>
		          </div>
		        </div>
		      </div>
		    @endforeach
		  </div>
    </div>
	</div>
</div>
<div class="col-lg-3">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-lg-4">
        <img class="pull-left" src="{{ $icon }}">
      </div>
      <div class="col-lg-8">
        <p><a href="/{{ $screen_name }}">{{ $screen_name }}</a></p>
      </div>
    </div>
  </div>
</div>
@stop
