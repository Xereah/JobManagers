<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskType_Pivot extends Model
{
    use HasFactory;



    public $table = 'task_type_type_task';


    protected $fillable = [
        'task_type_id',
        'type_task_id'
    ];

    public function TaskId()
    {
        return $this->belongsTo('App\Models\TypeTask','type_task_id')->withTrashed();
    }

}
