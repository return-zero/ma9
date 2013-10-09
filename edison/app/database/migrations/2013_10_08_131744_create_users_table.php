<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('users', function($table) {
      $table->integer('id')->unsigned();
      $table->primary('id');
      $table->string('screen_name');
      $table->string('oauth_token');
      $table->string('oauth_token_secret');
      $table->integer('follow');
      $table->integer('follower');
      $table->date('created');
      $table->date('modified');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('users');
  }

}
