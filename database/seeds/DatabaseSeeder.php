<?php

use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\DatabaseTransactions;
class DatabaseSeeder extends Seeder
{
    use DatabaseTransactions;
    public function run()
    {
        $this->call([
            PermissionsTableSeeder::class,
            ContractsSeeder::class,  
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            UsersTableSeeder::class,
            RoleUserTableSeeder::class,
            CompaniesTableSeeder::class,
            TaskTypeTableSeeder::class,
            TypeTaskTableSeeder::class,
            TaskType_PivotSeeder::class,
            MailsettingSeeder::class,
            EquipmentCategorys::class,
            CarTableSeeder::class,
            RepEQSeeder::class,                    
           // JobSeeder::class,
        ]);
    }
}
