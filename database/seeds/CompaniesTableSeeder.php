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
            'kontrahent_kod' => 'KASPERKOMPUTER', 
            'kontrahent_nazwa1' => 'KASPER KOMPUTER SP Z.O.O',
            'kontrahent_ulica'=>'Podmiejska', 
            'kontrahent_nrdomu' => '16',
            'kontrahent_miasto'=>'Kalisz',
            'kontrahent_kodpocztowy'=>'68-800',
            'kontrahent_poczta' => 'Kalisz',
            'kontrahent_telefon1'=>'625017661',
            'kontrahent_odleglosc'=>'1',
            'kontrahent_email'=>'dok@kasper.pl',
            'kontrahent_grupa' => '7'],    


            ['id' => 2, 
            'kontrahent_kod' => 'MEDKALMEDIX', 
            'kontrahent_nazwa1' => 'KALISKA AGENCJA MEDYCZNA MEDIX SP Z.O.O',
            'kontrahent_ulica'=>'Majkowska 13A', 
            'kontrahent_nrdomu' => '13A',
            'kontrahent_miasto'=>'Kalisz',
            'kontrahent_kodpocztowy'=>'68-800',
            'kontrahent_poczta' => 'Kalisz',
            'kontrahent_telefon1'=>'625017662',
            'kontrahent_odleglosc'=>'1',
            'kontrahent_email'=>'rejestracja@medix.kalisz.pl',
            'kontrahent_grupa' => '6'],   
            
            ['id' => 3, 
            'kontrahent_kod' => 'MEDSIETRESMED', 
            'kontrahent_nazwa1' => 'TRES MED SP Z.O.O',
            'kontrahent_ulica'=>'Krakowskie Przedmieście ', 
            'kontrahent_nrdomu' => '10',
            'kontrahent_miasto'=>'Sieradz',
            'kontrahent_kodpocztowy'=>'98-200',
            'kontrahent_poczta' => 'Sieradz',
            'kontrahent_telefon1'=>'625017663',
            'kontrahent_odleglosc'=>'50',
            'kontrahent_email'=>'tresmed@op.pl',
            'kontrahent_grupa' => '6'],  

            ['id' => 4, 
            'kontrahent_kod' => 'HAFT', 
            'kontrahent_nazwa1' => 'FABRYKA FIRANEK I KORONEK HAFT S.A ',
            'kontrahent_ulica'=>'Złota', 
            'kontrahent_nrdomu' => '40',
            'kontrahent_miasto'=>'Kalisz',
            'kontrahent_kodpocztowy'=>'68-800',
            'kontrahent_poczta' => 'Kalisz',
            'kontrahent_telefon1'=>'625017664',
            'kontrahent_odleglosc'=>'1',
            'kontrahent_email'=>'haft@wp.pl',
            'kontrahent_grupa' => '7'],  

            ['id' => 5, 
            'kontrahent_kod' => 'APWRÓZDRÓWKO', 
            'kontrahent_nazwa1' => 'Apteka Zdrówko ',
            'kontrahent_ulica'=>'', 
            'kontrahent_nrdomu' => '10C',
            'kontrahent_miasto'=>'Wróblew',
            'kontrahent_kodpocztowy'=>'98-285',
            'kontrahent_poczta' => 'Wróblew',
            'kontrahent_telefon1'=>'625017665',
            'kontrahent_odleglosc'=>'40',
            'kontrahent_email'=>'apteka@wp.pl',
            'kontrahent_grupa' => '3'], 
            
            ['id' => 6, 
            'kontrahent_kod' => 'APWRÓARNIKA', 
            'kontrahent_nazwa1' => 'Apteka Arnika ',
            'kontrahent_ulica'=>'', 
            'kontrahent_nrdomu' => '11',
            'kontrahent_miasto'=>'Wróblew',
            'kontrahent_kodpocztowy'=>'98-285',
            'kontrahent_poczta' => 'Wróblew',
            'kontrahent_telefon1'=>'625017666',
            'kontrahent_odleglosc'=>'1',
            'kontrahent_email'=>'apteka@wp.pl',
            'kontrahent_grupa' => '40'],  
            
                          
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
