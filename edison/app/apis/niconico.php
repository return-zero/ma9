<?php

class NicoSugoiSearch {
  const NICONICO_SEARCH_URL = 'http://api.search.nicovideo.jp/api/';

  public function __construct() {
  }

  public function search($service, $query) {
    $post_data = array(
      'query' => $query,
      'service' => array($service),
      'search' => array('title', 'description', 'tags'),
      'join' => array('cmsid', 'title', 'description', 'thumbnail_url', 'start_time', 'view_counter', 'comment_counter', 'mylist_counter'),
      'filters' => array(array(
        'type' => 'equal',
        'field' => 'ss_adult',
        'value' => false
      )),
      'from' => 0,
      'size' => 5,
      'sort_by' => 'view_counter',
      'issuer' => 'apiguide',
      'reason' => 'ma9'
    );

    $data = json_encode($post_data);
    $headers = array(
      'Content-type: application/json',
      'Accept: application/json'
    );
    $curl = curl_init(self::NICONICO_SEARCH_URL);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $ret = curl_exec($curl);
    $ret = explode("\n", $ret);
    curl_close($curl);
    if (!isset($ret[2])) {
      return false;
    }
    return json_decode($ret[2]);
  }
}
