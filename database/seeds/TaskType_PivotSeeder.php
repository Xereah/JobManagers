<?php

use Illuminate\Database\Seeder;

class TaskType_PivotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        $TaskType = [
            [
                
                'task_type_id' => '1',
                'type_task_id' => '1',
            ],
            [
                
                'task_type_id' => '1',
                'type_task_id' => '6',
            ],
            [
                
                'task_type_id' => '1',
                'type_task_id' => '7',
            ],
            [
                
                'task_type_id' => '2',
                'type_task_id' => '2',
            ],
            [
                
                'task_type_id' => '3',
                'type_task_id' => '3',
            ],
            [
                
                'task_type_id' => '3',
                'type_task_id' => '4',
            ],

            [
                
                'task_type_id' => '5',
                'type_task_id' => '6',
            ],
            [
                
                'task_type_id' => '5',
                'type_task_id' => '7',
            ],
            [
                
                'task_type_id' => '6',
                'type_task_id' => '8',
            ],
            [
                
                'task_type_id' => '6',
                'type_task_id' => '9',
            ],
        ];

        foreach ($TaskType as $TaskTypes) {
            DB::table('task_type_type_task')->insert([
                             
                'task_type_id' => $TaskTypes['task_type_id'],
                'type_task_id' => $TaskTypes['type_task_id'],
                             
            ]);
        }
    }
}
