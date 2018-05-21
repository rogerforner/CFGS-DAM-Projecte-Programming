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

// Si estem autenticats anirem a la / de l'aplicació.
Route::get( '/', 'Web\AppController@getHome' )->middleware('auth');

// Si no estem autenticats serem enviats a la pàgina de login.
// Des de aquesta escollirem amb quina xarxa social dur-lo a terme, passant el
// nom d'aquesta com a un /{paràmetre} de la url.
// - /login/github => /{social} on /{social} = /{github}
Route::group(['prefix' => 'login', 'middleware' => 'guest'], function () {
    Route::get('/', 'Web\AppController@getLogin' )->name('login');
    Route::get('/{social}', 'Web\AuthenticationController@getSocialRedirect');
    Route::get('/{social}/callback', 'Web\AuthenticationController@getSocialCallback');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
