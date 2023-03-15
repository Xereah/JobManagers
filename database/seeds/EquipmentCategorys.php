<?php

use App\Models\EquipmentCategory;
use Illuminate\Database\Seeder;

class EquipmentCategorys extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $EquipmentCategory = [
            'Komputery',
            'Drukarki',
            'UPS',
            'Fiskalne',
            'Monitory',
            'Notebook',
            'Sieć',
            'Pozostałe',

        ];
        foreach($EquipmentCategory as $id => $EquipmentCategorys)
        EquipmentCategory::create(['category_name' => $EquipmentCategorys,     
    ]);
    }
}
