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

// ## Route pour la page d'accueil à l'index.php : /
Route::get('/', function () {
    return view('accueil');
});

// ## Routes des méthodes du ChercheursController
Route::resource('chercheur','ChercheursController');
Route::get('chercheur/create/complete_equipe/{organisation}', 'EquipesController@getByOrganisation');

// ## Route pour toutes les pages du site de type : /nompage
Route::get('{n}', function($n)
{
    return view($n);
});
