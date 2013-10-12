@extends('layouts.base')
@section('header')
<title>item</title>
@stop
@section('content')
<h1>{{ $title }}</h1>

<div class="row">
  <div class="col-lg-9">
    <p>作成日 : {{ $created_at }}</p>
    <p>更新日	 : {{ $updated_at }}</p>			
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
    <div class="col-lg-10">
      @foreach ($tags as $tag)
        <div class="tag">{{ $tag }}</div>
      @endforeach
    </div>
    <div class="col-lg-2">
      {{ Form::open(array('url' => "$screen_name/items/$id/favorite", 'method' => 'POST')) }}
        {{ Form::hidden('id', $id) }}
        <button type="submit" class="btn btn-default">Fav</button>
      {{ Form::close() }}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-12">
    content: {{ $content }}
  </div>	
</div>

<div class="row">
  <h2>投稿作品</h2>
  <div class="job">
  </div>
</div>

<div class="row">
  <h3>コメント</h3>
  <div class="comment">
  </div>
</div>
@stop
