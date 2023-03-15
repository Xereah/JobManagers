<?php


use Illuminate\Database\Seeder;
use App\Models\Mailsetting;
class MailsettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mailsetting::create([
            'mail_transport'            =>'smtp',
            'mail_host'                 =>'poczta23128.e-kei.pl',
            'mail_port'                 =>'465',
            'mail_username'             =>'jm@jm.kasper.pl',
            'mail_password'             =>'u3G}w8Z}m8',
            'mail_encryption'           =>'SSL',
            'mail_from'                 => 'jm@jm.kasper.pl',
        ]);
    }
}
