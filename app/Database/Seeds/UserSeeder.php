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
		$deletedAt = [null, null, null, date('Y-m-d H:i:s')];

		$emailVerified = [1, 1, 1, 1, 0, 1, 0, 1, 0];

		$faker = Factory::create();
		return [
			'name' => $faker->name(),
			'email' => $faker->email(),
			'password' => 'password',
			'phone' => $faker->phoneNumber(),
			// 'type' => 0, by default it will be zero
			'email_verified' => $emailVerified[rand(0, count($emailVerified) - 1)],
			'deleted_at' => $deletedAt[rand(0, count($deletedAt) - 1)]
		];
	}
}