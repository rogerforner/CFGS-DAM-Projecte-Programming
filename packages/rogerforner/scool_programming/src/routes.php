<?php

use Illuminate\Http\Request;
use Rogerforner\ScoolProgramming\Http\Controllers\Web\AppController;
use Rogerforner\ScoolProgramming\Http\Controllers\Web\LandingController;

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
Route::group(['prefix' => 'programming', 'middleware' => 'auth:api'], function () {
    Route::resource('fp', 'Rogerforner\ScoolProgramming\Http\Controllers\API\ProfessionalFamilyController');
    Route::resource('cf', 'Rogerforner\ScoolProgramming\Http\Controllers\API\TrainingCycleController');
    Route::resource('mp', 'Rogerforner\ScoolProgramming\Http\Controllers\API\ProfessionalModuleController');
    Route::resource('uf', 'Rogerforner\ScoolProgramming\Http\Controllers\API\TrainingUnitController');
    Route::resource('nf', 'Rogerforner\ScoolProgramming\Http\Controllers\API\TemaryController');
});

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
Route::group(['prefix'=>'programming'], function () {
    // Vistes del propi paquet.
    Route::resource('scool', LandingController::class, ['only' => ['index']]);
    // Vistes a publicar amb vendor:publish.
    Route::resource('/', AppController::class, ['only' => ['index']]);
});