<?php

use Illuminate\Database\Seeder;
use App\Models\TaskType;
class TaskTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $TaskType = [
            'Usługi(U)',
            'Rozliczenia(R)',
            'Wdrożenia(W) ', 
            'Towary(T) ',
            'Dyżur(D)',
            'Fiskalne(F)',
            'Sprzęt zastępczy(SZ)',

        ];

        foreach($TaskType as $id => $TaskTypes)
        TaskType::create(['name' => $TaskTypes,     
    ]);
    }
}
