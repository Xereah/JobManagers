<?php

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();


        $companies = [
            ['id' => 1, 
            'kontrahent_kod' => 'MEDKALMEDIX', 
            'kontrahent_nazwa1' => 'KALISKA AGENCJA MEDYCZNA MEDIX SP Z.O.O',
            'kontrahent_ulica'=>'Majkowska 13A', 
            'kontrahent_nrdomu' => '13A',
            'kontrahent_miasto'=>'Kalisz',
            'kontrahent_kodpocztowy'=>'68-800',
            'kontrahent_poczta' => 'Kalisz',
            'kontrahent_nip'=> '123456789',
            'kontrahent_telefon1'=>'625017666',
            'kontrahent_odleglosc'=>'1',
            'kontrahent_email'=>'rejestracja@medix.kalisz.pl',
            'kontrahent_grupa' => '6'],            
                          
        ];

        foreach ($companies as $company) {
            DB::table('kontrahenci')->insert([
                'id' => $company['id'],               
                'kontrahent_kod' => $company['kontrahent_kod'],
                'kontrahent_nazwa1' => $company['kontrahent_nazwa1'],
                'kontrahent_ulica' => $company['kontrahent_ulica'],
                'kontrahent_nrdomu' => $company['kontrahent_nrdomu'],
                'kontrahent_miasto' => $company['kontrahent_miasto'],
                'kontrahent_kodpocztowy' => $company['kontrahent_kodpocztowy'],
                'kontrahent_poczta' => $company['kontrahent_poczta'],
                'kontrahent_nip' => $company['kontrahent_nip'],
                'kontrahent_telefon1' => $company['kontrahent_telefon1'],
                'kontrahent_odleglosc' => $company['kontrahent_odleglosc'],
                'kontrahent_email' => $company['kontrahent_email'],
                'kontrahent_grupa' => $company['kontrahent_grupa'],
                
              
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
