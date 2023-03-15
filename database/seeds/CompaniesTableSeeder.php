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
            'shortcode' => 'MEDKALMEDIX', 
            'name' => 'KALISKA AGENCJA MEDYCZNA MEDIX SP Z.O.O',
            'street'=>'Majkowska 13A', 
            'zipcode'=>'68-800',
            'location'=>'Kalisz',
            'phonenumber'=>'625017666',
            'distance'=>'1',
            'email'=>'rejestracja@medix.kalisz.pl',
            'fk_contract' => '6'],



            ['id' => 2, 
            'shortcode' => 'MEDKALPULS', 
            'name' => 'Zakład Podstawowej Opieki Zdrowotnej "PULS"',
            'street'=>'Polna 29', 
            'zipcode'=>'68-800',
            'location'=>'Kalisz',
            'phonenumber'=>'627531633',
            'distance'=>'10',
            'email'=>'sekretariat@puls.kalisz.pl',
            'fk_contract' => '6'],

            ['id' =>3, 
            'shortcode' => 'KASPERKOMPUTER', 
            'name' => 'Kasper Komputer',
            'street'=>'Podmiejska 16', 
            'zipcode'=>'68-800',
            'location'=>'Kalisz',
            'phonenumber'=>'513623174',
            'distance'=>'100',
            'email'=>'dok@kasper.pl',
            'fk_contract' => '7'],

            ['id' =>4, 
            'shortcode' => 'MEDKALCENTRUMBOCZNA', 
            'name' => 'Centrum Boczna',
            'street'=>'Boczna 1', 
            'zipcode'=>'68-800',
            'location'=>'Kalisz',
            'phonenumber'=>'513623171',
            'distance'=>'100',
            'email'=>'centrum@boczna.pl',
            'fk_contract' => '6'],

            ['id' =>5, 
            'shortcode' => 'MEDKALKALINIEC', 
            'name' => 'Kaliniec',
            'street'=>'Młyarska 3a', 
            'zipcode'=>'68-800',
            'location'=>'Kalisz',
            'phonenumber'=>'513623172',
            'distance'=>'100',
            'email'=>'biuro@kaliniec.pl',
            'fk_contract' => '6'],

            ['id' =>6, 
            'shortcode' => 'MEDSIETRESMED', 
            'name' => 'Tresmed',
            'street'=>'Kolegiacka 1a', 
            'zipcode'=>'98-250',
            'location'=>'Sieradz',
            'phonenumber'=>'513623173',
            'distance'=>'100',
            'email'=>'tresmed@op.pl',
            'fk_contract' => '6'],

            ['id' =>7, 
            'shortcode' => 'KAJA', 
            'name' => 'Kaja Meble',
            'street'=>'Braci Gilerów 3', 
            'zipcode'=>'62-800',
            'location'=>'Kalisz',
            'phonenumber'=>'513623177',
            'distance'=>'100',
            'email'=>'kaja@kalisz.pl',
            'fk_contract' => '7'],

            ['id' =>8, 
            'shortcode' => 'MEDKOTKOTLIN', 
            'name' => 'Przychodnia Kotlin',
            'street'=>'Kotlin 1', 
            'zipcode'=>'98-250',
            'location'=>'Kotlin',
            'phonenumber'=>'513623179',
            'distance'=>'100',
            'email'=>'tyrakowska@vp.pl',
            'fk_contract' => '6'],
            
                          
        ];

        foreach ($companies as $company) {
            DB::table('companies')->insert([
                'id' => $company['id'],               
                'shortcode' => $company['shortcode'],
                'name' => $company['name'],
                'street' => $company['street'],
                'zipcode' => $company['zipcode'],
                'location' => $company['location'],
                'phonenumber' => $company['phonenumber'],
                'distance' => $company['distance'],
                'email' => $company['email'],
                'fk_contract' => $company['fk_contract'],
              
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
