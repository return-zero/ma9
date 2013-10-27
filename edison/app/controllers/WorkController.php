<?php

class WorkController extends BaseController {

  public function create($item_id) {
    $data = Input::all();
    $item = Item::where('id', '=', $item_id)->get()[0];
    $screen_name = User::where('id', '=', $item->user_id)->first()['attributes']['screen_name'];
    
    $now = date("Y-m-d H:i:s");

    if ($item['type'] == 'video') {
      $reg = '/^http:\/\/www\.nicovideo\.jp\/watch\/(sm[0-9]+)/';
    } else {
      $reg = '/^http:\/\/seiga\.nicovideo\.jp\/seiga\/im([0-9]+)/';
    }
    
    preg_match($reg, $data['url'], $match);
    $nico_content = $match ? $match[1] : 0;

    if ($item['type'] == 'video') {
      $Niconico = new Niconico;
      $ret = $Niconico->getThumbInfo($nico_content);
      $title = $ret->title;
      $thumbnail_url = $ret->thumbnail_url;
    } else {
      $title = '';
      $thumbnail_url = "http://lohas.nicoseiga.jp/thumb/{$nico_content}q";
    }

    if ( $nico_content ) {
      $work = new Work;
    
      $work->item_id = $item_id;
      $work->user_id = Auth::user()->id;
      $work->url = $data['url'];
      $work->title = $title;
      $work->thumbnail_url = $thumbnail_url;
      $work->comment = $data['comment'];
      $work->created_at = date("Y-m-d H:i:s");
      $work->updated_at = date("Y-m-d H:i:s");

      $work->save();      

      Starmap::where('item_id', '=', $item_id)->update(array('notice_flag' => 1));

      return Redirect::to("/$screen_name/items/$item_id");

    } else {
      echo "その作品はあかん";
    }

  }

  public function delete($work_id) {
  
    
    $work_user_id = Work::where('id', '=', $work_id)->get()[0]->user_id;
    // $work_item_id = Work::where('id', '=', $work_id)->get()[0]->item_id;
    // $item_user_id = Item::where('id', '=', $work_item_id)->get()[0]->user_id;
    // $item_user_screen_name = User::where('id', '=', $item_user_id)->get()[0]->screen_name;

    if (Auth::user()->id === $work_user_id) {
      Work::where('id', '=', $work_id)->delete();
      return Redirect::to("/");
    } else {
      return Redirect::to("/");
    }
  }

}
