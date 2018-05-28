<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rogerforner\ScoolProgramming\Models\TrainingUnit;

class TrainingUnitController extends Controller
{
    /**
     * Create a new controller instance.
     * Only authenticated users will be able to interact with the methods of
     * this Controller.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Print a professional module data into a PDF format.
     * 
     * @param  $id
     * @return array
     */
    public function printPdf($id)
    {
        // Obtenim les dades de la unitat formativa.
        $data = $this->getData($id);

        // Crea l'objecte View amb la vista del disseny i les dades.
        // Tot seguit es renderitza.
        $pdf =  \PDF::loadView('pdf.mp', compact('data'));

        return $pdf->download('uf.pdf');
    }

    /**
     * Get data of a training unit.
     * 
     * @param  $id
     * @return array
     */
    public function getData($id)
    {
        // Obtenir la unitat formativa.
        $tunit = TrainingUnit::findOrFail($id);

        return $tunit;
    }
}
