<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'inventory';

  

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'mark',
        'code',
        'model',
        'serial_number',
        'processor',
        'ram',
        'hard_drive',
        'hard_drive_capacity',
        'hard_drive_second',
        'hard_drive_capacity_second',
        'eq_type',
        'fk_company',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function company()
    {
         return $this->belongsTo('App\Models\Company','fk_company')->withTrashed();
    }
    public function EqCategory()
    {
        return $this->belongsTo('App\Models\EquipmentCategory','eq_type')->withTrashed();
    }
}
