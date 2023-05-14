<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

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
        

    ];
}
