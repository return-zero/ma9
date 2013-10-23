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
<a href="/content/new" class="btn btn-primary">作品を投稿する</a>


<div class="row">
	<h2>投稿作品</h2>
	<div class="job">
	</div>
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
        <div class="col-lg-8">{{ $comment->comment }}</div>
      </div>
    @endforeach
  </div>
</div>

@stop
