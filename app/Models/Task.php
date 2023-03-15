<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Task extends Model
{
    use SoftDeletes;

    public $table = 'task';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'company',
        'fk_job',
        'user',
        'tasktype',
        'project',
        'category',
        'location',
        'start_task_date',
        'end_task_date',
        'task_start',
        'task_end',
        'task_description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company','company')->withTrashed();
    }
}
