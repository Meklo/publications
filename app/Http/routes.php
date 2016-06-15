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
Route::get('user/{id}/publications', array('as' => 'user.publications', 'uses' => 'UsersController@publications'));

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

// ## Publications
//Route::resource('publication','PublicationsController');

// ## Affichages des publications
Route::get('publication',  array('as' => 'publication.index', 'uses' => 'PublicationsController@index'));
Route::get('publication/{id}', array('as' => 'publication.show', 'uses' => 'PublicationsController@show'))->where('id', '[0-9]+');

##Modification d'une publication
Route::get('publication/{id}/edit', array('as' => 'publication.edit', 'uses' => 'PublicationsController@edit'))->where('id', '[0-9]+');
Route::post('publication/{id}/update', array('as' => 'publication.update', 'uses' => 'PublicationsController@update'))->where('id', '[0-9]+');



##Routes pour créer une publication
Route::get('publication/choosetype', 'PublicationsController@getPublicationStep1');
Route::post('publication/choosetype', 'PublicationsController@postPublicationStep1');

Route::get('publication/create', 'PublicationsController@getPublicationStep2');
Route::post('publication/create', 'PublicationsController@postPublicationStep2');

##Route pour présenter les résultats d'une recherche

Route::get('/search', 'HomeController@accueil');
Route::post('/search', 'SearchController@search');

Route::get('/search/publications/equipe', array('as' => 'equipe.publicationForm', 'uses' => 'EquipesController@getPublicationsForm'));

## Route pour la page d'administration
Route::get('admin',  array('as' => 'admin.index', 'uses' => 'AdminController@index'));
Route::get('admin/rank',  array('as' => 'admin.rank', 'uses' => 'AdminController@rank'));
Route::get('admin/kink',  array('as' => 'admin.kink', 'uses' => 'AdminController@kink'));
