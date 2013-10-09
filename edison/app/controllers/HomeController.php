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
    return View::make('index');
  }

  public function showNew()
  {
    return View::make('new');
  }

  public function create()
  {
    $data = Input::all();
    DB::table('items')->insert(
      array(
        'category_id' => $data['category_id'],
        'title' => $data['title'],
        'content' => $data['content'],
        'created_at' => date("Y-m-d H:i:s"),
        'updated_at' => date("Y-m-d H:i:s"),
      )
    );
  }
}
