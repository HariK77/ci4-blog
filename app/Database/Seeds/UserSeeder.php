<?php

namespace App\Database\Seeds;

use App\Models\User;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class UserSeeder extends Seeder
{
	public function run()
	{
		helper('basic');
		$model = new User();

		// Admin User
		$model->insert(
			array(
				'name' => 'Admin',
				'email' => 'admin@admin.com',
				'password' => 'admin@123',
				'phone' => '1234567890',
				'type' => 1,
				'email_verified' => 1,
			)
		);

		for ($i = 0; $i < 499; $i++) {
			$model->insert($this->generateUser());
		}
	}

	private function generateUser(): array
	{
		$faker = Factory::create();

		$emailVerified = [1, 1, 1, 1, 0, 1, 0, 1, 0];

		$randomResgisteredDate = $faker->dateTimeBetween('-2 years', 'now');
		$createdAt = $randomResgisteredDate->format('Y-m-d H:i:s');

		$deletedAt = null;
		$randomDeletedPossibility = [false, false, false, true];
		$deleted = $randomDeletedPossibility[rand(0, count($randomDeletedPossibility) - 1)];

		if ($deleted) {
			$date = date('Y-m-d H:i:s', strtotime("+2 months", strtotime($createdAt)));
			$deletedAt = checkInputDate($date);
		}

		return [
			'name' => $faker->name(),
			'email' => $faker->email(),
			'password' => 'password',
			'phone' => $faker->phoneNumber(),
			// 'type' => 0, by default it will be zero
			'email_verified' => $emailVerified[rand(0, count($emailVerified) - 1)],
			'created_at' => $createdAt,
			'updated_at' => $createdAt,
			'deleted_at' => $deletedAt
		];
	}
}