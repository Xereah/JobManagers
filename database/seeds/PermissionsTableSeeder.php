<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '2',
                'title' => 'permission_create',
            ],
            [
                'id'    => '3',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '4',
                'title' => 'permission_show',
            ],
            [
                'id'    => '5',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '6',
                'title' => 'permission_access',
            ],
            [
                'id'    => '7',
                'title' => 'role_create',
            ],
            [
                'id'    => '8',
                'title' => 'role_edit',
            ],
            [
                'id'    => '9',
                'title' => 'role_show',
            ],
            [
                'id'    => '10',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11',
                'title' => 'role_access',
            ],
            [
                'id'    => '12',
                'title' => 'user_create',
            ],
            [
                'id'    => '13',
                'title' => 'user_edit',
            ],
            [
                'id'    => '14',
                'title' => 'user_show',
            ],
            [
                'id'    => '15',
                'title' => 'user_delete',
            ],
            [
                'id'    => '16',
                'title' => 'user_access',
            ],
            [
                'id'    => '17',
                'title' => 'user_dictionaries_access',
            ],
            [
                'id'    => '18',
                'title' => 'company_create',
            ],
            [
                'id'    => '19',
                'title' => 'company_edit',
            ],
            [
                'id'    => '20',
                'title' => 'company_show',
            ],
            [
                'id'    => '21',
                'title' => 'company_delete',
            ],
            [
                'id'    => '22',
                'title' => 'company_access',
            ],
            [
                'id'    => '23',
                'title' => 'job_create',
            ],
            [
                'id'    => '24',
                'title' => 'job_edit',
            ],
            [
                'id'    => '25',
                'title' => 'job_show',
            ],
            [
                'id'    => '26',
                'title' => 'job_delete',
            ],
            [
                'id'    => '27',
                'title' => 'job_access',
            ],
            [
                'id'    => '28',
                'title' => 'TaskType_create',
            ],
            [
                'id'    => '29',
                'title' => 'TaskType_edit',
            ],
            [
                'id'    => '30',
                'title' => 'TaskType_show',
            ],
            [
                'id'    => '31',
                'title' => 'TaskType_delete',
            ],
            [
                'id'    => '32',
                'title' => 'TaskType_access',
            ],
            [
                'id'    => '33',
                'title' => 'TypeTask_create',
            ],
            [
                'id'    => '34',
                'title' => 'TypeTask_edit',
            ],
            [
                'id'    => '35',
                'title' => 'TypeTask_show',
            ],
            [
                'id'    => '36',
                'title' => 'TypeTask_delete',
            ],
            [
                'id'    => '37',
                'title' => 'TypeTask_access',
            ],
            [
                'id'    => '38',
                'title' => 'mail_config_access',
            ],
            [
                'id'    => '39',
                'title' => 'mail_config_update',
            ],
            [
                'id'    => '40',
                'title' => 'equipment_access',
            ],
            [
                'id'    => '41',
                'title' => 'equipment_create',
            ],
            [
                'id'    => '42',
                'title' => 'equipment_show',
            ],
            [
                'id'    => '43',
                'title' => 'equipment_delete',
            ],
            [
                'id'    => '44',
                'title' => 'equipment_edit',
            ],
            [
                'id'    => '45',
                'title' => 'car_access',
            ],
            [
                'id'    => '46',
                'title' => 'car_create',
            ],
            [
                'id'    => '47',
                'title' => 'car_show',
            ],
            [
                'id'    => '48',
                'title' => 'car_delete',
            ],
            [
                'id'    => '49',
                'title' => 'car_edit',
            ],
            [
                'id'    => '50',
                'title' => 'town_access',
            ],
            [
                'id'    => '51',
                'title' => 'town_create',
            ],
            [
                'id'    => '52',
                'title' => 'town_edit',
            ],
            [
                'id'    => '53',
                'title' => 'town_delete',
            ],
            [
                'id'    => '54',
                'title' => 'ConfirmSystem_Access',
            ],

          
            
        ];

        Permission::insert($permissions);
    }
}
