@extends('layouts.base')
@section('header')
@parent
@stop
@section('content')
<img src="{{ $icon }}">
<h3>{{ $screen_name }}</h3>
<hr>
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
          <div class="icon">
            <img src="">
          </div>
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
      <div class="works">
        <div class="work-inner">
          <div class="work-content">
            <div class="work-title">
              <a href="{{ $work->item_poster_screen_name }}/items/{{ $work->item_id }}">{{ $work->url }}</a><span class="catgory label label-default">{{ $categories["$work->item_category"] }}</span>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="tab-pane fade" id="stars">
    <!--@foreach ($works as $work)
      <div class="stars">
        <div class="star-inner">
          <div class="star-content">
            <div class="star-title">
              <a href="{{ $star->item_poster_screen_name }}/items/{{ $star->item_id }}">{{ $star->item_title }}</a><span class="catgory label label-default">{{ $categories["$star->item_category"] }}</span>
            </div>
          </div>
        </div>
      </div>
    @endforeach-->
  </div>
</div>
@stop
