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
/*
Route::get('/', function () {
    return view('accueil');
});*/

// ## Routes des méthodes du ChercheursController
Route::resource('user','UsersController');

Route::get('accueil', array('as' => 'accueil', function()
    {
        return View::make('accueil');
    })
);
// ## Routes pour l'authentification
Route::auth();
Route::get('/accueil', 'HomeController@accueil');
Route::get('/home', 'HomeController@index');
Route::get('register/complete_equipe/{organisation}', 'EquipesController@getByOrganisation');
