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
        'description',
        'fk_company_rent',
        'fk_user_rent',
        'equipment_id',
        'modified_at',
        'rental_date',
        'return_date',
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company','fk_company_rent')->withTrashed();
    }

    public function EqCategory()
    {
        return $this->belongsTo('App\Models\RepEquipment','equipment_id')->withTrashed();
    }

    public function UserCategory()
    {
        return $this->belongsTo('App\Models\User','fk_user_rent')->withTrashed();
    }
}
