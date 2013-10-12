@extends('layouts.base')
@section('header')
  <title>new</title>
@stop
@section('content')
<div class="container hero-unit">
  <h1>投稿する</h1>
  {{ Form::open(array('url' => '/new')) }}
    <div class="form-group">
      <h3>{{ Form::label('title', 'title') }}</h3>
      {{ Form::text('title', '', array('class' => 'form-control', 'id' => 'title', 'placeholder' => 'Enter title')) }}
    </div>
    <div class="form-group">
      <h3>{{ Form::label('content', 'content') }}</h3>
      {{ Form::textarea('content', '', array('class' => 'form-control', 'rows' => '5', 'id' => 'content', 'placeholder' => 'Enter content')) }}
    </div>
    <h3>Category</h3>
    <select class="form-control" name="category_id">
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
    </select>
    <h3>Tags</h3>
    <div id="tag-form-wrap">
	    <div>{{ Form::text('tags[]', '', array('class' => 'form-control')) }}</div>
	    <div>{{ Form::text('tags[]', '', array('class' => 'form-control')) }}</div>
	    <div class="btn btn-default" id="tag-plus"><span class="glyphicon glyphicon-plus"></span> タグを追加する</div>
    </div>
    <br />
    <button type="submit" class="btn btn-default">Submit</button>
  {{ Form::close() }}
</div>
<script src="js/add_tagform.js"></script>
@stop

