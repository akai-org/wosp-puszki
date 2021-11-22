<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * @param string|array $roles
     * @return bool
     */

    public function authorizeRoles($roles)
    {
        //Autoryzacja użytkowników
        if (is_array($roles)) {
            return $this->hasAnyRole($roles) ||
                abort(401, 'Brak dostępu.');
        }
        return $this->hasRole($roles) ||
            abort(401, 'Brak dostępu.');
    }

    /**
     * Check multiple roles
     * @param array $roles
     * @return bool
     */

    public function hasAnyRole($roles)
    {
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }

    /**
     * Check one role
     * @param string $role
     * @return bool
     */

    public function hasRole($role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

}
