<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepEquipmentHistory extends Model
{
    use HasFactory;
    public $table = 'rep_equipment_history';

    protected $fillable = [
        'equipment_id',
        'field_name',
        'old_value',
        'new_value',
        'modified_at',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company','new_value')->withTrashed();
    }

    public function companytwo()
    {
        return $this->belongsTo('App\Models\Company','old_value')->withTrashed();
    }

    public function EqCategory()
    {
        return $this->belongsTo('App\Models\EquipmentCategory','new_value')->withTrashed();
    }

    public function EqCategorytwo()
    {
        return $this->belongsTo('App\Models\EquipmentCategory','old_value')->withTrashed();
    }
}
