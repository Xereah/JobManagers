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
        'title', 
        'start', 
        'end',
        'fk_company',
        'fk_contract',
        'fk_user',
        'execution_date',
        'execution_user',
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

    public function users_exec()
    {
        return $this->belongsTo('App\Models\User','execution_user')->withTrashed();
    }
}
