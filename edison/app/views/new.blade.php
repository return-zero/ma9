@extends('layouts.base')
@section('header')
  <title>new</title>
@stop
@section('content')


{{ Form::open(array('url' => '/new')) }}

<div class="row">
  <div class="col-lg-3">
    <h3>Title</h3>
  </div>
  <div class="col-lg-9">
    <div class="form-group">
      {{ Form::text('title', '', array('class' => 'form-control', 'placeholder' => 'Enter title')) }}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-3">
    <h3>Content</h3>
  </div>
  <div class="col-lg-9">
    <div class="form-group">
      {{ Form::textarea('content', '', array('class' => 'form-control', 'rows' => '5', 'placeholder' => 'Enter content')) }}
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-3">
    <h3>Type</h3>
  </div>
  <div class="col-lg-9">
    <div class="checkbox-inline">
      <label>
        <input type="checkbox" name="type" value="movie">動画
      </lavel>
    </div>
    <div class="checkbox-inline">
  　  <label>
        <input type="checkbox" name="type" value="illut">イラスト
      </lavel>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-lg-3">
    <h3>Category</h3>
  </div>
  <div class="col-lg-9">
    <select class="form-control" name="category_id">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
  </div>
</div>

<div class="row">
  <div class="col-lg-3">
    <h3>Tags</h3>
  </div>
  <div class="col-lg-9">
    <div id="tag-form-wrap">
      <div>{{ Form::text('tags[]', '', array('class' => 'form-control')) }}</div>
      <div>{{ Form::text('tags[]', '', array('class' => 'form-control')) }}</div>
      <div class="btn btn-default" id="tag-plus"><span class="glyphicon glyphicon-plus"></span>   タグを追加する
      </div>
    </div>
  </div>
</div>
<button type="submit" class="btn btn-default">Submit</button>
{{ Form::close() }}
@stop
