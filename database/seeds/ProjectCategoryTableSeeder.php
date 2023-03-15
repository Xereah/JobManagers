<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectCategory;
class ProjectCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $faker = Faker\Factory::create();
        $Project = ['Ogólny', 'Rozliczenia NFZ'];

        foreach($Project as $id => $Projects)
        Project::create(['name' => $Projects]);
    }
}
