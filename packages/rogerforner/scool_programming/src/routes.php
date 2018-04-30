<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
| php artisan route:list (veure rutes: scool-programming)
|
*/


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
| php artisan route:list (veure rutes: scool-programming)
|
*/
// Fem que només sigui generada la ruta corresponent al mètode index() del controlador.
Route::resource('scool-programming', 'Rogerforner\ScoolProgramming\Http\Controllers\MainController', [
    'only' => ['index']
]);