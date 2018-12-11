<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $table = 'credit_cards';

    public function payments()
    {
        return $this->hasMany('App\Payment', 'credit_card_id', 'id');
    }

    public function landlord()
    {
        return $this->belongsTo('App\User');
    }
}
