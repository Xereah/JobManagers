<?php
use Illuminate\Database\Seeder;
use App\Models\Project;
class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $Project = ['Ogólny', 'Rachunki','inne'];

        foreach($Project as $id => $Projects)
        Project::create(['name' => $Projects,      
    ]);
    }
}
