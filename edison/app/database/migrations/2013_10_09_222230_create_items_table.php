<?php

use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('items')) {
      Schema::create('items', function($table) {
        $table->increments('id');
        $table->integer('category_id');
        $table->integer('user_id');
        $table->string('title', 300);
        $table->string('content', 2000);
        $table->enum('type', array('video', 'illust'));
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
    Schema::drop('items');
  }

}
