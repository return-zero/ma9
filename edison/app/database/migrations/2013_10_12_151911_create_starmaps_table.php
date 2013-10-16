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
