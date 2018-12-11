<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PropertyUnit extends Model
{
    protected $table = 'property_units';

    public function property()
    {
        return $this->belongsTo('App\Property', 'property_id', 'id', 'property');
    }

    public function tenants()
    {
        return $this->belongsToMany(
            'App\User',
            'tenant_property_units',
            'property_unit_id',
            'user_id'
        );
    }

    public function payments()
    {
        return $this->hasMany('App\Payment', 'property_unit_id', 'id');
    }

    public function issues()
    {
        return $this->hasMany('App\Issue', 'property_unit_id', 'id');
    }
}
