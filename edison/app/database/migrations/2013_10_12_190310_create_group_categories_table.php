<?php

use Illuminate\Database\Migrations\Migration;

class CreateGroupCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_categories', function($table) {
			$table->increments('id');
			$table->string('content');
			$table->datetime('created_at');
			$table->string('updated_at');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('group_categories');
	}

}
