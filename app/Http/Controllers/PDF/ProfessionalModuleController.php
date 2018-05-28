<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rogerforner\ScoolProgramming\Models\ProfessionalModule;

class ProfessionalModuleController extends Controller
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
        // Obtenim les dades del mòdul professional.
        $data = $this->getData($id);

        // Crea l'objecte View amb la vista del disseny i les dades.
        // Tot seguit es renderitza.
        $pdf =  \PDF::loadView('pdf.mp', compact('data'));

        return $pdf->download('mp.pdf');
    }

    /**
     * Get data of a professional module.
     * 
     * @param  $id
     * @return array
     */
    public function getData($id)
    {
        // Obtenir el mòdul professional.
        $promodule = ProfessionalModule::findOrFail($id);

        return $promodule;
    }
}
