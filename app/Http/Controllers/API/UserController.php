<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiResponseController;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class UserController extends ApiResponseController
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtenir tots els usuaris.
        $users = User::all();
        
        // Retornem tots els usuaris passant les dades a través del mètode
        // sendResponse() de ApiResponseController.
        return $this->sendResponse($users->toArray(), 'Users retrieved successfully.');
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

        // Dades del formulari.
        $data = $request->all();

        // Validar les dades.
        $validator = Validator::make($data, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Si la validació de les dades introduïdes no es satisfactoria avisem.
        if ($validator->fails()) {
            return $this->sendError('A validation error has occurred.', $validator->errors());
        }

        // Crear l'usuari (la validació ha sortit bé).
        $user = User::create([
            'name'       => $data['name'],
            'email'      => $data['email'],
            'password'   => bcrypt($data['password']),
            'created_by' => $user,
        ]);

        return $this->sendResponse(null, 'User created successfully.');
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
        // Obtenir l'usuari.
        $user = User::findOrFail($id);

        // Dades del formulari.
        $data = $request->all();

        // Validar les dades.
        $validator = Validator::make($data, [
            'name'     => 'required|string|max:255',
            'email'    => [
                'required',
                'strings',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'password' => 'confirmed', // No obligatori (en edició).
        ]);

        // Si la validació de les dades introduïdes no es satisfactoria avisem.
        if ($validator->fails()) {
            return $this->sendError('A validation error has occurred.', $validator->errors());
        }

        // Tractar el camp Password per si no és null (no és "required").
        if ($data['password'] != null) {
            // Encriptar password en cas de que s'hagi inserit.
            $data['password'] = bcrypt($data['password']);
        } else {
            // El treiem del array $data en cas de que no s'hagi inserit.
            unset($data['password']);
        }

        // Actualitzar l'usuari.
        $user->update($data);

        return $this->sendResponse(null, 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Obtenir l'usuari/ria i esborrar-lo/la.
        $user = User::findOrFail($id);

        // No permetem esborrar l'usuari/ria amb id 1 (administrador/ra).
        // No permetem esborrar el propi usuari.
        if ($user->id === 1) {
            return $this->sendError('You can not delete the user with ID = 1 (administrator).');
        } elseif ($user->id == Auth::user()->id) {
            return $this->sendError('You can not delete your user.');
        } else {
            $user->delete();
            return $this->sendResponse(null, 'User removed successfully.');
        }
    }
}
