<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
	public function run()
	{
		$model = new User();
		for ($i = 0; $i < 1000; $i++) {
			$model->insert($this->generateUser());
		}
	}

	private function generateUser(): array
	{
		$faker = Factory::create();
		return [
			'name' => $faker->name(),
			'email' => $faker->email,
			'password' => 'password'
		];
	}
}