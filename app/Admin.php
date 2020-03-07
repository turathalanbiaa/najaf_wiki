<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Relation with role
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }
    /*
     * Check multiple roles
     * @param array $roles
     */
    public function hasAnyRole($roles)
    {
        if (is_array($roles)) {
            return null !== $this->roles()->whereIn('name', $roles)->first();
        }
        return $this->hasRole($roles);
    }
    /*
     * Check one role
     * @param string $role
     */
    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }
}