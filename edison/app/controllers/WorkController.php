<?php

class WorkController extends BaseController {

  public function create($item_id) {
    $data = Input::all();
    
    $now = date("Y-m-d H:i:s");

    $nico_video = "/http:¥/¥/www¥.nicovideo¥.jp¥/watch¥/(sm[0-9]+)/";
    $nico_seiga = "/http:¥/¥/seiga¥.nicovideo¥.jp¥/watch¥/(im[0-9]+).+/";
    $pixiv = "/http:¥/¥/www¥.pixiv¥.net/member_illust¥.php¥?mode=medium¥&illust_id=([0-9]+)/";

    $not_found = false;
    if (!fopen($data['url'])) {
      $not_found = true;
    }
    var_dump($not_found);exit;

    if (
        (
          preg_match($nico_video, $data['url']) || 
          preg_match($nico_seiga, $data['url']) ||
          preg_match($pixiv, $data['url'])
        ) && $not_found === true
       ) {
      echo "通ったで";exit;
      $work = new Work;
    
      $work->item_id = $item_id;
      $work->user_id = Auth::user()->id;
      $work->url = $data['url']
      $work->comment = $data['comment'];
      $work->created_at = date("Y-m-d H:i:s");
      $work->updated_at = date("Y-m-d H:i:s");

      $work->save();

      return Redirect::to("/$screen_name/items/$id");

    } else {
      echo "その作品はあかん";
    }

  }

  public function delete($item_id) {

  }

}