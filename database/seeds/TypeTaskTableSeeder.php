<?php

use Illuminate\Database\Seeder;
use App\Models\TypeTask;
class TypeTaskTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $TypeTask = [
            'Serwis sprzętu komputerowego',
            'Rachunki',
            'Wdrożenie w przychodni',
            'Wdrożenie w aptece',
            'Aktualizacja bazy BLOZ',
            'Pomoc zdalna',
            'Rozmowa Telefoniczna',
            'Fiskalizacja',
            'Odczyt Kasy'

        ];

        foreach($TypeTask as $id => $TypeTasks)
        TypeTask::create(['name' => $TypeTasks,     
    ]);
    }
}
