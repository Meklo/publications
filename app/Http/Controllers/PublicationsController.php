<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Http\Requests\PublicationCreateRequest;
use App\Repositories\PublicationRepository;

use App\Repositories\CategorieRepository;
use App\EloquentModels\Categorie;



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
        $rep_categories = new CategorieRepository($categorie_m = new Categorie());
        $type = $rep_categories->getBySigle(Session::get('type'));
        return view('publication.step_2', compact('type'));
    }
    
    public function postPublicationStep2(PublicationCreateRequest $request)
    { 

    }
    
    
}
