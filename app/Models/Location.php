<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $primaryKey = 'id';

    protected $fillable = [
        'provider_id',
        'longtitud',
        'latitude',
    ];

    public function provider(){
        return $this->belongsTo('App\Models\User');
    }
}
