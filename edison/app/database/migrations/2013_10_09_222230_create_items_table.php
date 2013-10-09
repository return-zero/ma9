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
        $table->string('title', 120);
        $table->string('content', 255);
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
    Schema::dropIfExists('items');
  }

}