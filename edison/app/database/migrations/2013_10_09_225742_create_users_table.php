<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
				$table->integer('id')->unsigned();
				$table->primary('id');
				$table->string('screen_name');
				$table->string('profile_image_url');
				$table->string('oauth_token');
				$table->string('oauth_token_secret');
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
		Schema::drop('users');
	}

}
