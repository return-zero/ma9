@extends('layouts.base')
@section('css')
@parent
{{ HTML::style('css\index.css') }}
@stop
@section('header')
@parent
@stop
@section('content')
<div class="col-lg-9 content-wrapper">
  <div class="header">
    <h3>ほしい動画、絵をお願いしてみよう。</h3>
    <a class="btn btn-primary" href="new">ほしいもの・アイデアを投稿する</a>
  </div>
  <ul id="stream-tab" class="nav nav-tabs">
    <li class="active"><a href="#items" data-toggle="tab">最近の投稿</a></li>
    <li><a href="#works" data-toggle="tab">最近の作品</a></li>
  </ul>
  <div id="item-content" class="streams tab-content">
    <div class="item-stream tab-pane fade in active" id="items">
      @foreach ($all_items as $item)
        <div class="items">
          <div class="item-inner">
            <div class="icon">
              <img src="">
            </div>
            <div class="item-content">
              <div class="action">
                <a href="{{ $item->screen_name }}">{{ $item->screen_name }}</a> が{{ $item->created_at }}に投稿しました
              </div>
              <div class="item-title">
                <a href="{{ $item->screen_name }}/items/{{ $item->id }}">{{ $item->title }}</a><span class="catgory label label-default">{{ $categories["$item->category"]}}</span>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      <!--<div class="more">
        <div class="more-button btn btn-default btn-block">もっと見る</div>
      </div>-->
    </div>
    <div class="recent-stream tab-pane fade" id="works">
      @foreach ($recent_works as $work)
        <div class="works">
          <div class="work-inner">
            <div class="icon">
              <img src="">
            </div>
            <div class="work-content">
              <div class="action">
                <a href="{{ $work->screen_name }}">{{ $work->screen_name }}</a> が{{ $work->created_at }}に投稿しました
              </div>
              <div class="work-title">
                <a href="{{ $work->item_poster_screen_name }}/items/{{ $work->item_id }}">{{ $work->url }}</a><span class="catgory label label-default">{{ $categories["$work->item_category"] }}</span>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
<div class="col-lg-3">
  <div class="profile well">
    @if (Auth::check())
      <div class="left">
        <img alt="{{ Auth::user()->screen_name }}" src="{{ $icon }}" title="{{ Auth::user()->screen_name }}">
      </div>
      <div class="right">
        <div class="screen_name">
          <a href="{{ Auth::user()->screen_name }}">{{ Auth::user()->screen_name }}</a>
        </div>
        <div class="starts">
          <a href="{{ Auth::user()->screen_name }}/stars">{{ $star_count }} stars</a>
        </div>
      </div>
    @endif
  </div>
  <a class="twitter-timeline" href="https://twitter.com/edi_soso" data-widget-id="393429954483855360">@edi_soso からのツイート</a>
  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</div>
@stop
