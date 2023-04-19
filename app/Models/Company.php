<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model 
{
    use SoftDeletes;

    public $table = 'kontrahenci';

  

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'kontrahent_kod',
        'kontrahent_nazwa1',
        'kontrahent_nazwa2',
        'kontrahent_nazwa3',
        'kontrahent_ulica',
        'kontrahent_nrdomu',
        'kontrahent_nrlokalu',
        'kontrahent_miasto',
        'kontrahent_kodpocztowy',
        'kontrahent_poczta',
        'kontrahent_nip',
        'kontrahent_telefon1',
        'kontrahent_telefon2',
        'kontrahent_email',
        'kontrahent_odleglosc',
        'kontrahent_grupa',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // public function jobs()
    // {
    //     return $this->hasMany(Job::class, 'company_id', 'id');
    // }   

     public function locations()
     {
         return $this->belongsTo('App\Models\Location','fk_locations')->withTrashed();
     }
     public function contract()
     {
         return $this->belongsTo('App\Models\Contracts','kontrahent_grupa')->withTrashed();
     }

     public function location()
     {
         return $this->belongsTo(Location::class, 'fk_locations','id');
     }
  
}
