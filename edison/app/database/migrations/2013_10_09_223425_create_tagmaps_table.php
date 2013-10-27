<?php

use Illuminate\Database\Migrations\Migration;

class CreateTagmapsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('tagmaps')) {
      Schema::create('tagmaps', function($table) {
        $table->increments('id');
        $table->integer('item_id');
        $table->integer('tag_id');
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
    Schema::dropIfExists('tagmaps');
  }

}
