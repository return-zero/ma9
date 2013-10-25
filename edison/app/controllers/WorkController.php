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
      $reg = '/^http:\/\/seiga\.nicovideo\.jp\/seiga\/(im[0-9]+)\?.*/';
    }
    
    $not_found = false;
    if (fopen($data['url'], 'r')) {
      $not_found = true;
    }
    
    preg_match($reg, $data['url'], $match);
    $nico_content = $match ? $match[1] : 0;


    if ( $nico_content && $not_found ) {
      $work = new Work;
    
      $work->item_id = $item_id;
      $work->user_id = Auth::user()->id;
      $work->url = $data['url'];
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
    var_dump($work_id);exit;
    $work = Work::where('id', '=', $work_id);
    var_dump($work);exit;
  }

}
