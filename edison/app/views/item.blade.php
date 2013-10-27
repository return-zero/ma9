@extends('layouts.base')
@section('header')
@parent
{{ HTML::style('css\items.css') }}
@stop
@section('content')

<div class="row">
  <div class="col-lg-9">
    <p id="item_date"><strong>{{ $item->created_at }} 投稿</strong></p>
    <p id="item_title">{{ $item->title }}</p>
    <div id="content" class="well">
      {{ $item->content }}
    </div>
  </div>
  <div class="col-lg-3">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-4">
          <img src="{{ $user->profile_image_url }}">
        </div>
        <div class="col-lg-8">
          <p><a href="/{{ $user->screen_name }}">{{ $user->screen_name }}</a></p>
          <p><span class="glyphicon glyphicon-star"></span> {{ $star_count }} <span class="glyphicon glyphicon-file"></span> {{ $work_count }}</p>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-1">
      <span class="label label-default">登録タグ</span>
    </div>
    <div class="col-lg-8">
      <div id="tags">
        <p>
          @foreach ($tags as $tag)
            <nobr>{{ $tag }}<a href="http://dic.nicovideo.jp/a/{{ $tag }}"><img src="http://nicotrends.net/images/dic.png"></a></nobr>
          @endforeach
        </p>
      </div>
    </div>
    <div class="col-lg-3">
    @if (Auth::check())
      @if ($star_status == true)
        <button class="btn btn-warning" id="star">
          <i class="glyphicon glyphicon-star"></i>
        </button>
        <a href="/{{ $user->screen_name }}/items/{{ $item->id }}/stargazers"><span class="badge"> {{ $star_gazers_num }}</span></a>
      @else
        <button class="btn btn-default" id="star">
          <i class="glyphicon glyphicon-star"></i>
        </button>
        <a href="/{{ $user->screen_name }}/items/{{ $item->id }}/stargazers"><span class="badge"> {{ $star_gazers_num }}</span></a>
      @endif
    @else
      <a href="/">
      <button class="btn btn-default" id="star">
        <i class="glyphicon glyphicon-star"></i>
      </button>
      </a>
    @endif
    </div>
  </div>
</div>

@if ($item->type == 'video')
  <a href="#work-form" class="btn btn-primary btn-lg" data-toggle="modal">動画を投稿する</a>
@else
  <a href="#work-form" class="btn btn-primary btn-lg" data-toggle="modal">絵を投稿する</a>
@endif

<!-- Work Form Modal -->
  <div class="modal fade" id="work-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">作品投稿</h4>
        </div>
        <div class="modal-body">
          {{ Form::open(array('url' => "work/create/$item->id", 'method'=>'post', 'role' => 'form', 'name' => 'workInfo')) }}
            <div class="form-group">
              <label>作品のURL</label>
              <input type="text" name="url" class="form-control" ng-model="url" ng-pattern="{{ $pattern }}" required>
              <p class="help-block">投稿するニコニコ動画または静画のURLを入力して下さい</p>
              <p class="help-block">http://www.nicovideo.jp/watch/sm***</p>
              <p class="help-block">http://seiga.nicovideo.jp/seiga/im***</p>
            </div>
            <div class="form-group">
              <label>コメント</label>
              {{ Form::textarea('comment', '', array('class' => 'form-control', 'rows' => 3)) }}
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary" ng-disabled="workInfo.$invalid">投稿する</button>
          </div>
        {{ Form::close() }}
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


<div class="row">
  <h2>投稿作品</h2>
  <div class="job">
    @foreach ($works as $work)
      <img src="{{ $work->thumbnail_url }}" class="img-thumbnail">{{ $work->title }}
    @endforeach
  </div>
</div>

<div class="row">
  <h3><span class="glyphicon glyphicon-chevron-right">関連作品</span></h3>
  @if ($related_works)
    <div class="relatedworks-body">
      <ul class="list">
        @foreach ($related_works as $related_work)
          <li class="relatedwork">
            <div class="relatedwork_thumb">
              @if ($item->type == 'video')
                <a href="http://www.nicovideo.jp/watch/{{ $related_work['cmsid'] }}" target="_blank">
              @else
                <a href="http://seiga.nicovideo.jp/seiga/{{ $related_work['cmsid'] }}" target="_blank">
              @endif
                  <img src="{{ $related_work['thumbnail_url'] }}" />
                </a>
            </div>
            <div class="relatedwork_content">
              <p class="relatedwork_title">
                @if ($item->type == 'video')
                  <a href="http://www.nicovideo.jp/watch/{{ $related_work['cmsid'] }}">{{ $related_work['title'] }}</a>
                @else
                  <a href="http://seiga.nicovideo.jp/seiga/{{ $related_work['cmsid'] }}">{{ $related_work['title'] }}</a>
                @endif
              </p>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
  @else
    <p>関連作品はありません</p>
  @endif
</div>

<div class="row" id="comment_area">
  <div class="comment_header">
    <h3><span class="glyphicon glyphicon-comment"></span> コメント</h3>
  </div>
  @foreach ($comments as $comment)
    <div class="comment row">
      <div class="user_data pull-left col-lg-1">
        <div class="user_icon">
          <img src="{{ $comment->user->profile_image_url }}">
        </div>
        <div class="screen_name">
          <a href="/{{ $comment->user->screen_name }}">{{ $comment->user->screen_name }}</a>
        </div>
      </div>
      <div class="comment_box well col-lg-11">
        <div class="comment_text">{{{ $comment->comment }}}</div>
        <div class="comment_status">{{ $comment->created_at }}</div>
      </div>
    </div>
  @endforeach
</div>
<div class="row">
  <div class="comment_header">
    <h3><span class="glyphicon glyphicon-comment"></span> コメントを書く</h3>
  </div>
  {{ Form::open(array('url' => "$user->screen_name/items/$item->id/comment/new", 'method'=>'post')) }}
    <div class="form-group">
      {{ Form::textarea('comment', '', array('class' => 'form-control', 'rows' => '5')) }}
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary">コメントする</button>
    </div>
  {{ Form::close() }}
</div>
@stop
