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
    protected $fillable = [
        'mp',
        'name',
        'section1',
        'section2',
        'section3',
        'section4',
        'approved',
        'date_start',
        'date_end',
        'created_by',
        'modified_by'
    ];
    
    /**
     * Obtenir les Unitats Formatives del Mòdul Professional.
     * Mètode en plural.
     */
    public function trainingUnits()
    {
        // hasMany() Un MP té N UF.
        return $this->hasMany('Rogerforner\ScoolProgramming\Models\professionalModule');
    }
}