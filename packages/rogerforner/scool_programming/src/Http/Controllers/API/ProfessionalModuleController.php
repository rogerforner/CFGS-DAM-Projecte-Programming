<?php

namespace Rogerforner\ScoolProgramming\Http\Controllers\API;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Rogerforner\ScoolProgramming\Http\Controllers\API\ApiResponseController;
use Rogerforner\ScoolProgramming\Models\ProfessionalModule;
use Validator;

class ProfessionalModuleController extends ApiResponseController
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
        // Obtenir tots els MPs.
        $professionalModules = ProfessionalModule::paginate(8);

        // Guardem en un array la paginació i els MPs.
        $response = [
            'pagination' => [
                'total'        => $professionalModules->total(),
                'per_page'     => $professionalModules->perPage(),
                'current_page' => $professionalModules->currentPage(),
                'last_page'    => $professionalModules->lastPage(),
                'from'         => $professionalModules->firstItem(),
                'to'           => $professionalModules->lastItem()
            ],
            'data' => $professionalModules
        ];
        
        // Retornem l'array amb els MPs i la paginació passant les dades
        // d'aquest a través del mètode sendResponse() de ApiResponseController.
        return $this->sendResponse($response, 'Professional Modules retrieved successfully.');
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
            'mp'            => 'required|integer',
            'name'          => 'required|string|max:150',
            'section1'      => 'nullable',
            'section2'      => 'nullable',
            'section3'      => 'nullable',
            'section4'      => 'nullable',
            'approved'      => 'required|boolean',
            'department_id' => 'nullable',
        ]);

        // Si la validació de les dades introduïdes no es satisfactoria avisem.
        if ($validator->fails()) {
            return $this->sendError('A validation error has occurred.', $validator->errors());
        }

        // Crear el MP (la validació ha sortit bé).
        $professionalModule = ProfessionalModule::create([
            'mp'            => $data['mp'],
            'name'          => $data['name'],
            'section1'      => $data['section1'],
            'section2'      => $data['section2'],
            'section3'      => $data['section3'],
            'section4'      => $data['section4'],
            'approved'      => $data['approved'],
            'department_id' => $data['department_id'],
            'created_by'    => $userAuth,
        ]);

        return $this->sendResponse(null, 'Professional Module created successfully.');
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

        // Obtenir el MP a modificar.
        $professionalModule = ProfessionalModule::findOrFail($id);

        // Obtenir l'usuari que duu a terme l'acció i l'afegim entre les dades
        // obtingudes per emplenar el camp "updated_by".
        $data['updated_by'] = Auth::user()->name;

        // Validar les dades.
        $validator = Validator::make($data, [
            'mp'            => 'required|integer',
            'name'          => 'required|string|max:150',
            'section1'      => 'nullable',
            'section2'      => 'nullable',
            'section3'      => 'nullable',
            'section4'      => 'nullable',
            'approved'      => 'required|boolean',
            'department_id' => 'nullable',
        ]);

        // Si la validació de les dades introduïdes no es satisfactoria avisem.
        if ($validator->fails()) {
            return $this->sendError('A validation error has occurred.', $validator->errors());
        }

        // Actualitzar el MP.
        $professionalModule->update($data);

        return $this->sendResponse(null, 'Professional Module updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Rogerforner\ScoolProgramming\Http\Controllers\API\ApiResponseController;
     */
    public function destroy($id)
    {
        // Obtenir el MP a eliminar.
        $professionalModule = ProfessionalModule::findOrFail($id);

        // Eliminar el MP.
        $professionalModule->delete();
        
        return $this->sendResponse(null, 'Professional Module removed successfully.');
    }
}
