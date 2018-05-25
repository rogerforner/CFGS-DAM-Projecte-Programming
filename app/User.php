<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Rogerforner\ScoolProgramming\Models\Department;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'created_by',
        'updated_by',
        'department_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Eloquent: Relationships.
     **************************************************************************/
    /**
     * Department.
     * Get the department that owns the user.
     */
    public function department()
    {
        return $this->hasOne(Department::class);
    }

    /**
     * The departments that belong to the user.
     */
    public function departments()
    {
        return $this->belongsToMany(Department::class)->withPivot('id');
    }
}
