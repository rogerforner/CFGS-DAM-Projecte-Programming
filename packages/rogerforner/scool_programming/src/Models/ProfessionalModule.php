<?php

namespace Rogerforner\ScoolProgramming\Models;

use Illuminate\Database\Eloquent\Model;

class ProfessionalModule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['mp', 'name', 'date_start', 'date_end'];
    
    /**
     * Obtenir el Cicle Formatiu del Mòdul Professional.
     * Mètode en singular.
     */
    public function trainingCycle()
    {
        // belongsTo() Un MP pertany a un CF.
        return $this->belongsTo('Rogerforner\ScoolProgramming\Models\TrainingCycle');
    }

    /**
     * Obtenir les Unitats Formatives del Mòdul Professional.
     * Mètode en plural.
     */
    public function trainingUnits()
    {
        // hasMany() Un MP té N UF.
        return $this->hasMany('Rogerforner\ScoolProgramming\Models\ProfessionalModule');
    }
}
