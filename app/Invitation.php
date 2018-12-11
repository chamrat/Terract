<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    protected $table = 'invitations';

    protected $fillable = ["tenant_email", "email_code", "property_unit_id", "verified"];
}
