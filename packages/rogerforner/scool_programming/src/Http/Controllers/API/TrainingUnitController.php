<?php

namespace Rogerforner\ScoolProgramming\Http\Controllers\API;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Rogerforner\ScoolProgramming\Http\Controllers\API\ApiResponseController;
use Rogerforner\ScoolProgramming\Models\TrainingUnit;
use Validator;

class TrainingUnitController extends ApiResponseController
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
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Rogerforner\ScoolProgramming\Http\Controllers\API\ApiResponseController;
     */
    public function index()
    {
        // Obtenir totes les UFs.
        $trainingUnits = TrainingUnit::paginate(8);

        // Guardem en un array la paginació i les UFs.
        $response = [
            'pagination' => [
                'total'        => $trainingUnits->total(),
                'per_page'     => $trainingUnits->perPage(),
                'current_page' => $trainingUnits->currentPage(),
                'last_page'    => $trainingUnits->lastPage(),
                'from'         => $trainingUnits->firstItem(),
                'to'           => $trainingUnits->lastItem()
            ],
            'data' => $trainingUnits
        ];
        
        // Retornem l'array amb les UFs i la paginació passant les dades
        // d'aquest a través del mètode sendResponse() de ApiResponseController.
        return $this->sendResponse($response, 'Training Units retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Rogerforner\ScoolProgramming\Http\Controllers\API\ApiResponseController;
     */
    public function store(Request $request)
    {
        // Obtenir l'usuari que duu a terme l'acció.
        $userAuth = Auth::user()->name;

        // Dades del formulari.
        $data = $request->all();

        // Validar les dades.
        $validator = Validator::make($data, [
            'mp'                     => 'required|integer',
            'name'                   => 'required|string|max:150',
            'date_start'             => 'required|date',
            'date_end'               => 'required|date',
            'section1'               => 'nullable',
            'section2'               => 'nullable',
            'section3'               => 'nullable',
            'section4'               => 'nullable',
            'approved'               => 'required|boolean',
            'professional_module_id' => 'nullable',
        ]);

        // Si la validació de les dades introduïdes no es satisfactoria avisem.
        if ($validator->fails()) {
            return $this->sendError('A validation error has occurred.', $validator->errors());
        }

        // Crear la UF (la validació ha sortit bé).
        $trainingUnit = TrainingUnit::create([
            'mp'                     => $data['mp'],
            'name'                   => $data['name'],
            'date_start'             => $data['date_start'],
            'date_end'               => $data['date_end'],
            'section1'               => $data['section1'],
            'section2'               => $data['section2'],
            'section3'               => $data['section3'],
            'section4'               => $data['section4'],
            'approved'               => $data['approved'],
            'professional_module_id' => $data['professional_module_id'],
            'created_by'             => $userAuth,
        ]);

        return $this->sendResponse(null, 'Training Unit created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Rogerforner\ScoolProgramming\Http\Controllers\API\ApiResponseController;
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Rogerforner\ScoolProgramming\Http\Controllers\API\ApiResponseController;
     */
    public function update(Request $request, $id)
    {
        // Dades del formulari.
        $data = $request->all();

        // Obtenir la UF a modificar.
        $trainingUnit = TrainingUnit::findOrFail($id);

        // Obtenir l'usuari que duu a terme l'acció i l'afegim entre les dades
        // obtingudes per emplenar el camp "updated_by".
        $data['updated_by'] = Auth::user()->name;

        // Validar les dades.
        $validator = Validator::make($data, [
            'mp'                     => 'required|integer',
            'name'                   => 'required|string|max:150',
            'date_start'             => 'required|date',
            'date_end'               => 'required|date',
            'section1'               => 'nullable',
            'section2'               => 'nullable',
            'section3'               => 'nullable',
            'section4'               => 'nullable',
            'approved'               => 'required|boolean',
            'professional_module_id' => 'nullable',
        ]);

        // Si la validació de les dades introduïdes no es satisfactoria avisem.
        if ($validator->fails()) {
            return $this->sendError('A validation error has occurred.', $validator->errors());
        }

        // Actualitzar la UF.
        $trainingUnit->update($data);

        return $this->sendResponse(null, 'Training Unit updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Rogerforner\ScoolProgramming\Http\Controllers\API\ApiResponseController;
     */
    public function destroy($id)
    {
        // Obtenir la UF a eliminar.
        $trainingUnit = TrainingUnit::findOrFail($id);

        // Eliminar la UF.
        $trainingUnit->delete();
        
        return $this->sendResponse(null, 'Training Unit removed successfully.');
    }
}
