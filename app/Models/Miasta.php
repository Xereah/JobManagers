<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Miasta extends Model
{
    use HasFactory;

    use SoftDeletes;

    public $table = 'kontrahenci_miasta';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'kontrahent_miasto',
        'kontrahent_kodpocztowy',
        'kontrahent_odleglosc',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
