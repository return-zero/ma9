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
	{{ Form::open(array('url' => "items/$id/comment/new", 'method'=>'post')) }}
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
				<div class="col-lg-4">{{ $comment->user_id }}</div>
				<div class="col-lg-8">{{ $comment->comment }}</div>
			</div>
		@endforeach
	</div>
</div>

@stop
