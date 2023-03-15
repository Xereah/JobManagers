<?php

use Illuminate\Database\Seeder;
use App\Models\Car;
class CarTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car = [
            [
                'car_mark'             => 'Fiat',
                'car_model'           => 'Doblo',
                'car_plates'           => 'PK66147',
            ],
            [
                'car_mark'             => 'Fiat',
                'car_model'           => 'Fiorino',
                'car_plates'           => 'PK75002J',
            ],    
            [
                'car_mark'             => 'Fiat',
                'car_model'           => 'Fiorino',
                'car_plates'           => 'PK75003J',
            ],       
            [
                'car_mark'             => 'Kia',
                'car_model'           => 'Picanto',
                'car_plates'           => 'PK6155M',
            ],   
            [
                'car_mark'             => 'Kia',
                'car_model'           => 'Picanto',
                'car_plates'           => 'PK9731M',
            ],   
            
        ];

        Car::insert($car);
    }
}
