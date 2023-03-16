<?php
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'surname'           => 'Admin',
                'email'          => 'dok@kasper.pl',
                'password'       => bcrypt('1kalisz.'),
                'remember_token' => null,
            ],
            [
                'id'             => 2,
                'name'           => 'Patryk',
                'surname'           =>'Struzik',
                'email'          => 'patrykstruzik@onet.pl',
                'password'       => bcrypt('Loser45322'),
                'remember_token' => null,
            ],
            [
                'id'             => 3,
                'name'           => 'Wojciech',
                'surname'           =>'Kasper',
                'email'          => 'wojtek@kasper.pl',
                'password'       => bcrypt('Kasper1234'),
                'remember_token' => null,
            ],
            [
                'id'             => 4,
                'name'           => 'Damian',
                'surname'           =>'Fijałkowski',
                'email'          => 'damian.fijałkowski@kasper.pl',
                'password'       => bcrypt('Kasper1234'),
                'remember_token' => null,
            ],
            [
                'id'             => 5,
                'name'           => 'Tomasz',
                'surname'           =>'Sikora',
                'email'          => 'tomasz.sikora@kasper.pl',
                'password'       => bcrypt('Kasper1234'),
                'remember_token' => null,
            ],
            [
                'id'             => 6,
                'name'           => 'Marcin',
                'surname'           =>'Rachelski',
                'email'          => 'marcin.rachelski@kasper.pl',
                'password'       => bcrypt('Kasper1234'),
                'remember_token' => null,
            ],
            [
                'id'             => 7,
                'name'           => 'Wioletta',
                'surname'           =>'Rachwalska',
                'email'          => 'wioletta.rachwalska@kasper.pl',
                'password'       => bcrypt('Kasper1234'),
                'remember_token' => null,
            ],
            [
                'id'             => 8,
                'name'           => 'Jan',
                'surname'           =>'Kasper',
                'email'          => 'jan@kasper.pl',
                'password'       => bcrypt('Kasper1234'),
                'remember_token' => null,
            ],
            
            
        ];

        User::insert($users);
    }
}
