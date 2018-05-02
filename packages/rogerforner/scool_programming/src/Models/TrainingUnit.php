<?php

namespace Rogerforner\ScoolProgramming\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingUnit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uf', 'name', 'section1', 'section2', 'section3', 'section4', 'approved'];

    /**
     * Obtenir el Mòdul Professional de la Unitat Formativa.
     * Mètode en singular.
     */
    public function professionalModule()
    {
        // belongsTo() Una UF pertany a un MP.
        return $this->belongsTo('Rogerforner\ScoolProgramming\Models\ProfessionalModule');
    }

    /**
     * Obtenir els Nuclis Formatius de la Unitat Formativa.
     * Mètode en plural.
     */
    public function temaries()
    {
        // hasMany() Una UF té N NF.
        return $this->hasMany('Rogerforner\ScoolProgramming\Models\Temary');
    }
}
