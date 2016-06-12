<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\PublicationRepository;
use App\EloquentModels\Publication;

use App\Repositories\CategorieRepository;
use App\EloquentModels\Categorie;

use App\Repositories\UserRepository;
use App\EloquentModels\User;

use App\Repositories\OrganisationRepository;
use App\Repositories\EquipeRepository;

use App\EloquentModels\Organisation;
use App\EloquentModels\Equipe;



class SearchController extends Controller
{
    public function search(Request $request)
    {
        $equipeRep = new EquipeRepository($equipe_m = new Equipe());
        $organisationRep = new OrganisationRepository($organisation_m = new Organisation());
        $rep_user = new UserRepository($user_m = new User());
        $rep_categories = new CategorieRepository($categorie_m = new Categorie());
        $rep_publications = new PublicationRepository($publication_m = new Publication());
        
        
        $search = $request->input('recherche');
        $result = $rep_publications->getByTitle($search);
       
        if($result->count() == 0 && $search.contains(' '))
            $result = $rep_user->getPublicationsByNames($search);
        
        return view('search.result_publication', compact('result'));
    }
}
