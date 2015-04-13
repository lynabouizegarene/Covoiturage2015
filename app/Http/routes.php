<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::get('covoiturage/publier', [
    'as' => 'covoiturage/create',
    'uses' => 'CovoiturageController@create'
]);
Route::post('covoiturage/enregistrer',[
    'as' => 'covoiturage/store',
    'uses' => 'CovoiturageController@store'
]);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
