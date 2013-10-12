<?php

use Illuminate\Database\Migrations\Migration;

class CreateFavmapsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
    if (!Schema::hasTable('favmaps')) {
      Schema::create('favmaps', function ($table) {
        $table->increments('id');
        $table->integer('user_id');
        $table->integer('item_id');
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
    Schema::dropIfExists('favmaps');
	}

}
