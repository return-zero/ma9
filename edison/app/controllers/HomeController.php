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
    if (!Auth::check()) {
      return View::make('login', array('title' => 'edison'));
    }
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

    $all_items = Item::orderBy('created_at', 'desc')->take(10)->get();
    foreach ($all_items as &$item) {
      $item['screen_name'] = User::where('id', '=', $item->user_id)->get()[0]->screen_name;
      $item['category'] = Category::where('id', '=', $item->category_id)->get()[0]->content;
    }
    $recent_works = Work::orderBy('created_at', 'desc')->take(10)->get();
    foreach ($recent_works as &$work) {
      $item = Item::where('id', '=', $work->item_id)->get()[0];
      $work['item'] = $item;
      $work['screen_name'] = User::where('id', '=', $work->user_id)->get()[0]->screen_name;
      $work['item_poster_screen_name'] = User::where('id', '=', $item->user_id)->get()[0]->screen_name;
      $work['item_category'] = Category::where('id', '=', $item->category_id)->get()[0]->content;
    }

    $user = User::where('screen_name', '=', Auth::user()->screen_name)->get()[0];

    $data = array(
      'title' => 'edison',
      'user' => $user,
      'all_items' => $all_items,
      'recent_works' => $recent_works,
      'categories' => $category_names,
      'star_count' => Starmap::where('user_id', '=', $user->id)->count(),
      'work_count' => Work::where('user_id', '=', Auth::user()->id)->count(),
    );
    return View::make('index', $data);
  }

  public function showNew()
  {
    $categories = Category::where('type', '=', 'video')->get();
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
      'r18' => 'R-18',
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
    $screen_name = Auth::user()->screen_name;
    return Redirect::to("/$screen_name/items/$item_id");
  }
}
