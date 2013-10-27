@extends('layouts.base')
@section('header')
@parent
{{ HTML::style('css\login.css') }}
@stop
@section('content')
<div class="content-wrapper">
  <div class="row">
    <div class="col-lg-8">
      <h2>edisonは、非クリエイターとクリエイター結び，アイデアを実現するプラットフォームです。</h2>
    </div>
    <div class="col-lg-4">
      <p><strong>Twitterでアカウント登録（無料）</strong></p>
      {{ Form::open(array('url' => '/login', 'method' => 'POST')) }}
        <button type="submit" class="btn btn-success"><i class="fa fa-twitter"></i> Twitterでログイン</button>
      {{ Form::close() }}

      <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-hashtags="edisoso">ツイート</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
      <div id="support">
        <p><strong>現在サポート中のサービス</strong></p>
        <ul>
          <li><a href="http://www.nicovideo.jp" target="_blank">niconico</a></li>
        </ul>
        <p><strong>順次追加予定！</strong></p>
      </div>
    </div>
  </div>
</div>
@stop
