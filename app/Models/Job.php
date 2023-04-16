<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;

    public $table = 'jobs';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'fk_company',
        'order',
        'fk_user',
        'rns',
        'fk_tasktype',
        'fk_contract',
        'paid',
        'start_date',
        'end_date',
        'start',
        'time',
        'end',
        'fk_typetask',
        'description',
        'comments',
        'fk_contract',
        'value',
        'location',
        'description_goods',
        'fk_car',
        'start_car',
        'end_car',
        'fk_rep_eq',
        'description_eq',
        'paid_goods',
        'value_goods',
        'paid_eq',
        'paid_job',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

  

    public function company()
    {
        return $this->belongsTo('App\Models\Company','fk_company')->withTrashed();
    }

    public function contract()
    {
        return $this->belongsTo('App\Models\Contracts','fk_contract')->withTrashed();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','fk_user')->withTrashed();
    }
    public function project()
    {
        return $this->belongsTo('App\Models\Project','fk_project')->withTrashed();
    }
    public function task_type()
    {
        return $this->belongsTo('App\Models\TaskType','fk_tasktype')->withTrashed();
    }

    public function categories()
    {
        return $this->belongsTo('App\Models\Category','fk_category')->withTrashed();
    }
    public function new_location()
    {
        return $this->belongsTo('App\Models\Company','location')->withTrashed();
    }

    public function type_task()
    {
        return $this->belongsTo('App\Models\TypeTask','fk_typetask')->withTrashed();
    }
    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }

    public function users()
    {
        return $this->belongsTo(Job::class, 'fk_user', 'id');
    }
    public function repeq()
    {
        return $this->belongsTo('App\Models\RepEquipment','fk_rep_eq')->withTrashed();
    }

}
