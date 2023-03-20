<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Task extends Model
{
    use SoftDeletes;

    public $table = 'tasks';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'task_title',
        'task_description',
        'fk_company',
        'fk_user',
        'completed',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company','fk_company')->withTrashed();
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User','fk_user')->withTrashed();
    }
}
