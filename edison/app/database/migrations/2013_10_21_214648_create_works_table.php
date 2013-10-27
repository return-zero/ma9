<?php

use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('works', function($table) {
			$table->increments('id');
			$table->integer('item_id');
			$table->integer('user_id');
			$table->string('url');
			$table->string('title');
			$table->string('thumbnail_url');
			$table->string('comment');
			$table->datetime('created_at');
			$table->datetime('updated_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('works');
	}

}
