@extends('layouts.base')
@section('header')
@parent
@stop
@section('content')
{{ Form::open(array('url' => 'new', 'method' => 'POST')) }}
<div class="content-wrapper">
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
	
	<div class="row">
	  <div class="col-lg-3">
	    <h3>Category</h3>
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
</div>
<!-- /.content-wrapper -->
{{ Form::close() }}
@stop
