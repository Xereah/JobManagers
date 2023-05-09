<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $categories = ['Ogólny', 'Rachunki','Somed','Wdrożenia','Apteka'];

        foreach($categories as $id => $categories)
            Category::create(['name' => $categories]);
    }
}
