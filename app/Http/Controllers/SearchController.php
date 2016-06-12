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
    
    
    protected $equipeRep;
    protected $organisationRep;
    protected $rep_user;
    protected $rep_categories ;
    protected $rep_publications ;
    
    public function __construct()
    {
         $equipeRep = new EquipeRepository($equipe_m = new Equipe());
         $organisationRep = new OrganisationRepository($organisation_m = new Organisation());
         $rep_user = new UserRepository($user_m = new User());
         $rep_categories = new CategorieRepository($categorie_m = new Categorie());
         $rep_publications = new PublicationRepository($publication_m = new Publication());

    }
    
    public function search(Request $request)
    {
         $equipeRep = new EquipeRepository($equipe_m = new Equipe());
         $organisationRep = new OrganisationRepository($organisation_m = new Organisation());
         $rep_user = new UserRepository($user_m = new User());
         $rep_categories = new CategorieRepository($categorie_m = new Categorie());
         $rep_publications = new PublicationRepository($publication_m = new Publication());
         
        
            if($request->input('recherche') == '')
                return redirect()->back();

            
            $categories = $rep_categories->getAll();
            $categories_tab = array();
            foreach ($categories as $categorie) {
              $categories_tab[$categorie->sigle] = $categorie->name;
            }
            
           

            $search = $request->input('recherche');
            $results = $rep_publications->getByTitle($search);

            if($results->count() == 0 && $search.contains(' '))
                $results = $rep_user->getPublicationsByNames($search);
            
            $publications = $results ;

            $tabName = 'Résultats de la recherche pour: "'. $request->input('recherche').'"';
            
            return view('publication.publications_liste', compact('publications', 'categories_tab','tabName')); 
    }
    
}
