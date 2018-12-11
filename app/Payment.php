<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    public function propertyUnit()
    {
        return $this->belongsTo('App\PropertyUnit');
    }

    public function creditCard()
    {
        return $this->belongsTo('App\CreditCard', 'credit_card_id');
    }
}
