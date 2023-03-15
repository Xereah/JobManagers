<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RepEquipment extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'rep_equipment';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'eq_number',
        'eq_name',
        'serial_number',
        'entry_date',
        'comments',
        'company_place',
        'eq_category',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_place')->withTrashed();
    }

    public function EqCategory()
    {
        return $this->belongsTo('App\Models\EquipmentCategory','eq_category')->withTrashed();
    }
}
