<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('GroupCategoryTableSeeder');
		$this->call('CategoryTableSeeder');

		$this->command->info('seed できたでっ！！');
	}
}
