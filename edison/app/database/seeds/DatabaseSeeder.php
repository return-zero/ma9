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
		$this->call('UserTableSeeder');
		$this->call('ItemTableSeeder');
		$this->call('StarmapTableSeeder');
		$this->call('CommentTableSeeder');
		$this->call('WorkTableSeeder');

		$this->command->info('seed できたでっ！！');
	}
}
