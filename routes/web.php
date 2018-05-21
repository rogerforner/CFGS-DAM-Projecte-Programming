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

Route::group(['prefix'=>'dashboard'], function () {
    Route::resource('/', 'Web\DashboardController', [
        'only' => ['index']
    ]);
});

// // Si estem autenticats anirem a la / de l'aplicació.
// Route::get( '/', 'Web\AppController@getHome' )->middleware('auth');

// Si no estem autenticats serem enviats a la pàgina de login.
// Des de aquesta escollirem amb quina xarxa social dur-lo a terme, passant el
// nom d'aquesta com a un /{paràmetre} de la url.
// - /login/github => /{social} on /{social} = /{github}
Route::group(['prefix' => 'login', 'middleware' => 'guest'], function () {
    Route::get('/', 'Web\WebController@getLogin' )->name('login');
    Route::get('/{social}', 'Auth\SocialAuthController@getSocialRedirect');
    Route::get('/{social}/callback', 'Auth\SocialAuthController@getSocialCallback');
});
