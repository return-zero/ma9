@extends('layouts.base')
@section('header')
@parent
@stop
@section('content')

<div class="row">
  <div class="col-lg-9">
    <h1>{{ $title }}</h1>
    <span>作成日 : {{ $created_at }}</span>
    <span>更新日 : {{ $updated_at }}</span>
  </div>
  <div class="col-lg-3">
    <div class="profile">
      profile
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    <div class="col-lg-2">
      タグ
    </div>
    <div class="col-lg-8">
      @foreach ($tags as $tag)
        <div class="tag">{{ $tag }}</div>
      @endforeach
    </div>
    <div class="col-lg-2">
    @if ($star_status == true)
      {{ Form::open(array('url' => "$screen_name/items/$id/unstar", 'method' => 'post')) }}
        <button type="submit" class="btn btn-warning">
          <i class="glyphicon glyphicon-star"></i>
        </button>
      {{ Form::close() }}
    @else
      {{ Form::open(array('url' => "$screen_name/items/$id/star", 'method' => 'post')) }}
        <button type="submit" class="btn btn-default">
          <i class="glyphicon glyphicon-star"></i>
        </button>
      {{ Form::close() }}
    @endif

    </div>
  </div>
</div>

{{ $star_status }}



<div class="jumbotron">
  {{ $content }}
</div>
<a href="#work-form" class="btn btn-primary btn-lg" data-toggle="modal">作品を投稿する</a>

<!-- Work Form Modal -->
  <div class="modal fade" id="work-form" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">作品投稿</h4>
        </div>
        
          {{ Form::open(array('url' => "work/create/$id", 'method'=>'post')) }}
          <div class="row">
            <div class="col-lg-3">
              <h3>URL</h3>
            </div>
            <div class="col-lg-9">
              <div class="form-group">
                {{ Form::text('url', '', array('class' => 'form-control', 'placeholder' => 'Enter URL')) }}
              </div>
            </div>
          </div>
           <div class="row">
            <div class="col-lg-3">
              <h3>Comment</h3>
            </div>
            <div class="col-lg-9">
              <div class="form-group">
                {{ Form::text('comment', '', array('class' => 'form-control', 'placeholder' => 'Enter Comment')) }}
              </div>
            </div>
          </div>
        
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        {{ Form::close() }}
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


<div class="row">
  <h2>投稿作品</h2>
  <div class="job">
  </div>
</div>

<div class="row">
  <h3>関連作品</h3>
</div>

<div class="row">
  {{ Form::open(array('url' => "$screen_name/items/$id/comment/new", 'method'=>'post')) }}
    <div class="row">
      <div class="col-lg-3">
        <h3>Comment</h3>
      </div>
      <div class="col-lg-9">
        <div class="form-group">
          {{ Form::textarea('comment', '', array('class' => 'form-control', 'rows' => '5', 'placeholder' => 'Enter comment')) }}
        </div>
      </div>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  {{ Form::close() }}
  <h3>コメント</h3>
  <div class="comments">
    @foreach ($comments as $comment)
      <div class="comment">
        <div class="col-lg-12">{{ $comment->created_at}}</div>
        <div class="col-lg-4">{{ $comment->name->screen_name}}</div>
        <div class="col-lg-8">{{{ $comment->comment }}}</div>
        @if ($comment->name->screen_name == Auth::user()->screen_name)
          {{ Form::open(array('url' => "{$comment->name->screen_name}/items/{$id}/comments/{$comment->id}/delete", 'method'=>'post')) }}
            <button type="submit">delete</button>
          {{ Form::close() }}
        @endif
      </div>
    @endforeach
  </div>
</div>

@stop
