<?php

use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    if (!Schema::hasTable('tags')) {
      Schema::create('tags', function($table) {
        $table->increments('id');
        $table->string('content', 50);
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
    Schema::dropIfExists('tags');
  }

}
