<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Job;


class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
       
       
        for($i=0;$i<=200000;$i++){
            Job::create([
                'fk_company' => rand(1,3),
                'rns' => $faker->randomDigit,
                'fk_tasktype' => rand(1,3),
                'paid' => rand(1,2),
                'order'=>'CZK/'. $i. '/2022',
                'fk_user' => rand(1,7),
                'start_date' => $faker->unique()->dateTimeBetween('-2 months', '+1 day')->format('Y-m-d'),
                'end_date' => date('Y-m-d'),
                'start' => '10:00',
                'end' => '12:00',
                'time' => '02:00',
                'fk_typetask' => rand(1,5),
                'description' => $faker->text,
                'comments' => $faker->text,
                'value' => rand(1,5),
                'location'=>'3',
                'fk_contract' => rand(1,7),
                'updated_at' => rand(0, 9) < 5
                ? null
                : $faker->dateTimeBetween(
                    '-10 days',
                    '-5 days'
                ),
            ]);

        }
    }
}
