@extends('layouts.base')
@section('css')
@parent
{{ HTML::style('css\about.css') }}
@stop
@section('header')
@parent
@stop
@section('content')
<div class="content-wrapper">
  <h2>edisonとは</h2>
  <p>edisonは「アイデアとクリエイターをつなげる、アイデア実現プラットフォーム」です。...and more</p>
</div>
@stop
