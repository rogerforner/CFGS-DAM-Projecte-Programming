<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Web\WebController@getDashboard')->middleware('auth');

Auth::routes();


// Dashboard: Home.
Route::resource('dashboard', 'Web\DashboardController', [
    'only' => ['index']
]);


// Només l'usuari administrador té accés a les següents rutes.
Route::middleware(['role:admin'])->group(function () {
    // Dashboard: Passport.
    Route::resource('dashboard/access-tokens', 'Web\AccessTokenController', [
        'only' => ['index']
    ]);

    // Dashboard: Programming, Users.
    Route::resource('dashboard/users', 'Web\UserController', [
        'only' => ['index']
    ]);

    // Dashboard: Programming, Departments.
    Route::resource('dashboard/departments', 'Web\DepartmentController', [
        'only' => ['index']
    ]);
});


// En les següents rutes només podran accedir els/les Administradors/res i Professors/res.
Route::middleware(['role:admin|teacher'])->group(function () {
    // Dashboard: Programming, Professional Modules.
    Route::resource('dashboard/professional-modules', 'Web\ProfessionalModuleController', [
        'only' => ['index']
    ]);

    // Dashboard: Programming, Temaries.
    Route::resource('dashboard/temaries', 'Web\TemaryController', [
        'only' => ['index']
    ]);

    // Dashboard: Programming, Training Units.
    Route::resource('dashboard/training-units', 'Web\TrainingUnitController', [
        'only' => ['index']
    ]);
});


// Si no estem autenticats serem enviats a la pàgina de login.
// Des de aquesta escollirem amb quina xarxa social dur-lo a terme, passant el
// nom d'aquesta com a un /{paràmetre} de la url.
// - /login/github => /{social} on /{social} = /{github}
Route::group(['prefix' => 'login', 'middleware' => 'guest'], function () {
    Route::get('/', 'Web\WebController@getLogin' )->name('login');
    Route::get('/{social}', 'Auth\SocialAuthController@getSocialRedirect');
    Route::get('/{social}/callback', 'Auth\SocialAuthController@getSocialCallback');
});


// Imprimir PDFs
Route::get('dashboard/print-mp/{id}', 'PDF\ProfessionalModuleController@printPdf');
Route::get('dashboard/print-uf/{id}', 'PDF\TrainingUnitController@printPdf');