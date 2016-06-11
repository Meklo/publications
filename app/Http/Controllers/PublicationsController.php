<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Http\Requests\PublicationCreateRequest;
use App\Repositories\PublicationRepository;

use App\Repositories\CategorieRepository;
use App\EloquentModels\Categorie;

use App\Repositories\UserRepository;
use App\EloquentModels\User;

use App\Repositories\OrganisationRepository;
use App\Repositories\EquipeRepository;

use App\EloquentModels\Organisation;
use App\EloquentModels\Equipe;


class PublicationsController extends Controller
{
    protected $publicationRepository;
    protected $nbrPerPage = 10;
    
    public function __construct(PublicationRepository $publicationRepository)
    {
	$this->publicationRepository = $publicationRepository;
    }
    
    public function index()
    {
//        $publications = $this->publicationRepository->getPaginate($this->nbrPerPage);
//        $links = $publications->render();
//        return view('accueil', compact('publications', 'links'));
    }
    
    public function getPublicationStep1()
    {
        $rep_categories = new CategorieRepository($categorie_m = new Categorie());
        $categories = $rep_categories->getAll();
        
        $names = array();
        $sigles = array();
        foreach($categories as $categorie)
        {
            array_push($names, $categorie->name);
            array_push($sigles, $categorie->sigle);
        }
        $categories = array_combine($sigles, $names);
        
        return view('publication.step_1', compact('categories'));
    }
    
    public function postPublicationStep1(Request $request)
    {
       
        Session::put('type', $request->input('type'));
        return redirect('publication/create');
        
    }
    
    
    public function getPublicationStep2()
    { 
        $equipeRep = new EquipeRepository($equipe_m = new Equipe());
        $organisationRep = new OrganisationRepository($organisation_m = new Organisation());
        $rep_user = new UserRepository($user_m = new User());
        $rep_categories = new CategorieRepository($categorie_m = new Categorie());
        
        
        $type = $rep_categories->getBySigle(Session::get('type'));
        
        //Construction des tableaux pour remplir le select d'auteurs existants
        
        $users = $rep_user->getAll();
        $ids = array();
        $display = array();
        
        foreach ($users as $user)
        {
            array_push($ids, $user->id);
            
            $orga =$organisationRep->getById($equipeRep->getById($user->equipe)->organisation)->name;

            $temp_string = $user->first_name . ' ' . $user->name . ': '. $orga; 
            
            array_push($display, $temp_string);

        }
        $users = array_combine($ids, $display);    
        return view('publication.step_2', compact('type', 'users'));
    }
    
    public function postPublicationStep2(PublicationCreateRequest $request)
    { 
        $inputs = $request->all();
        $inputs = array_merge($inputs,array('type' => Session::get('type')));
        
        $this->store($inputs);
    }
    
    public function store($inputs)
    {
        $this->publicationRepository->store($inputs);
    }
    
    
}
