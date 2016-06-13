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
      //$publications = $this->publicationRepository->getPaginate($this->nbrPerPage);
      $publications = $this->publicationRepository->getWithUsersCateogoriePaginate($this->nbrPerPage);
      $links = $publications->render();

      $rep_categories = new CategorieRepository($categorie_m = new Categorie());
      $categories = $rep_categories->getAll();
      $categories_tab = array();
      foreach ($categories as $categorie) {
        $categories_tab[$categorie->sigle] = $categorie->name;
      }
      
      $tabName = 'Publications';

      return view('publication.publications_liste', compact('publications', 'links', 'categories_tab', 'tabName'));
    }
    
  

    public function getPublicationStep1()
    {
        if(!auth()->check())
            return redirect()->back();
      
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
        if(!auth()->check())
            return redirect('accueil');
        
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
        return redirect('accueil');
    }

    public function store($inputs)
    {
        $this->publicationRepository->store($inputs);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publication = $this->publicationRepository->getById($id);
        $auteurs = $publication->users()->get();
        
        $categorie = $publication->categorie->name;

        return view('publication.show', compact('publication', 'auteurs','categorie'));
    }
    
    
    
    public function edit($id)
    {
        $publication =  $this->publicationRepository->getById($id);
        
        $equipeRep = new EquipeRepository($equipe_m = new Equipe());
        $organisationRep = new OrganisationRepository($organisation_m = new Organisation());
        $rep_user = new UserRepository($user_m = new User());
        $rep_categories = new CategorieRepository($categorie_m = new Categorie());       
        
        $users = $rep_user->getAll();
        $ids = array();
        $display = array();
        
        $ordreAuteurs =array();

        foreach ($users as $user)
        {
            array_push($ids, $user->id);

            $orga =$organisationRep->getById($equipeRep->getById($user->equipe)->organisation)->name;

            $temp_string = $user->first_name . ' ' . $user->name . ': '. $orga;

            array_push($display, $temp_string);
        
        }
        $usersTotal = array_combine($ids, $display);
 
  
      foreach($publication->users()->orderBy('publication_user.ordre','asc')->get() as $user)
      {
          $ordreAuteurs[$user->pivot->ordre] = $user->id;
      }

      $initialString ='';
      $i = 1;
      
      foreach($ordreAuteurs as $ordre){
           $initialString .= $usersTotal[$ordreAuteurs[$i]]. ', ';
           $i++;
       } 
              
        return view('publication.edit', compact('publication', 'usersTotal', 'ordreAuteurs', 'initialString'));
    }
    
    public function update(Request $request, $id)
    {
            $publication = $this->publicationRepository->getById($id);
            $publication->title  = $request['title'];
            
            if ($publication->type == 'CI' || $publication->type == 'CF' || $publication->type == 'RI' || $publication->type == 'RF' || $publication->type == 'OS' )
                $publication->label = $request['label'];
            
            
            $publication->save();
            
            $request->session()->flash('alert-success', 'Changement pris en comptes');

            return redirect()->action('PublicationsController@index');
    }

}
