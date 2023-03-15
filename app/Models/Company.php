<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Company extends Model 
{
    use SoftDeletes;

    public $table = 'companies';

  

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'shortcode',
        'name',
        'street',
        'zipcode',
        'location',
        'phonenumber',
        'email',
        'distance',
        'fk_contract',
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
         return $this->belongsTo('App\Models\Contracts','fk_contract')->withTrashed();
     }

     public function location()
     {
         return $this->belongsTo(Location::class, 'fk_locations','id');
     }
  
}
