<?php

class UserController extends BaseController {

  public function showUser($screen_name)
  {
    $category_names = array(
      'ent' => 'エンターテイメント',
      'music' => '音楽',
      'sing' => '歌ってみた',
      'play' => '演奏してみた',
      'dance' => '踊ってみた',
      'vocaloid' => 'VOCALOID',
      'nicoindies' => 'ニコニコインディーズ',
      'animal' => '動物',
      'cooking' => '料理',
      'nature' => '自然',
      'travel' => '旅行',
      'sport' => 'スポーツ',
      'lecture' => 'ニコニコ動画講座',
      'drive' => '車載動画',
      'history' => '歴史',
      'politics' => '政治',
      'science' => '科学',
      'tech' => 'ニコニコ技術部',
      'handcraft' => 'ニコニコ手芸部',
      'make' => '作ってみた',
      'anime' => 'アニメ',
      'game' => 'ゲーム',
      'toho' => '東方',
      'imas' => 'アイドルマスター',
      'radio' => 'ラジオ',
      'draw' => '描いてみた',
      'are' => '例のアレ',
      'diary' => '日記',
      'other' => 'その他',
      'r18' => 'R-18',
      'original' => 'オリジナル',
      'portrait' => '似顔絵',
      'character' => 'キャラクター'
    );

    $user = User::where('screen_name', '=', $screen_name)->first();
    $star_num = $this->getStarNum($screen_name);
    
    $twitter_id = $user->id;

    try {
      Twitter::setOAuthToken($user->oauth_token);
      Twitter::setOAuthTokenSecret($user->oauth_token_secret);
      $timeline = Twitter::statusesUserTimeline($twitter_id);
      $items = Item::where('user_id', '=', $user->id)->orderby('created_at', 'desc')->take(10)->get();
      foreach ($items as &$item) {
        $item['category'] = Category::where('id', '=', $item->category_id)->get()[0]->content;
      }
      $works = Work::where('user_id', '=', $user->id)->get();
      $twitter_profile = array(
        'screen_name' => $screen_name,
        'name' => $timeline[0]["user"]["name"],
        'desc' => $timeline[0]["user"]["description"],
        'icon' => $timeline[0]["user"]["profile_image_url"],
        'items' => $items,
        'title' => $screen_name,
        'star_num' => $star_num,
        'works' => $works,
        'categories' => $category_names
      );

      return View::make('user', $twitter_profile); 
      

    }  catch(Exception $e) {
      echo $e->getMessage();
    }
  }
  
  public function showUserItems($screen_name)
  {
    $user = User::where('screen_name','=',$screen_name)->first();
    $items = Item::where('user_id','=',$user->id)->get();
    $results = array();
    foreach ($items as $item) {
      $results[] = array(
      	'item_id' => $item->id,
        'title' => $item->title,
        'content' => $item->content,
        'created_at' => $item->created_at,
        'updated_at' => $item->updated_at
      );
    }
    return $results;
  }

  private function debug($val)
  {
    echo "<pre>";
    var_dump($val);
    echo "</pre>";
    exit;
  }
  
  public function getStarNum($screen_name)
  {
    $user_id = $this->getUserIdByScreenName($screen_name);
    return Starmap::where('user_id', '=', $user_id)->count();
  }
  
  public function getUserIdByScreenName($screen_name) {
    $user = User::where('screen_name', '=', $screen_name)->first();
    return $user->id;
  }

  public function showUserStars($screen_name)
  {
    $user = User::where('screen_name','=',$screen_name)->first();
    
    $star_items_id = array();
    $star_lists = Starmap::where('user_id', '=', $user->id)->get();
 
    foreach($star_lists as $star_list) {
      $star_items_id[] = $star_list["attributes"]["item_id"]; 
    }


    $star_items = array();
    $res = array();
    foreach($star_items_id as $star_item_id) {
      $item = Item::where('id', '=', $star_item_id)->first();
      $category_id = $item["attributes"]["category_id"];
      $category_name = Category::where('id', '=', $category_id)->first()["attributes"]["content"];
      $star_items[] = array(
        'category' => $category_name,
        'content' => $item["attributes"]["content"],
        'title' => $item["attributes"]["title"],
        'type' => $item["attributes"]["type"],
      );
    }
    $res = array("star_items" => $star_items,
                 "title" => "Stars"
           );

    
    return View::make('stars', $res);
  }

  public function getLogin()
  {
    if (Auth::check()) {
      return Redirect::to('/')->with('message', 'ログイン済みです。');
    }
    $tokens = Twitter::oAuthRequestToken();
    //var_dump($tokens);exit;
    Twitter::oAuthAuthorize($tokens['oauth_token']);
    exit;
  }

  public function getCallback()
  {
    $token = Input::get('oauth_token');
    $verifier = Input::get('oauth_verifier');
    $accessToken = Twitter::oAuthAccessToken($token, $verifier);

    if (isset($accessToken['user_id'])) {
      $user_id = $accessToken['user_id'];
      $user = User::find($user_id);
      if (empty($user)) {
        $user = new User;
        $user->id = $user_id;
      }
      $user->screen_name = $accessToken['screen_name'];
      $user->oauth_token = $accessToken['oauth_token'];
      $user->oauth_token_secret = $accessToken['oauth_token_secret'];
      $user->save();

      Auth::login($user);

      return Redirect::to('/');
      exit;
    } else {
      return Redirect::to('login')->with('message', 'Twitter認証できませんでした。');
      exit;
    }
  }

  public function getLogout()
  {
    Auth::logout();
    return Redirect::to('/')->with('message', 'ログアウトしました。');
  }

}
