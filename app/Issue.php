<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    protected $table = 'issues';

    public function propertyUnit()
    {
        return $this->belongsTo('App\PropertyUnit');
    }
}
