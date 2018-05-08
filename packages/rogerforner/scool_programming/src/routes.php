<?php

use Illuminate\Http\Request;
use Rogerforner\ScoolProgramming\Http\Controllers\API\DepartmentController;
use Rogerforner\ScoolProgramming\Http\Controllers\API\ProfessionalModuleController;
use Rogerforner\ScoolProgramming\Http\Controllers\API\TrainingUnitController;
use Rogerforner\ScoolProgramming\Http\Controllers\API\TemaryController;
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
    Route::resource('dp', DepartmentController::class);
    Route::resource('mp', ProfessionalModuleController::class);
    Route::resource('uf', TrainingUnitController::class);
    Route::resource('nf', TemaryController::class);
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
    Route::resource('scool', LandingController::class, ['only' => ['index']]);
});