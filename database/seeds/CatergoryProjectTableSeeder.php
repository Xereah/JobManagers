<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class CatergoryProjectTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();
        $roles = [
            [
                
                'project_id' => '1',
                'category_id' => '1',
            ],
            [
                
                'project_id' => '1',
                'category_id' => '2',
            ],
            [
                
                'project_id' => '2',
                'category_id' => '1',
            ],
            [
                
                'project_id' => '2',
                'category_id' => '3',
            ],
            [
                
                'project_id' => '3',
                'category_id' => '1',
            ],
            [
                
                'project_id' => '3',
                'category_id' => '4',
            ],
        ];

        foreach ($roles as $rola) {
            DB::table('category_project')->insert([
                             
                'project_id' => $rola['project_id'],
                'category_id' => $rola['category_id'],
                             
            ]);
        }
    }
}
