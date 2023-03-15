<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory;

    public $table = 'notifications';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user',
        'order',
        'date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function NotificationUser()
    {
        return $this->belongsTo('App\Models\User','user')->withTrashed();
    }
}
