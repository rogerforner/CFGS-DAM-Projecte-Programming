<?php

namespace Rogerforner\ScoolProgramming\Http\Controllers\API;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Rogerforner\ScoolProgramming\Http\Controllers\API\ApiResponseController;
use Rogerforner\ScoolProgramming\Models\Department;
use Validator;

class DepartmentController extends ApiResponseController
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
        // Obtenir tots els departaments.
        $departments = Department::paginate(8);

        // Guardem en un array la paginació i els departaments.
        $response = [
            'pagination' => [
                'total'        => $departments->total(),
                'per_page'     => $departments->perPage(),
                'current_page' => $departments->currentPage(),
                'last_page'    => $departments->lastPage(),
                'from'         => $departments->firstItem(),
                'to'           => $departments->lastItem()
            ],
            'data' => $departments
        ];
        
        // Retornem l'array amb els departaments i la paginació passant les dades
        // d'aquest a través del mètode sendResponse() de ApiResponseController.
        return $this->sendResponse($response, 'Departments retrieved successfully.');
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
            'name'        => 'required|string|max:150|unique:departments',
            'description' => 'nullable',
        ]);

        // Si la validació de les dades introduïdes no es satisfactoria avisem.
        if ($validator->fails()) {
            return $this->sendError('A validation error has occurred.', $validator->errors());
        }

        // Crear el departament (la validació ha sortit bé).
        $department = Department::create([
            'name'        => $data['name'],
            'description' => $data['description'],
            'created_by'  => $userAuth,
        ]);

        return $this->sendResponse(null, 'Department created successfully.');
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

        // Obtenir el departament a modificar.
        $department = Department::findOrFail($id);

        // Obtenir l'usuari que duu a terme l'acció i l'afegim entre les dades
        // obtingudes per emplenar el camp "updated_by".
        $data['updated_by'] = Auth::user()->name;

        // Validar les dades.
        $validator = Validator::make($data, [
            'name' => [
                'required',
                'string',
                'max:150',
                Rule::unique('departments')->ignore($department->id)
            ],
            'description' => 'nullable',
        ]);

        // Si la validació de les dades introduïdes no es satisfactoria avisem.
        if ($validator->fails()) {
            return $this->sendError('A validation error has occurred.', $validator->errors());
        }

        // Actualitzar el departament.
        $department->update($data);

        return $this->sendResponse(null, 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Rogerforner\ScoolProgramming\Http\Controllers\API\ApiResponseController;
     */
    public function destroy($id)
    {
        // Obtenir el departament a eliminar.
        $department = Department::findOrFail($id);

        // Eliminar el departament.
        $department->delete();
        
        return $this->sendResponse(null, 'Department removed successfully.');
    }
}
