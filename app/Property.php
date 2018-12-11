<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';

    public function units()
    {
        return $this->hasMany('App\PropertyUnit', '');
    }

    public function landLoard()
    {
        return $this->belongsTo('App\User', 'landlord_id', 'id');
    }
}
