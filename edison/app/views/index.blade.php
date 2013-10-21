@extends('layouts.base')
@section('header')
@parent
@stop
@section('content')
<div class="col-lg-9">
  <div class="header">
    <h3>ほしいものをお願いしてみよう。</h3>
    <a class="btn btn-primary" href="new">ほしいもの・アイデアを投稿する</a>
  </div>
  <ul id="stream-tab" class="nav nav-tabs">
    <li class="active"><a href="#">すべての投稿</a></li>
    <li><a href="#">最近の作品</a></li>
  </ul>
  <div id="item-content" class="streams">
    <div class="public-stream">
      @foreach ($items as $item)
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
                <a href="{{ $item->screen_name }}/items/{{ $item->id }}">{{ $item->title }}</a><span class="catgory"><a href="tag/{{ $item->category }}">{{ $categories["$item->category"]}}</a></span>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      <div class="more">
        <div class="more-button btn btn-default btn-block">もっと見る</div>
      </div>
    </div>
    <div class="recent-works">
    </div>
  </div>
</div>
<div class="col-lg-3">
  @if (Auth::check())
    <img src="" />
    {{ Auth::user()->screen_name }}
  <p><a href="{{ Auth::user()->screen_name }}/stars">stared</a></p>
  @endif
</div>
@stop
