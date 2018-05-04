<?php

namespace Rogerforner\ScoolProgramming\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Rogerforner\ScoolProgramming\Models\ProfessionalModule;

class Department extends Model
{
    /**
     * Inserting & Updating Models.
     **************************************************************************/
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    /**
     * Eloquent: Relationships.
     **************************************************************************/
    /**
     * Users.
     * The users that belong to the department.
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Professional Modules.
     * Get the professional modules for the department.
     */
    public function professionalModules()
    {
        return $this->hasMany(ProfessionalModule::class);
    }
}
