<?php

namespace Rogerforner\ScoolProgramming\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalFamily extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];
    
    /**
     * Obtenir els Cicles Formatius de la Família Professional.
     * Mètode en plural.
     */
    public function trainingCycles()
    {
        // hasMany() Una FP té N CF.
        return $this->hasMany('Rogerforner\ScoolProgramming\Models\TrainingCycle');
    }
}
