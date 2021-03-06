@extends('layouts.base')
@section('css')
@parent
{{ HTML::style('css\user.css') }}
{{ HTML::style('css\stream.css') }}
@stop
@section('header')
@parent
@stop
@section('content')
<div class="content-wrapper">
  <div class="header">
    <h2>
      <img class="" src="{{ $user->profile_image_url }}">
      {{ $user->screen_name }} <a href="https://twitter.com/{{ $user->screen_name }}" target="_blank"><i class="fa fa-twitter"></i></a>
    </h2>
    <p><span class="glyphicon glyphicon-star"></span> {{ $star_count }} <span class="glyphicon glyphicon-file"></span> {{ $work_count }}</p>
  </div>
	<hr>
	<div class="tab-wrapper">
		<ul id="stream-tab" class="nav nav-tabs">
		  <li class="active"><a href="#items" data-toggle="tab">最近の投稿</a></li>
		  <li><a href="#works" data-toggle="tab">最近の作品</a></li>
		  <li><a href="#stars" data-toggle="tab">スターした投稿</a></li>
		</ul>
		<div class="streams tab-content">
		  <div class="tab-pane fade in active" id="items">
		    @foreach ($items as $item)
		      <div class="items">
		        <div class="item-inner">
		          <div class="item-content">
		            <div class="item-title">
                  <a href="{{ $user->screen_name }}/items/{{ $item->id }}">{{ $item->title }}</a>
                  <span class="pull-right"><span class="glyphicon glyphicon-comment"></span> {{ $item->comment_count }}</span>
                  <a class="star-badge pull-right" href="/{{ $item->user->screen_name }}/items/{{ $item->id }}/stargazers"><span class="label label-warning"><span class="glyphicon glyphicon-star"></span> {{ $item->star_count }}</span></a>
                  @if ($item->category)
                    <span class="catgory label label-default">{{ $categories["$item->category"]}}</span>
                  @endif
                  @if ($item->type == 'video')
                    <i class="fa fa-film"></i> 
                  @else
                    <i class="fa fa-picture-o"></i> 
                  @endif
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
                <div class="row">
                  <div class="col-lg-2"><a href="{{ $work->url }}" target="_blank"><img class="img-thumbnail" src="{{ $work->thumbnail_url }}"></a></div>
                  <div class="col-lg-10">
                    <div class="work-title">
                      <p><a href="{{ $work->url }}" target="_blank">{{ $work->title }}</a></p>
                    </div>
                    <a href="{{ $work->item->user->screen_name }}/items/{{ $work->item->id }}">{{ $work->item->title }}</a> に投稿しました
                    @if ($work->item_category)
                      <span class="catgory label label-default">{{ $categories["$work->item_category"] }}</span>
                    @endif
                    @if ($work->item->type == 'video')
                      <i class="fa fa-film"></i> 
                    @else
                      <i class="fa fa-picture-o"></i> 
                    @endif
                  </div>
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
                  <a href="{{ $star->item->user->screen_name }}/items/{{ $star->item_id }}">{{ $star->item->title }}</a>
                  <span class="pull-right"><span class="glyphicon glyphicon-comment"></span> {{ $star->item->comment_count }}</span>
                    <a class="star-badge pull-right" href="/{{ $star->item->user->screen_name }}/items/{{ $star->item->id }}/stargazers"><span class="label label-warning"><span class="glyphicon glyphicon-star"></span> {{ $star->item->star_count }}</span></a>
                  @if ($star->item->category)
                    <span class="catgory label label-default">{{ $categories[$star->category_name] }}</span>
                  @endif
                  @if ($star->item->type == 'video')
                    <i class="fa fa-film"></i> 
                  @else
                    <i class="fa fa-picture-o"></i> 
                  @endif
		            </div>
		          </div>
		        </div>
		      </div>
		    @endforeach
		  </div>
    </div>
	</div>
</div>
@stop
