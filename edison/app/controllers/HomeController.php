<?php

class HomeController extends BaseController {

  /*
  |--------------------------------------------------------------------------
  | Default Home Controller
  |--------------------------------------------------------------------------
  |
  | You may wish to use controllers instead of, or in addition to, Closure
  | based routes. That's great! Here is an example controller method to
  | get you started. To route to this controller, just add the route:
  |
  |	Route::get('/', 'HomeController@showWelcome');
  |
   */

  public function showIndex()
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
      'game' => 'toho',
      'toho' => '東方',
      'imas' => 'アイドルマスター',
      'radio' => 'ラジオ',
      'draw' => '描いてみた',
      'are' => '例のアレ',
      'diary' => '日記',
      'other' => 'その他',
      'r18' => 'R-18'
    );

    $items = Item::take(10)->get();
    foreach ($items as &$item) {
      $item['screen_name'] = User::where('id', '=', $item->user_id)->get()[0]->screen_name;
      $item['category'] = Category::where('id', '=', $item->category_id)->get()[0]->content;
    }
    $data = array(
      'title' => 'トップ',
      'items' => $items,
      'categories' => $category_names
    );
    return View::make('index', $data);
  }

  public function showNew()
  {
    $categories = Category::all();
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
      'game' => 'toho',
      'toho' => '東方',
      'imas' => 'アイドルマスター',
      'radio' => 'ラジオ',
      'draw' => '描いてみた',
      'are' => '例のアレ',
      'diary' => '日記',
      'other' => 'その他',
      'r18' => 'R-18'
    );
    $data = array(
      'title' => '新規投稿',
      'categories' => $categories,
      'names' => $category_names
    );
    return View::make('new', $data);
  }

  public function create()
  {
    $data = Input::all();
    $item_id = DB::table('items')->insertGetId(
      array(
        'category_id' => $data['category_id'],
        'user_id' => Auth::user()->id,
        'title' => $data['title'],
        'content' => $data['content'],
        'type' => $data['type'],
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
      )
    );
    foreach ($data['tags'] as $tag) {
      $result = DB::table('tags')->where('content', $tag)->get();
      if (empty($result)) {
        $tag_id = DB::table('tags')->insertGetId(
          array(
            'content' => $tag
          )
        );
        DB::table('tagmaps')->insert(
          array(
            'item_id' =>  $item_id,
            'tag_id' => $tag_id
          )
        );
      } else {
        DB::table('tagmaps')->insert(
          array(
            'item_id' =>  $item_id,
            'tag_id' => $result[0]->id
          )
        );
      }
    }
  }
}
