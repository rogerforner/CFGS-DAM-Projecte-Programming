<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\ApiResponseController;
use App\User;
use Auth;
use Illuminate\Http\Request;

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
        //
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
        // Obtenir l'usuari/ria i esborrar-lo/la.
        $user = User::findOrFail($id);

        // No permetem esborrar l'usuari/ria amb id 1 (administrador/ra).
        // No permetem esborrar el propi usuari.
        if ($user->id === 1) {
            return $this->sendError('You can not delete the user with ID = 1 (administrator).');
        } elseif ($user->id == Auth::user()->id) {
            return $this->sendError('You can not delete your user.');
        } else {
            return $this->sendResponse(null, 'User removed successfully.');
        }
    }
}
