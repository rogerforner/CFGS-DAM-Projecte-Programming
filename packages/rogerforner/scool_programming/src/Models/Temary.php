<?php

namespace Rogerforner\ScoolProgramming\Models;

use Illuminate\Database\Eloquent\Model;

class Temary extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nf',
        'duration',
        'name',
        'description',
        'date_start',
        'date_end',
        'created_by',
        'modified_by'
    ];

    /**
     * Obtenir la Unitat Formativa del Nucli Formatiu.
     * Mètode en singular.
     */
    public function trainingUnit()
    {
        // belongsTo() Un NF pertany a una UF.
        return $this->belongsTo('Rogerforner\ScoolProgramming\Models\trainingUnit');
    }
}