@extends('layouts.base')
@section('header')
@parent
{{ HTML::style('css\new.css') }}
@stop
@section('content')
{{ Form::open(array('url' => 'new', 'method' => 'POST')) }}
<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-lg-8">
    <div class="panel panel-primary panel-wrapper">
      <div class="panel-heading"><span class="p-h-title">アイデアを投稿する</span></div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-3">
            <p>本文</p>
          </div>
          <div class="col-lg-9">
            <div class="form-group">
              {{ Form::textarea('title', '', array('class' => 'form-control', 'rows' => '3')) }}
            </div>
          </div>
        </div>
        <hr>
        
        <div class="row">
          <div class="col-lg-3">
            <p>追記欄</p>
          </div>
          <div class="col-lg-9">
            <div class="form-group">
              {{ Form::textarea('content', '', array('class' => 'form-control', 'rows' => '5')) }}
            </div>
          </div>
        </div>
        <hr>
        
        <div class="row">
          <div class="col-lg-3">
            <p>タイプ</p>
          </div>
          <div class="col-lg-9">
            <label class="radio-inline">
              <input type="radio" name="type" id="video" value="video" checked>
              動画
            </label>
            <label class="radio-inline">
              <input type="radio" name="type" id="illust" value="illust">
              イラスト
            </label>
          </div>
        </div>
        <hr>
        
        <div class="row">
          <div class="col-lg-3">
            <p>カテゴリー</p>
          </div>
          <div class="col-lg-9">
            <select class="form-control" name="category_id" id="category">
                <option value="0">未選択</option>
              @foreach ($categories as $category)
                <option value="{{ $category['id'] }}">{{ $names[$category['content']] }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <hr>
        
        <div class="row">
          <div class="col-lg-3">
            <p>タグ</p>
          </div>
          <div class="col-lg-9">
            <div id="tag-form-wrap">
              <div>{{ Form::text('tags[]', '', array('class' => 'form-control')) }}</div>
              <div>{{ Form::text('tags[]', '', array('class' => 'form-control')) }}</div>
              <div class="btn btn-default" id="tag-plus"><span class="glyphicon glyphicon-plus"></span> タグを追加する
              </div>
            </div>
          </div>
        </div>
        <hr>
        
        <div class="col-lg-3"></div>
        <div class="col-lg-9">
          <button type="submit" class="btn btn-primary btn-lg btn-block">投稿する</button>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-2"></div>
</div>
{{ Form::close() }}
@stop
