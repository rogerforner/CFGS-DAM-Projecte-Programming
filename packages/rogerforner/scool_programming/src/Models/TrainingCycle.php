<?php

namespace Rogerforner\ScoolProgramming\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingCycle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
    
    /**
     * Obtenir la Família Professional del Cicle Formatiu.
     * Mètode en singular.
     */
    public function professionalFamily()
    {
        // belongsTo() Un CF pertany a una FP.
        return $this->belongsTo('Rogerforner\ScoolProgramming\Models\ProfessionalFamily');
    }

    /**
     * Obtenir els Mòduls Professionals del Cicle Formatiu.
     * Mètode en plural.
     */
    public function professionalModules()
    {
        // hasMany() Un CF té N MP.
        return $this->hasMany('Rogerforner\ScoolProgramming\Models\ProfessionalModule');
    }
}
