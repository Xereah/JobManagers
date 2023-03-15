<?php


use Illuminate\Database\Seeder;
use App\Models\RepEquipment;
class RepEQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $RepEQSeeder = [
            ['id' => 1, 
            'eq_number' => 'KK114', 
            'eq_name' => 'UPS ETA 1600',
            'serial_number'=>'123', 
            'eq_category'=>'3',
            'entry_date'=>'2023.02.15'
           ],
           ['id' => 2, 
           'eq_number' => 'KK115', 
           'eq_name' => 'Dell Optiplex 7010',
           'serial_number'=>'321', 
           'eq_category'=>'1',
           'entry_date'=>'2023.02.15'
          ],
          ['id' => 3, 
          'eq_number' => 'KK116', 
          'eq_name' => 'Brother HL-5100DN',
          'serial_number'=>'213', 
          'eq_category'=>'2',
          'entry_date'=>'2023.02.15'
         ],
              
        ];
        $faker = Faker\Factory::create();
        foreach ($RepEQSeeder as $RepEQSeederS) {
            DB::table('rep_equipment')->insert([
                'id' => $RepEQSeederS['id'],               
                'eq_number' => $RepEQSeederS['eq_number'],
                'eq_name' => $RepEQSeederS['eq_name'],
                'serial_number' => $RepEQSeederS['serial_number'],
                'eq_category' => $RepEQSeederS['eq_category'],   
                'entry_date'=> $RepEQSeederS['entry_date'],            
                'created_at' => $faker->dateTimeBetween(
                     '-20 days',
                     '-10 days'
                 ),
                 'updated_at' => rand(0, 9) < 5
                    ? null
                    : $faker->dateTimeBetween(
                        '-10 days',
                        '-5 days'
                    ),
                    'deleted_at' => NULL
            ]);
        }
    }
}
