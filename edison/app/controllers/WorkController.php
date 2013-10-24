<?php

class WorkController extends BaseController {

  public function create($item_id) {
    $data = Input::all();
    $user_id = Item::where('id', '=', $item_id)->first()['attributes']['user_id'];
    $screen_name = User::where('id', '=', $user_id)->first()['attributes']['screen_name'];
    
    $now = date("Y-m-d H:i:s");

    $reg_nico_video = '/^http:\/\/www\.nicovideo\.jp\/watch\/(sm[0-9]+)/';
    $reg_nico_seiga = "/^http:\/\/seiga\.nicovideo\.jp\/seiga\/(im[0-9]+)\?.*/";
    $reg_pixiv = "/^http:\/\/www\.pixiv\.net\/member_illust\.php\?mode=medium\&illust_id=([0-9]+)/";
    
    $not_found = false;
    if (fopen($data['url'], 'r')) {
      $not_found = true;
    }
    
    preg_match($reg_nico_video, $data['url'], $match_video);
    $nico_video = $match_video ? $match_video[1] : 0;

    preg_match($reg_nico_seiga, $data['url'], $match_seiga);
    $nico_seiga = $match_seiga ? $match_seiga[1] : 0;

    preg_match($reg_pixiv, $data['url'], $match_pixiv);
    $pixiv = $match_pixiv ? $match_pixiv[1] : 0;


    if ( ($nico_video || $nico_seiga || $pixiv) && $not_found ) {

      if ($nico_video) $url = $nico_video;
      if ($nico_seiga) $url = $nico_seiga;
      if ($pixiv) $url = $pixiv;

      $work = new Work;
    
      $work->item_id = $item_id;
      $work->user_id = Auth::user()->id;
      $work->url = $url;
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

  public function delete($item_id) {

  }

}