@extends('layouts.base')
@section('header')
@parent
{{ HTML::style('css\new.css') }}
@stop
@section('content')
{{ Form::open(array('url' => '/item/new', 'method' => 'POST', 'name' => 'itemInfo')) }}
<div class="row">
  <div class="col-lg-2"></div>
  <div class="col-lg-8">
    <div class="panel panel-primary panel-wrapper">
      <div class="panel-heading"><span class="p-h-title">アイデアを投稿する</span></div>
      <div class="panel-body">
        <div class="row">
          <div class="col-lg-3">
            <p>本文（150文字以内）</p>
            <span class="help-block">150文字以上必要な方は、以下の追記欄を使用して下さい</span>
          </div>
          <div class="col-lg-9">
            <div class="form-group">
              <textarea name="title" class="form-control" rows="3" ng-model="title" ng-minlength="1" ng-maxlength="150" required></textarea>
              <p ng-show="itemInfo.title.$error.maxlength"><ng-show="itemInfo.title.$error.maxlength" class="error">150文字以内で入力して下さい</p>
            </div>
          </div>
        </div>
        <hr>
        
        <div class="row">
          <div class="col-lg-3">
            <p>追記欄（2000文字以内）</p>
          </div>
          <div class="col-lg-9">
            <div class="form-group">
              {{ Form::textarea('content', '', array('class' => 'form-control', 'rows' => '10', 'ng-model' => 'content', 'ng-minlength' => '0', 'ng-maxlength' => '2000')) }}
              <p ng-show="itemInfo.content.$error.maxlength"><ng-show="itemInfo.content.$error.maxlength" class="error">20000文字以内で入力して下さい</p>
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
          <button type="submit" class="btn btn-primary btn-lg btn-block" ng-disabled="itemInfo.$invalid">投稿する</button>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-2"></div>
</div>
{{ Form::close() }}
@stop
