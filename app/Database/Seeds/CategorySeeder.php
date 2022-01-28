<?php

namespace App\Database\Seeds;

use App\Models\Category;
use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
		$model = new Category();

        $categories = array('Technology', 'Nature', 'Animation', 'Health', 'Financial');

        foreach ($categories as $category) {
            $model->insert(array('name' => $category));
        }
    }
}
