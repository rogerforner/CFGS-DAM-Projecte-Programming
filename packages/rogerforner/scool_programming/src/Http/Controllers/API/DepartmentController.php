<?php

namespace Rogerforner\ScoolProgramming\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Rogerforner\ScoolProgramming\Models\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtenir tots els departaments.
        $departments = Department::all();

        // Retornem un JSON.
        return response()->json($departments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Obtenir l'usuari que duu a terme l'acció.
        $user = Auth::user()->username;

        // Validar dades obtingudes del formulari.
        $data = $request->validate([
            'name'        => 'required|unique:departments|string|max:150',
            'description' => 'string|max:255',
        ]);

        // Crear el departament (la validació ha sortit bé).
        $department = Department::create([
            'name'        => $data['name'],
            'description' => $data['description'],
            'created_by'  => $user,
        ]);

        // Retornem un JSON amb resposta 201 (creació d'una entitat).
        return response()->json($department, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
