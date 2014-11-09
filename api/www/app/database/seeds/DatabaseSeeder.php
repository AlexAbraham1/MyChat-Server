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

		$this->call('UsersTableSeeder');
	}

}

class UsersTableSeeder extends Seeder {
	
	
	public function run()
	{
		
		User::truncate();
		
		
		User::create([
			'username' => 'Alex1',
			'password' => Hash::make('password'),
		]);
		
		User::create([
			'username' => 'Alex2',
			'password' => Hash::make('password'),
		]);
	}
	
}
