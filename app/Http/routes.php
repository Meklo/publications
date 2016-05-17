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

// ## Route pour l'inscription d'un chercheur (get pour l'affichage du form,
// post pour l'envoie de données du form)
Route::get('inscriptions','ChercheursController@getInfos');
Route::post('inscriptions','ChercheursController@postInfos');
Route::controller('inscriptions', 'ChercheursController');

// ## Route pour toutes les pages du site de type : /nompage
Route::get('{n}', function($n)
{
    return view($n);
});
