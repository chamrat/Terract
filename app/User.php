<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstName', 'lastName', 'telephone', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(
            'App\Role',
            'role_users',
            'user_id',
            'role_id'
        );
    }

    /**
     * This is only for Tenants
     * Data from tenant_property_units
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function propertyUnits()
    {
        return $this->belongsToMany(
            'App\PropertyUnit',
            'tenant_property_units',
            'user_id',
            'property_unit_id'
        );
    }

    public function properties()
    {
        return $this->hasMany(
            'App\Property',
            'landlord_id',
            'id'
        );
    }

    public function creditCards()
    {
        return $this->hasMany(
            'App\CreditCard',
            'tenant_id',
            'id'
        );
    }

    public function hasAccess(array $permissions)
    {
        $roles = $this->roles();
        try{
            foreach ($this->roles()->get() as $role){
                if($role->hasAccess($permissions)){
                    return true;
                }
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        return false;
        /*$message = 'Access denied for this action!';
        $msgClass = 'alert-warning';
        return view('common.error')->with(compact('message'))
            ->with(compact($msgClass));*/
    }
}
