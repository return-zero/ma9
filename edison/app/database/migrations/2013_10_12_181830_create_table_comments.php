<?php

use Illuminate\Database\Migrations\Migration;

class CreateTableComments extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('comments')) {
      Schema::create('comments', function($table) {
        $table->increments('id');
        $table->integer('user_id');
	$table->integer('item_id');
	$table->text('comment', 124);
	$table->datetime('created_at');
	$table->datetime('updated_at');
      });
    }
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('comments');
  }
}
