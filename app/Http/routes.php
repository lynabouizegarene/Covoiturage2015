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

Route::get('acceuil', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

Route::get('covoiturage/publier', [
    'as' => 'covoiturage/create',
    'uses' => 'CovoiturageController@create'
]);
Route::post('covoiturage/enregistrer',[
    'as' => 'covoiturage/store',
    'uses' => 'CovoiturageController@store',
]);

Route::get('covoiturage/{id}', [
    'as' => 'covoiturage/show',
    'uses' => 'CovoiturageController@show'
])->where(['id' => '[0-9]+']);

Route::get('profil/{id}', [
    'as' => 'user/show',
    'uses' => 'UserController@show'
])->where(['id' => '[0-9]+']);

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
