<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Contracts extends Model
{
    use SoftDeletes;

    public $table = 'contracts';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'contract_name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
