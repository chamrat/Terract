<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Role
 * @package App
 */
class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = ['name', 'slug', 'permissions'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(
            'App\User',
            'role_users',
            'role_id',
            'user_id'
        );
    }

    /**
     * @param array $permissions
     * @return bool
     */
    public function hasAccess(array $permissions)
    {
        foreach ($permissions as $permission){
            if($this->hasPermission($permission)){
                return true;
            }
            return false;
        }
    }

    /**
     * @param $permission
     * @return bool
     */
    protected function hasPermission($permission)
    {
        $permissions = json_decode($this->permissions, true);
        if(isset($permissions[$permission])) {
            return $permissions[$permission];
        }
        return false;
    }
}
