@extends('layouts.base')
@section('header')
@parent
{{ HTML::style('css\items.css') }}
@stop
@section('content')

<div class="row">
  <div class="col-lg-9">
    <div class="content-wrapper">
      <span class="item-date">{{ $item->created_at }} 投稿</span>
      <a class="star-badge" href="/{{ $user->screen_name }}/items/{{ $item->id }}/stargazers"><span class="label label-warning"><span class="glyphicon glyphicon-star"></span> {{ $star_gazers_num }}</span></a>
      <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-hashtags="edisoso">ツイート</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
      @if (Auth::check())
        @if (Auth::user()->screen_name === $user->screen_name)
          <span class="item-delete"><button class="btn btn-danger btn-sm pull-right" id="js-delete-item">この投稿を削除する</button></span>
        @endif
        @if ($star_status == true)
          <button class="btn btn-warning btn-sm pull-right" id="star">
            <i class="glyphicon glyphicon-star"></i> スターしない
          </button>
        @else
          <button class="btn btn-default btn-sm pull-right" id="star">
            <i class="glyphicon glyphicon-star"></i> スターする
          </button>
        @endif
      @else
        <a href="/">
        <button class="btn btn-default btn-sm pull-right" id="star">
          <i class="glyphicon glyphicon-star"></i> スターする
        </button>
        </a>
      @endif
      
      <div class="clearfix"></div>
      <div class="item-title">
        {{ $item->title }}
      </div>
      <span class="item-content">{{ $item->content }}</span>
      
      <div class="row tags">
        <div class="col-lg-1">
          <span class="label label-default">登録タグ</span>
        </div>
        <div class="col-lg-11">
          <div id="tags">
            <p>
              @foreach ($tags as $tag)
                <nobr>{{ $tag }}<a href="http://dic.nicovideo.jp/a/{{ $tag }}" target="_blank"><img src="http://nicotrends.net/images/dic.png"></a></nobr>
              @endforeach
            </p>
          </div>
        </div>
      </div>
      
      <hr>
      <h4><span class="glyphicon glyphicon-file"></span> 投稿作品</h4>
      @foreach ($works as $work)
        <div class="items">
          <div class="item-inner">
            <div class="icon">
              <img src="">
            </div>
            <div class="item-content">
              <div class="row">
                <div class="col-lg-2"><a href="{{ $work->url }}" target="_blank"><img class="img-thumbnail" src="{{ $work->thumbnail_url }}"></a></div>
                <div class="col-lg-10">
                  <div class="work-title">
                    <p><a href="{{ $work->url }}">{{ $work->title }}</a></p>
                  </div>
                  <p><img src="{{ $work->user->profile_image_url }}"><a href="/{{ $work->user->screen_name }}">{{ $work->user->screen_name }}</a> が投稿しました</p>
                  <p>{{ $work->comment }}</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      <div class="submit-button-wrapper">
        @if ($item->type == 'video')
          <a href="#work-form" class="btn btn-primary pull-right" data-toggle="modal">動画を投稿する</a>
        @else
          <a href="#work-form" class="btn btn-primary pull-right" data-toggle="modal">絵を投稿する</a>
        @endif
      </div>
      <div class="clearfix"></div>
      
      <hr>
      <h4><span class="glyphicon glyphicon-chevron-right"></span> 関連作品</h4>
      @if ($related_works)
        <div class="row">
          @foreach ($related_works as $related_work)
            <div class="col-lg-2">
              <div class="related_work_thumb" style="overflow: hidden">
                @if ($item->type == 'video')
                  <a href="http://www.nicovideo.jp/watch/{{ $related_work['cmsid'] }}" target="_blank">
                @else
                  <a href="http://seiga.nicovideo.jp/seiga/{{ $related_work['cmsid'] }}" target="_blank">
                @endif
                    <img class="img-thumbnail" src="{{ $related_work['thumbnail_url'] }}" />
                  </a>
              </div>
              <div class="relatedwork_content">
                <p class="relatedwork_title">
                  @if ($item->type == 'video')
                    <a href="http://www.nicovideo.jp/watch/{{ $related_work['cmsid'] }}" target="_blank">{{ $related_work['title'] }}</a>
                  @else
                    <a href="http://seiga.nicovideo.jp/seiga/{{ $related_work['cmsid'] }}" target="_blank">{{ $related_work['title'] }}</a>
                  @endif
                </p>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <p>関連作品はありません</p>
      @endif
      <div class="clearfix"></div>
      
      <hr>
      <h4><span class="glyphicon glyphicon-comment"></span> コメント</h4>
      @foreach ($comments as $comment)
        <div class="comment row">
          <div class="user_data pull-left col-lg-2">
            <div class="user_icon">
              <img src="{{ $comment->user->profile_image_url }}">
            </div>
            <div class="screen_name">
              <a href="/{{ $comment->user->screen_name }}">{{ $comment->user->screen_name }}</a>
            </div>
          </div>
          @if (Auth::check())
            @if (Auth::user()->screen_name === $comment->user->screen_name)
            <div class="comment_box well col-lg-9">
              <div class="comment_text">{{ $comment->comment }}</div>
              <div class="comment_status">{{ $comment->created_at }}</div>
            </div>
            <div class="col-lg-1 item-delete">
              <button class="btn btn-danger btn-sm js-delete-comment" data-comment-id="{{$comment->id}}">削除</button>
            </div>
            @else
            <div class="comment_box well col-lg-10">
              <div class="comment_text">{{ $comment->comment }}</div>
              <div class="comment_status">{{ $comment->created_at }}</div>
            </div>
            @endif
          @else
            <div class="comment_box well col-lg-10">
              <div class="comment_text">{{ $comment->comment }}</div>
              <div class="comment_status">{{ $comment->created_at }}</div>
            </div>
          @endif
        </div>
      @endforeach
      
      <div class="comment_header">
        <h4><span class="glyphicon glyphicon-comment"></span> コメントを書く</h4>
      </div>
      {{ Form::open(array('url' => "$user->screen_name/items/$item->id/comment/new", 'method'=>'post', 'name' => 'commentInfo')) }}
        <div class="form-group">
          <textarea name="comment" class="form-control" rows="5" ng-model="comment" ng-minlength="1" required></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary pull-right" ng-disabled="commentInfo.comment.$invalid">コメントする</button>
        </div>
      {{ Form::close() }}
      <div class="clearfix"></div>
            
    </div>
  </div>
  <div class="col-lg-3">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-lg-4">
          <img src="{{ $user->profile_image_url }}">
        </div>
        <div class="col-lg-8">
          <p>
            <a href="/{{ $user->screen_name }}">{{ $user->screen_name }}</a>
            <a href="https://twitter.com/{{ $user->screen_name }}" target="_blank"><i class="fa fa-twitter"></i></a>
          </p>
          <p><span class="glyphicon glyphicon-star"></span> {{ $star_count }} <span class="glyphicon glyphicon-file"></span> {{ $work_count }}</p>
        </div>
      </div>
    </div>
  </div>
</div>



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
@stop
