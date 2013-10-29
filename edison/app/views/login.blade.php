@extends('layouts.base')
@section('header')
@parent
{{ HTML::style('css\login.css') }}
@stop
@section('content')
<div class="content-wrapper">
  <div class="row catch-copy-wrapper">
    <div class="col-lg-8">
      <div class="catch-copy">
      <h1>edison</h1>
      <span>アイデアとクリエイターをつなげる、アイデア実現プラットフォーム</span>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="share-wrapper">
        <a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-hashtags="edisoso">ツイート</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
      </div>
    
      <!--
      <div class="regist">
      <h5>Twitterでアカウント登録（無料）</h5>
      {{ Form::open(array('url' => '/login', 'method' => 'POST')) }}
        <button type="submit" class="btn btn-success"><i class="fa fa-twitter"></i> Twitterでログイン</button>
      {{ Form::close() }}
      </div>
      -->
    
      <div id="support">
        <h5>現在サポート中のサービス</h5>
        <ul>
          <li><a href="http://www.nicovideo.jp" target="_blank">niconico</a></li>
          <li>順次追加予定！</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="row idea-wrapper">
    <div class="col-lg-4">
      <div class="img-bulb"><img src="/img/top_bulb.png"></div>
    </div>
    <div class="col-lg-8">
      <div class="idea-content">
        <h2>あなたのアイデアを投稿しよう</h2>
        <p>実現すれば良いな、あれば面白いなと思うアイデア（動画・絵）を投稿して下さい。</p>
        <p>クリエイターはあなたのアイデアを元に素晴らしい作品を作ることができ、</p>
        <p>あなたの見たかった動画・絵を実現してもらえるかもしれません。</p>
      </div>
    </div>
  </div>
  <div class="row work-wrapper">
    <div class="col-lg-8">
      <div class="work-content">
        <h2>みんなのアイデアを元に作品を作ろう</h2>
        <p>自分の技術を活かして何か作りたいけど、何を作ればいいか迷ったことはありませんか。</p>
        <p>edisonには、みんなの実現して欲しいアイデアがたくさんあります。</p>
        <p>みんなのアイデアを元に作った素晴らしい作品を、ぜひ投稿してみて下さい。</p>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="img-palette"><img src="/img/top_palette.png"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3"></div>
    <div class="col-lg-6">
      {{ Form::open(array('url' => '/login', 'method' => 'POST')) }}
        <button type="submit" class="btn btn-success btn-block btn-lg"><i class="fa fa-twitter"></i> Twitterでログインしてedisonを始める（無料）</button>
      {{ Form::close() }}
    </div>
    <div class="col-lg-3"></div> 
    
  </div>
</div>
@stop
