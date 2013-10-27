<?php

use Illuminate\Database\Migrations\Migration;

class CreateStarmapsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    if (!Schema::hasTable('starmaps')) {
      Schema::create('starmaps', function ($table) {
        $table->increments('id');
        $table->integer('user_id');
        $table->integer('item_id');
        $table->integer('watched_flag');
        $table->integer('notice_flag');
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
    Schema::dropIfExists('starmaps');
	}

}
