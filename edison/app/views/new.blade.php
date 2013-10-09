@extends('layouts.base')
@section('header')
  <title>new</title>
@stop
@section('content')
<div class="container hero-unit">
  <h1>投稿する</h1>
  <form role="form" method="POST" action="">
    <div class="form-group">
      <label for="title">title</label>
      <input type="text" class="form-control" id="title" name="title" placeholder="Enter title">
    </div>
    <div class="form-group">
      <label for="content">content</label>
      <textarea class="form-control" rows="5" id="content" name="content" placeholder="Enter content"></textarea>
    </div>
    Category
    <select class="form-control" name="category">
      <option>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
    </select>
    Tags
    <input type="text" class="form-control">
    <label class="checkbox-inline">
      <input type="checkbox" name="tags[]"> ロックする
    </label>
    <input type="text" class="form-control">
    <label class="checkbox-inline">
      <input type="checkbox" name="tags[]"> ロックする
    </label>
    <br />
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>
@stop
